<?php
/**
 * @package apps\modules\Bank
 */

/**
 * Bank actions.
 *
 * @subpackage Bank
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 * @issue      Expacta 2553
 * @author     brave <brave.cheng@expacta.com.cn>
 */
class BankActions extends DepositActions
{

    /**
     * Executes index action
     *
     * @return null
     */
    public function executeIndex() {
        $this->bankParameters();
        $this->filter();
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->redirect("Bank/index?" . util::buildUriQuery("sid", "sort", "sortBy", "pager", "sname"));    
        }
    }

    /**
     * get filter array
     *
     * @return array
     */
    public function filter() {
        $filter = array();
        $pieces = DepositBankPeer::getFieldNames(BasePeer::TYPE_COLNAME);
        $where = ' WHERE 1';

        $sql = sprintf(
            'SELECT %s FROM %s ',
            implode(',', $pieces),
            DepositBankPeer::TABLE_NAME
        );
        if ($this->sname) {
            $leftJoin = sprintf(
                ' LEFT JOIN %s ON %s = %s ',
                DepositBankAliasPeer::TABLE_NAME,
                DepositBankAliasPeer::DEPOSIT_BANK_ID,
                DepositBankPeer::ID
            );
            $sql .= $leftJoin . $where .  sprintf(' AND (%s LIKE ? OR %s LIKE ? OR %s LIKE ?)', DepositBankAliasPeer::NAME, DepositBankPeer::NAME, DepositBankPeer::SHORT_NAME);
            $filter[] = '%' . $this->sname . '%';
            $filter[] = '%' . $this->sname . '%';
            $filter[] = '%' . $this->sname . '%';
        } else {
            $sql .= $where;   
        }

        if ($this->sid) {
            $sql .= sprintf(' AND %s = ?', DepositBankPeer::ID);
            $filter[] = $this->sid;
        }

        $groupBy = ' GROUP BY ' . DepositBankPeer::ID;

        $sql .= $groupBy;
        
        $sql .= $this->querySqlBySort($sql, DepositBankPeer::ID);

        $countSql = str_replace(implode(',', $pieces), 'COUNT(*) AS count ', $sql);
        $countSql = sprintf("SELECT COUNT(1) AS count FROM (%s) sets", $countSql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositBankPeer', $countSql);
    }

    /**
     * show a bank info
     *
     * @return null
     */
    public function executeEdit() {
        if ($this->hasRequestParameter('id')) {
            $this->act ='edit';
            $this->bank = DepositBankPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($this->bank);
        } else {
            $this->act = 'add';
            $this->bank = new DepositBank();
        }

    }

    /**
     * Update bank logo action, do it only once 
     *
     * @issue 2589
     * @return null
     */
    public function executeUpdateBankLogo() {
        DepositBankPeer::rebuiltBankLogo();
        exit('done');
    }

    /**
     * Update bank short char action, do it only once 
     *
     * @issue 2589
     * @return null
     */
    public function executeUpdateBankShortChar() {
        DepositBankPeer::rebultBankShortChar();
        exit('done');
    }
    
    /**
     * delete a bank info
     *
     * @return null
     */
    public function executeDelete() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();
        }
        $this->bankId = $this->getRequestParameter('id') ? intval($this->getRequestParameter('id')) : 0;
        $this->bank = DepositBankPeer::retrieveByPK($this->bankId);
        $this->forward404Unless($this->bank);
        $this->bank->delete();
        $this->redirect("Bank/index?" . util::buildUriQuery("sid", "sort", "sortBy", "pager", "sname"));
    }

    /**
     * add or edit a bank info
     *
     * @issue 2589
     * @return null
     */
    public function executeHandle() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();
        }        
        $this->trimValidation($this->getRequestParameter('bankName'), 'bankName', 'Bank Name');
        $this->trimValidation($this->getRequestParameter('bankShortName'), 'bankShortName', 'Bank Short Name');
        $this->trimValidation($this->getRequestParameter('bankPhone'), 'bankPhone', 'Bank Phone');
        $this->_validateTel();
        $this->verifyAbnormalOperation();
        if ($this->hasRequestParameter('id')) {
            $this->bankId = $this->getRequestParameter('id');
            $this->bank = DepositBankPeer::retrieveByPK($this->bankId);
            $this->forward404Unless($this->bank);
        } else {
            $this->bank = new DepositBank();
        }
        try {
            $bankCreateAt = $this->getRequestParameter('bankCreateAt');
            $pinyin = util::charToPinyin($this->getRequestParameter('bankShortName'));
            $this->bank->setName($this->getRequestParameter('bankName'));
            $this->bank->setShortName($this->getRequestParameter('bankShortName'));
            $this->bank->setPhone($this->getRequestParameter('bankPhone'));
            $this->bank->setIsValid($this->getRequestParameter('isValid'));
            if ($this->bankId) {
                //validate the upload logo
                $pinyin = $pinyin . '_' . $this->bankId;
                if ($this->getRequest()->getFileName('bankLogo')) {
                    $logoPath = $this->_validateBankLogo($pinyin);
                    $this->bank->setLogo($logoPath);
                }
                $this->bank->setSyncStatus(DepositFinancialProductsPeer::SYNC_EDIT);
                $this->bank->setShortChar($pinyin);
                $this->bank->save();    
            } else {
                if ($this->getRequest()->getFileName('bankLogo')) {
                    $this->bank->save();
                    $pinyin = $pinyin . '_' . $this->bank->getId();
                    $logoPath = $this->_validateBankLogo($pinyin);
                    $this->bank->setLogo($logoPath);
                }
                $this->bank->setShortChar($pinyin);
                $this->bank->save();
            }
            $this->redirect("Bank/edit?rmsg=0&id=" . $this->bank->getId() . util::buildUriQuery("sid", "sort", "sortBy", "pager", "sname"));
        } catch (Exception $e) {
            $this->getRequest()->setError("bankName", $e->getMessage());
            $this->forward('Bank', 'edit');
        }
    }


    /**
     * Trim validation
     *
     * @param string $var      validate string
     * @param string $position position
     * @param string $lang     string
     *
     * @return void
     *
     * @issue 2553
     */
    protected function trimValidation($var, $position, $lang) {
        
        if (trim($var) == '' || is_null($var)) {
            $this->getRequest()->setError($position, sprintf(
                util::getMultiMessage('%s can not be blank.'),
                util::getMultiMessage($lang)
            ));
            $this->forward('Bank', 'edit');
        }
    }

    /**
     * Validate tel
     *
     * @return void
     *
     * @issue 2580
     */
    private function _validateTel() {
        $tag = true;
        $tel = $this->getRequestParameter('bankPhone');

        if (strlen($tel) < 5) {
            $tag = false;
        } else {
            $flag = strpos($tel, '-') || strpos($tel, ' ');
            if ($flag) {
                if (strpos($tel, '-')) {
                    $telPlode = explode('-', $tel);    
                }
                if (strpos($tel, ' ')) {
                    $telPlode = explode(' ', $tel);    
                }
                foreach ($telPlode as $number) {
                    if(is_numeric($number) == false) {
                        $tag = false;
                        break;
                    }
                }
            } else {
                if (is_numeric($tel) == false) {
                    $tag = false;
                }
            }
        }
        
        if ($tag == false) {
            $this->getRequest()->setError("bankPhone", util::getMultiMessage('Mobile is invalid.'));
            $this->forward('Bank', 'edit');
        }
    }

    /**
     * Validate the bank logo
     * 
     * @param string $pinyin  pinyin string
     *
     * @issue 2589
     * @return string
     */
    private function _validateBankLogo($pinyin) {
        // delete exist file
        if (file_exists($this->_getWebPath() . $this->bank->getLogo())) {
            @unlink($this->_getWebPath() . $this->bank->getLogo());
        }
        
        $result = $this->_validateUpload($this->getRequest()->getFile('bankLogo'));
        $rs = @getimagesize($this->getRequest()->getFilePath('bankLogo'));
        if (!$rs) {
            $result['res'] = 0;
            $result['msg'] = util::getMultiMessage('Image Error');
        }
        if ($result['res'] === 0) {
            $this->getRequest()->setError("bankLogo", $result['msg']);
            $this->forward('Bank', 'edit');
        }
        //move upload logo
        $file = $this->_uploadImpage($this->getRequest()->getFilePath('bankLogo'), $pinyin . $this->getRequest()->getFileExtension('bankLogo'));
        if (!$file) {
            $this->getRequest()->setError("bankLogo", util::getMultiMessage('Image Upload Failed'));
            $this->forward('Bank', 'edit');
        }
        return $file;   
    }


    /**
     * validate empty
     *
     * @return null
     */
    public function handleErrorHandle() {
        $this->setFlash('commit', true);
        $this->setFlash('act', 'add');
        return $this->forward("Bank","edit");
    }

    /**
     * validate upload image
     *
     * @param array $attachment upload file
     *
     * @return array
     */
    private function _validateUpload($attachment) {
        $imageType = array(
            'png',
        );
        $allowedImageTypes = array('image/png');
        $validate = array('res'=>1,'msg'=>'');
        //is empty
        if ($attachment['error'] == 4) {
            $validate['res'] = 0;
            $validate['msg'] = util::getMultiMessage('Image Is Empty');
            return $validate;
        }
        //image type
        if (!in_array($attachment['type'], $allowedImageTypes)) {
            $validate['res'] = 0;
            $validate['msg'] = sprintf(util::getMultiMessage("Validate Image Type %s", 'Backend'), implode(' ', $imageType));
            return $validate;
        }
        //image size
        $imageSize = 1 * 1024 * 1024;
        if ($attachment['size'] > $imageSize) {
            $validate['res'] = 0;
            $validate['msg'] = util::getMultiMessage('Validate Image Size');
            return $validate;
        }
        
        return $validate;
    }

    /**
     * upload file
     *
     * @param string $tempName temp name
     * @param string $name     name
     *
     * @return boolean
     */
    private function _uploadImpage($tempName, $name) {
        $uploadDirectory = $this->_getFilePath();
        util::createDir($uploadDirectory, 777, 'apache', 'commer');
        if (move_uploaded_file($tempName, $uploadDirectory . DIRECTORY_SEPARATOR . $name)) {
            return $this->_getLogoPath() . DIRECTORY_SEPARATOR . $name;
        }
        return false;
    }

    /**
     * set file path name
     *
     * @return string
     */
    private function _getFilePath() {
        return $this->_getWebPath() . $this->_getLogoPath();
    }

    /**
     * get web path
     *
     * @return string
     */
    private function _getWebPath() {
        return SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR ;
    }

    /**
     * get logo path
     *
     * @return string
     */
    private function _getLogoPath() {
        return 'uploads' . DIRECTORY_SEPARATOR . 'banklogo';
    }

}
