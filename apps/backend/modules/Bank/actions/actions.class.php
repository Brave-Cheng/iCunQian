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
class BankActions extends sfActions
{

    /**
     * Executes index action
     *
     * @return null
     */
    public function executeIndex() {
        $this->filter();
    }

    /**
     * get filter array
     *
     * @return array
     */
    public function filter() {
        //filter
        $name = trim($this->getRequestParameter('keywords'));
        $pieces = DepositBankPeer::getFieldNames(BasePeer::TYPE_FIELDNAME);
        $fields = implode(',', $pieces);
        $sql ="SELECT $fields FROM %%deposit_bank%% WHERE 1 ";
        $filter = array();
        $andSql = "";
        if ($name) {
            $andSql .= ' name LIKE ?';
            $filter[] = '%' . $name . '%';
        }
        $order = ' ';
        if ($this->getRequestParameter('sortBy')) {
            $order .= 'ORDER BY ' . $this->getRequestParameter('sortBy') . ' ' . $this->getRequestParameter('sort');
        }
        $sql .= $andSql . $order;
        //query
        $sql = str_replace('%%deposit_bank%%', DepositBankPeer::TABLE_NAME, $sql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositBankPeer');
    }

    /**
     * show a bank info
     *
     * @return null
     */
    public function executeEdit() {
        $this->bankId = $this->getRequestParameter('id') ? intval($this->getRequestParameter('id')) : 0;
        if ($this->bankId) {
            $this->bank = DepositBankPeer::retrieveByPK($this->bankId);
        } else {
            $this->bank = new DepositBank();
        }
        $this->forward404Unless($this->bank);
    }

    /**
     * delete a bank info
     *
     * @return null
     */
    public function executeDelete() {
        $this->bankId = $this->getRequestParameter('id') ? intval($this->getRequestParameter('id')) : 0;
        $this->bank = DepositBankPeer::retrieveByPK($this->bankId);
        $this->forward404Unless($this->bank);
        $this->bank->delete();
        $this->redirect("Bank/index");
    }

    /**
     * add or edit a bank info
     *
     * @return null
     */
    public function executeHandle() {
        $this->bankId = $this->getRequestParameter('id') ? intval($this->getRequestParameter('id')) : 0;
        $this->bank = DepositBankPeer::retrieveByPK($this->bankId);
        //add bank
        if (!$this->bank) {
            $this->bank = new DepositBank();
        }
        $this->forward404Unless($this->bank);
        $pinyin = util::charToPinyin($this->getRequestParameter('bankShortName'));
        //upload logo or if reupload logo
        //validate the upload logo
        if ($this->getRequest()->getFileName('bankLogo') && $this->bankId) {
            // delete exist file
            if (file_exists($this->_getWebPath() . $this->bank->getLogo())) {
                @unlink($this->_getWebPath() . $this->bank->getLogo());
            }
            $result = $this->_validateUpload($this->getRequest()->getFile('bankLogo'));
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
            $this->bank->setLogo($file);
        } else {
            $result = $this->_validateUpload($this->getRequest()->getFile('bankLogo'));
            if ($result['res'] === 0) {
                $this->getRequest()->setError("bankLogo", $result['msg']);
                $this->forward('Bank', 'edit');
            }
        }

        $this->bank->setName($this->getRequestParameter('bankName'));
        $this->bank->setShortName($this->getRequestParameter('bankShortName'));
        $this->bank->setShortChar($pinyin);
        $this->bank->setPhone($this->getRequestParameter('bankPhone'));
        $this->bank->setCreatedAt($this->getRequestParameter('bankCreateAt'));
        $this->bank->setUpdatedAt($this->getRequestParameter('bankUpdateAt'));
        $this->bank->setIsValid($this->getRequestParameter('isValid'));
        if ($this->bankId) {
            $this->bank->setSyncStatus(DepositFinancialProductsPeer::SYNC_EDIT);
        }
        $this->bank->save();

        $this->redirect("Bank/edit?rmsg=0&id=" . $this->bank->getId() . $this->_getdefaultSort());
    }

    /**
     * get url sort
     *
     * @return string
     */
    private function _getdefaultSort() {
        $string = "";
        if ($this->getRequestParameter('sortBy')) {
            $string = "&sortBy=" . $this->getRequestParameter('sortBy');
            if ($this->getRequestParameter('sort')) {
                $string = $string . "&sort=" . $this->getRequestParameter('sort');
            }
        }
        return $string;
    }

    /**
     * validate empty
     *
     * @return null
     */
    public function handleErrorHandle() {
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
            'image/png',
        );
        $validate = array('res'=>1,'msg'=>'');
        //is empty
        if ($attachment['error'] == 4) {
            $validate['res'] = 0;
            $validate['msg'] = util::getMultiMessage('Image Is Empty');
            return $validate;
        }
        //image type
        if (!in_array($attachment['type'], $imageType)) {
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
