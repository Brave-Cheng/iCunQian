<?php

/**
 * @package apps\backend\modules\Product
 */

/**
 * Product actions.
 *
 * @subpackage Product
 * @author     brave <brave.cheng@expacta.com.cn>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class ProductActions extends sfActions
{

    /**
     * Executes index action
     *
     * @issue 2579
     * @return null
     */
    public function executeIndex() {
        $this->_getdefaultSort();
        $this->_filter();
    }

    /**
     *
     * make filter
     *
     * @issue 2579
     * @return null
     */
    private function _filter() {
        //filter
        $name = trim($this->getRequestParameter('productName'));
        $pieces = DepositFinancialProductsPeer::getFieldNames(BasePeer::TYPE_FIELDNAME);
        $fields = implode(',', $pieces);
        $sql ="SELECT $fields FROM %%deposit_financial_products%% WHERE 1 ";
        $filter = array();
        $andSql = "";
        if ($name) {
            $andSql .= ' AND name LIKE ?';
            $filter[] = '%' . $name . '%';
        }
        if (trim($this->getRequestParameter('productBankName'))) {
            $andSql .= ' AND bank_name LIKE ?';
            $filter[] = "%" . trim($this->getRequestParameter('productBankName')) . "%";
        }
        $order = ' ';
        if ($this->getRequestParameter('sortBy')) {
            $order .= 'ORDER BY ' . $this->getRequestParameter('sortBy') . ' ' . $this->getRequestParameter('sort');
        }
        $sql .= $andSql . $order;
        //query
        $sql = str_replace('%%deposit_financial_products%%', DepositFinancialProductsPeer::TABLE_NAME, $sql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositFinancialProductsPeer');
    }

    /**
     * Executes edit action
     *
     * @issue 2579
     * @return null
     */
    public function executeEdit() {
        $this->_getRequestParameters();
    }

    /**
     * Executes handle action
     *
     * @issue 2579
     * @return null
     */
    public function executeHandle() {
        try {
            $this->_getRequestParameters();
            if (is_object($this->product->getDepositRequestFinancial())) {
                $this->product->getDepositRequestFinancial()->setStatus($this->getRequestParameter('status'));
                $this->product->getDepositRequestFinancial()->setSyncStatus(DepositFinancialProductsPeer::SYNC_EDIT);
                $this->product->getDepositRequestFinancial()->save();
            } else {
                $depositRequestFinancial = new DepositRequestFinancial();
                $depositRequestFinancial->setStatus($this->getRequestParameter('status'));
                $depositRequestFinancial->setSyncStatus(DepositFinancialProductsPeer::SYNC_ADD);
                $depositRequestFinancial->save();
                $this->product->setDepositRequestFinancialId($depositRequestFinancial->getId());
            }

            $this->product->setName($this->getRequestParameter('name'));
            $this->product->setProfitType($this->getRequestParameter('profitType'));
            $this->product->setCurrency($this->getRequestParameter('currency'));
            $this->product->setBankName($this->getRequestParameter('bankName'));
            $this->product->setRegion($this->getRequestParameter('region'));
            $this->product->setProductType($this->getRequestParameter('productType'));
            $this->product->setInvestCycle($this->getRequestParameter('investCycle'));
            $this->product->setTarget($this->getRequestParameter('target'));
            $this->product->setSaleStartDate($this->getRequestParameter('saleStartDate'));
            $this->product->setSaleEndDate($this->getRequestParameter('saleEndDate'));
            $this->product->setDeadline($this->getRequestParameter('deadline'));
            $this->product->setPayPeriod($this->getRequestParameter('payPeriod'));
            $this->product->setExpectedRate($this->getRequestParameter('expectedRate'));
            $this->product->setActualRate($this->getRequestParameter('actualRate'));
            $this->product->setInvestStartAmount($this->getRequestParameter('investStartAmount'));
            $this->product->setInvertIncreaseAmount($this->getRequestParameter('investIncreaseAmount'));
            $this->product->setProfitDesc($this->getRequestParameter('profitDesc'));
            $this->product->setInvestScope($this->getRequestParameter('investScope'));
            $this->product->setStopCondition($this->getRequestParameter('stopCondition'));
            $this->product->setRaiseCondition($this->getRequestParameter('raiseCondition'));
            $this->product->setPurchase($this->getRequestParameter('purchase'));
            $this->product->setCost($this->getRequestParameter('cost'));
            $this->product->setFeature($this->getRequestParameter('feature'));
            $this->product->setEvents($this->getRequestParameter('events'));
            $this->product->setWarnings($this->getRequestParameter('warnings'));
            $this->product->setAnnounce($this->getRequestParameter('announce'));
            $this->product->save();

            $this->redirect("Product/edit?rmsg=0&id=" . $this->product->getId() . $this->_getdefaultSort());
        } catch (Exception $e) {
            $this->forward404($e);
        }
    }

    /**
     * Executes delete action
     *
     * @issue 2579
     * @return null
     */
    public function executeDelete() {
        try {
            $this->_getRequestParameters();
            $this->product->getDepositRequestFinancial()->setSyncStatus(DepositFinancialProductsPeer::SYNC_DELETE);
            $this->redirect("Product/index". $this->_getdefaultSort());
        } catch (Exception $exc) {
            $this->forward404($exc);
        }
    }

    /**
     * Executes Recommend action
     *
     * @issue 2579
     * @return null
     */
    public function executeRecommend() {
        $this->_getRequestParameters();
    }

    /**
     * Executes import action
     *
     * @issue 2580
     * @return null
     */
    public function executeImport() {
        $this->extension = array_slice(DepositExcel::getExtension(), 0, 3);
        $this->platform = DepositExcel::getPlatform();
    }

    /**
     * Executes fileimport action
     *
     * @issue 2580
     * @return null
     */
    public function executeFileImport() {
        try {
            $this->_validate();
            $path = pathinfo($this->getRequest()->getFileName('excel'), PATHINFO_BASENAME);
            $pathFilename = $this->_upload($this->getRequest()->getFilePath('excel'), $path);
            $error = $this->parseExcel($pathFilename);
            $filename = pathinfo($pathFilename, PATHINFO_BASENAME);
            if ($error) {
                $this->getRequest()->setError('importError', sprintf(util::getMultiMessage('import %s invalid count %s, because %s'), $filename, count($error), implode('。', $error)));
            } else {
                $this->getRequest()->setError('importError', sprintf(util::getMultiMessage('import %s success'), $filename));
            }

        } catch (Exception $exc) {
            $this->getRequest()->setError('importError', $exc->getMessage());
        }
        $this->forward('Product', 'import');
    }

    /**
     * parse excel template
     *
     * @param string $filename filename
     *
     * @issue 2580
     * @return null
     */
    protected function parseExcel($filename) {
        try {
            $firstRow = null;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $class = DepositExcel::getClass($extension);
            $excel = new DepositExcel();
            $excelObject = $excel->load($filename, $class);
            $firstSheet = $excelObject->getSheet(0);
            //max column
            $maxColumnIndex = $firstSheet->getHighestColumn();
            $maxColumn = PHPExcel_Cell::columnIndexFromString($maxColumnIndex) - 1;
            //max row
            $maxRow = $firstSheet->getHighestRow();
            //fetch data
            $realRows = $this->fetch($firstSheet, $maxColumn, $maxRow, $firstRow);

            array_shift($firstRow);
            $headers = $this->diffFieldsMaps($firstRow);
            if ($headers == false) {
                throw new Exception(sprintf(util::getMultiMessage('parse %s error, header is not same'), $filename));
            }
            if (empty($realRows)) {
                throw new Exception(sprintf(util::getMultiMessage('parse %s error, it is empty'), $filename));
            }
            //insert database
            return $this->insertByExcel($realRows, $headers);
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    /**
     * diff fields maps
     *
     * @param array $firstRow diff rows list
     *
     * @issue 2580
     * @return mixed
     */
    public function diffFieldsMaps($firstRow) {
        $headers = DepositFinancialProductsPeer::translateFieldsMaps(DepositExcel::TENCERT);
        if (array_diff_assoc($firstRow, array_values($headers))) {
            $headers = DepositFinancialProductsPeer::translateFieldsMaps(DepositExcel::JNLC);
            if (array_diff_assoc($firstRow, array_values($headers))) {
                return false;
            }
        }
        return $headers;
    }


    /**
     * insert database
     *
     * @param array $excel   excel list
     * @param array $headers header list
     *
     * @issue 2580
     * @return null
     */
    public function insertByExcel($excel, $headers) {
        $error = array();
        $excelList = array();
        $trans = array_keys($headers);
        foreach ($excel as $fields) {
            try {
                array_shift($fields);
                foreach ($fields as $key => $val) {
                    $excelList[$trans[$key]] = $val;
                }
                DepositFinancialProductsPeer::saveProducts($excelList);
            } catch (Exception $exc) {
                $error[] = $exc->getMessage();
            }
        }
        return $error;
    }


    /**
     * fecth excel data
     *
     * @param object $excel     PHPExcel
     * @param string $maxColumn max column, A, B, ...
     * @param int    $maxRow    max row
     * @param mixed  $row       first row record
     *
     * @issue 2580
     * @return null
     */
    public function fetch($excel, $maxColumn, $maxRow, &$row = '') {
        $excelData = array();
        for ($rowIndex = 1; $rowIndex <= $maxRow; $rowIndex++) {
            for ($columnIndex = 0; $columnIndex <= $maxColumn; $columnIndex++) {
                $cell = $excel->getCellByColumnAndRow($columnIndex, $rowIndex);
                $value = $cell->getValue();
                if ($value instanceof PHPExcel_RichText) {
                    $value = $value->__toString();
                }
                //excel time
                if ($cell->getDataType() == PHPExcel_Cell_DataType::TYPE_NUMERIC) {
                    $cellstyleformat = $cell->getParent()->getStyle($cell->getCoordinate())->getNumberFormat();
                    $formatcode = $cellstyleformat->getFormatCode();
                    if (preg_match('/^(\[\$[A-Z]*-[0-9A-F]*\])*[hmsdy]/i', $formatcode)) {
                        $value = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
                    } else {
                        $value = PHPExcel_Style_NumberFormat::toFormattedString($value, $formatcode);
                    }
                }
                $excelData[$rowIndex][] = $value;
            }
        }
        $row = array_shift($excelData);
        return $excelData;
    }

    /**
     * validate upload
     *
     * @issue 2580
     * @return null
     */
    private function _validate() {
        //extension
        $path = pathinfo($this->getRequest()->getFileName('excel'), PATHINFO_EXTENSION);
        if (!in_array($path, DepositExcel::getExtension())) {
            $this->getRequest()->setError('excel', util::getMultiMessage('Extension Error'));
            $this->forward('Product', 'import');
        }
        //size
        if ($this->getRequest()->getFileSize('excel') > 1024 * 1024 * 10) {
            $this->getRequest()->setError('excel', util::getMultiMessage('Size Error'));
            $this->forward('Product', 'import');
        }
    }

    /**
     * upload file
     *
     * @param string $tempName temp name
     * @param string $name     name
     *
     * @issue 2580
     * @return boolean
     */
    private function _upload($tempName, $name) {
        $uploadDirectory = $this->_getFilePath();
        util::createDir($uploadDirectory, 777, 'apache', 'commer');
        if (@move_uploaded_file($tempName, $uploadDirectory . DIRECTORY_SEPARATOR . $name)) {
            return $uploadDirectory . DIRECTORY_SEPARATOR . $name;
        }
        throw new Exception(sprintf(util::getMultiMessage("Cannot Move %s") . PHP_EOL, $name));
    }

    /**
     * set file path name
     *
     * @issue 2580
     * @return string
     */
    private function _getFilePath() {
        return $this->_getWebPath() . $this->_getLogoPath();
    }

    /**
     * get web path
     *
     * @issue 2580
     * @return string
     */
    private function _getWebPath() {
        return SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR ;
    }

    /**
     * get logo path
     *
     * @issue 2580
     * @return string
     */
    private function _getLogoPath() {
        return 'uploads' . DIRECTORY_SEPARATOR . 'excels';
    }

    /**
     * Executes download template action
     *
     * @issue 2580
     * @return null
     */
    public function executeDownloadTemplate() {
        $extension = $this->getRequestParameter('extension');
        $platform = $this->getRequestParameter('platform');
        $class = DepositExcel::getClass($extension);
        $filename = "template.$extension";
        $excel = new DepositExcel();
        $excel->setExcel($platform);
        $objWriter = PHPExcel_IOFactory::createWriter($excel, $class);
        header("Content-Disposition:attachment;filename=$filename");
        header("Content-Type:application/octet-stream");
        header("Content-Transfer-Encoding:binary");
        header("Pragma:no-cache");
        $objWriter->save('php://output');
        exit();
    }


    /**
     * validate empty
     *
     * @issue 2579
     * @return null
     */
    public function handleErrorHandle() {
        return $this->forward("Product","edit");
    }

    /**
     * get url sort
     *
     * @issue 2579
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
     * get common request parameters
     *
     * @issue 2579
     * @return null
     */
    private function _getRequestParameters() {
        $this->pid = intval($this->getRequestParameter('id'));
        if ($this->pid) {
            $this->product = DepositFinancialProductsPeer::retrieveByPK($this->pid);
        } else {
            $this->product = new DepositFinancialProducts();
        }
        $this->forward404Unless($this->product);
        $this->attributes = DepositAttributesPeer::fetchStandardAdapterList(true);
    }


}
