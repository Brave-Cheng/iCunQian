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
class ProductActions extends DepositActions
{

    public $pid;
    /**
     * Executes index action
     *
     * @issue 2579
     * @return null
     */
    public function executeIndex() {
        $this->productParameters();
        $this->_filter();
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->redirect("Product/index?". $this->getProductUri());    
        }
    }

    /**
     *
     * make filter
     *
     * @issue 2579
     * 
     * @return string
     */
    private function _filter() {
        $filter = array();
        $where = " WHERE 1";
        $pieces = DepositFinancialProductsPeer::getFieldNames(BasePeer::TYPE_COLNAME);
        $sql = sprintf(
            'SELECT %s FROM %s',
            implode(',', $pieces),
            DepositFinancialProductsPeer::TABLE_NAME
        );
        if ($this->productBankName) {
            $leftJoin = sprintf(
                ' LEFT JOIN %s ON %s = %s LEFT JOIN %s ON %s = %s',
                DepositBankPeer::TABLE_NAME,
                DepositFinancialProductsPeer::BANK_ID,   
                DepositBankPeer::ID,
                DepositBankAliasPeer::TABLE_NAME,
                DepositBankAliasPeer::DEPOSIT_BANK_ID,
                DepositBankPeer::ID
            );
            $sql .= sprintf('%s %s AND %s like ? ', $leftJoin, $where, DepositBankAliasPeer::NAME);
            $filter[] = "%" . $this->productBankName ."%";
        } else {
            $sql .= $where;
        }
        if ($this->productName) {
            $sql .= sprintf(' AND %s LIKE ?', DepositFinancialProductsPeer::NAME);
            $filter[] =  "%". $this->productName . "%";
        }
        if ($this->sid) {
            $sql .= sprintf(' AND %s = ?', DepositFinancialProductsPeer::ID);
            $filter[] = $this->sid;
        }
        $sql .= sprintf(' AND %s != %s', DepositFinancialProductsPeer::SYNC_STATUS, DepositFinancialProductsPeer::SYNC_DELETE);

        $groupBy = sprintf(' GROUP BY %s', DepositFinancialProductsPeer::ID);

        $sql .= $groupBy;
        $sql .= $this->querySqlBySort($sql, DepositFinancialProductsPeer::ID, array(
            DepositFinancialProductsPeer::INVEST_START_AMOUNT,
            DepositFinancialProductsPeer::EXPECTED_RATE,
            DepositFinancialProductsPeer::CREATED_AT,
        ));
        $countSql = str_replace(implode(',', $pieces), 'COUNT(*) AS count ', $sql);
        $countSql = sprintf("SELECT COUNT(1) AS count FROM (%s) sets", $countSql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositFinancialProductsPeer', $countSql);
    }

    /**
     * Executes edit action
     *
     * @issue 2579
     * @return null
     */
    public function executeEdit() {
        $this->act = 'edit';
        $this->product = DepositFinancialProductsPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($this->product);
        $this->_getRequestParameters();
    }

    /**
     * Executes handle action
     *
     * @issue 2579
     * @return null
     */
    public function executeHandle() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();
        }

        $this->pid = intval($this->getRequestParameter('id'));

        $this->product = DepositFinancialProductsPeer::retrieveByPK($this->pid);

        $sync = DepositFinancialProductsPeer::SYNC_EDIT;
        if (!$this->product) {
            $sync = DepositFinancialProductsPeer::SYNC_ADD;
            $this->product = new DepositFinancialProducts();
        }
        $this->master['pk'] = $this->pid;
        $this->master['sync_status'] = $sync;

        try { 

            $products = DepositFinancialProductsPeer::saveProducts($this->master);
            $this->pid = $products->getId();
            $this->redirect("Product/edit?rmsg=0&id=" . $this->pid . $this->getProductUri());

        } catch (Exception $e) {
            
            if (get_class($e) == 'ValidateException') {
                $this->getRequest()->setError($e->getFormatPosition(), $e->getMessage());        
            } else {
                $this->getRequest()->setError('backError', $e->getMessage());
            }
            $this->forward("Product","edit");
        }
    }

    

    /**
     * Executes delete action
     *
     * @issue 2579
     * @return null
     */
    public function executeDelete() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();
        }
        $this->product = DepositFinancialProductsPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($this->product);

        $this->product->setSyncStatus(DepositFinancialProductsPeer::SYNC_DELETE);
        $this->product->save();

        $this->redirect("Product/index?". $this->getProductUri());
    }

    /**
     * Executes Recommend action
     *
     * @issue 2579
     * @return null
     */
    public function executeRecommend() {
        $this->product = DepositFinancialProductsPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($this->product);
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
    public function executeUpload() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();
        }
        try {
            set_time_limit(0);
            $this->_validate();
            $path = pathinfo($this->getRequest()->getFileName('excel'), PATHINFO_BASENAME);
            $pathFilename = $this->_upload($this->getRequest()->getFilePath('excel'), $path);
            $statistics = $this->parseExcel($pathFilename);

            $filename = pathinfo($pathFilename, PATHINFO_BASENAME);

            if (isset($statistics['fail'])) {               
                throw new Exception(
                    sprintf(
                        util::getMultiMessage('import %s success %s, invalid count %s'), 
                        $filename, 
                        isset($statistics['success']) ? count($statistics['success']) : 0,
                        count($statistics['fail'])
                    ) . $this->_report($statistics)
                );
                @unlink($pathFilename);
            } else {
                $this->getRequest()->setError('importError', sprintf(util::getMultiMessage('import %s success'), $filename));   
            }
        } catch (Exception $e) {
            $this->getRequest()->setError('importError', $e->getMessage());
        }
        $this->forward('Product','import');
    }


    /**
     * validate empty
     *
     * @issue 2579
     * 
     * @return null
     */
    public function handleUpload() {
        return $this->forward("Product","import");
    }

    /**
     * Show html error friendly
     *
     * @param array $errors errors message
     *
     * @return string
     *
     * @issue 2580
     */
    private function _report($errors) {
        $errors = isset($errors['success']) ? array_merge($errors['success'], $errors['fail']) : $errors['fail'];
        $errorString = sprintf(
            '<a href="%s" style="font-weight:normal;">%s</a>', 
            util::getDomain() . '/uploads/excels/' . $this->_reportCSV($errors),
            util::getMultiMessage('Click Here')
        );

        return $errorString;
    }

    /**
     * Report error 
     *
     * @param array $haystacks error mesage
     *
     * @return string
     *
     * @issue 2580
     */
    private function _reportCSV($haystacks) {
        $csvTitle = array(
            iconv('UTF-8', 'GB2312', util::getMultiMessage('Item')),
            iconv('UTF-8', 'GB2312', util::getMultiMessage('Product Name')),
            iconv('UTF-8', 'GB2312', util::getMultiMessage('Status')),
            iconv('UTF-8', 'GB2312', util::getMultiMessage('Reason')),
        );
        $reportDirectory = $this->_getFilePath();
        $reportCSV = 'report_' . time() . '.csv';
        $handle = fopen($reportDirectory . DIRECTORY_SEPARATOR . $reportCSV, 'w');
        if (!$handle) {
            return false;
        }
        fputcsv($handle, $csvTitle);
        foreach ($haystacks as $key => $fields) {
            $key++;
            $rows = array(
                $key,
                iconv('UTF-8', 'GB2312', $fields['name']),
                iconv('UTF-8', 'GB2312', $fields['status']),
                iconv('UTF-8', 'GB2312', $fields['err_msg']),
            );
            fputcsv($handle, $rows);
        }
        fclose($handle);
        return $reportCSV;
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
        } catch (Exception $e) {
            @unlink($filename);
            throw new Exception(sprintf(util::getI18nMessage('parse excel error%s'), pathinfo($filename, PATHINFO_BASENAME)));
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
        $statistics = array();
        $excelList = array();
        $trans = array_keys($headers);
        foreach ($excel as $excelRow => $fields) {
            $null = false;
            foreach ($fields as $emptyString) {
                if (!is_null($emptyString)) {
                     $null = true;                   
                }
            }
            if ($null == false) {
                unset($fields);
                continue;
            }
            try {
                array_shift($fields);
                foreach ($fields as $key => $val) {
                    $excelList[$trans[$key]] = $val;
                }
                $excelList['status'] = DepositFinancialProductsPeer::getActualStatus($excelList['sale_start_date'], $excelList['sale_end_date'], $excelList['deadline']);

                $this->validateProductNumber($excelList);
                $this->validateProductScope($excelList);
                $this->validateProductDates($excelList);
                DepositFinancialProductsPeer::saveProducts($excelList);
                $statistics['success'][$excelRow] = array(
                    'name'      => $excelList['name'],
                    'status'    => util::getMultiMessage('Success'),
                    'err_msg'   => null,
                );
            } catch (Exception $exc) {
                $statistics['fail'][$excelRow] = array(
                    'name'      => $excelList['name'],
                    'status'    => util::getMultiMessage('Fail'),
                    'err_msg'   => $exc->getMessage(),
                );
            }
            unset($fields, $excelRow);
        }
        unset($trans,$headers);
        return $statistics;
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
            throw new Exception(util::getMultiMessage('Extension Error'));
        }
        //size
        if ($this->getRequest()->getFileSize('excel') > 1024 * 1024 * 10) {
            throw new Exception(util::getMultiMessage('Size Error'));
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
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();
        }
        try {
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
        } catch (Exception $e) {
            $this->forward404();
        }
    }

    /**
     * Re-write validateHandle 
     *
     * @return void
     *
     * @issue 2579
     */
    public function validateHandle() {
        $this->verifyAbnormalOperation();
        $master = $this->master = array(
            'status' => DepositFinancialProductsPeer::getActualStatus(
                $this->getRequestParameter('saleStartDate'), 
                $this->getRequestParameter('saleEndDate'), 
                $this->getRequestParameter('deadline')
            ),
            'name' => $this->getRequestParameter('name'), 
            'profit_type' => $this->getRequestParameter('profitType'), 
            'currency' => $this->getRequestParameter('currency'), 
            'bank_id' => $this->getRequestParameter('bankId'),
            'invest_cycle' => $this->getRequestParameter('investCycle'), 
            'target' => $this->getRequestParameter('target'), 
            'sale_start_date' => $this->getRequestParameter('saleStartDate'), 
            'sale_end_date' => $this->getRequestParameter('saleEndDate'), 
            'deadline' => $this->getRequestParameter('deadline'), 
            'pay_period' => $this->getRequestParameter('payPeriod'), 
            'expected_rate' => $this->getRequestParameter('expectedRate'), 
            'actual_rate' => $this->getRequestParameter('actualRate'), 
            'invest_start_amount' => $this->getRequestParameter('investStartAmount'), 
            'invest_increase_amount' => $this->getRequestParameter('investIncreaseAmount'), 
            'profit_desc' => $this->getRequestParameter('profitDesc'), 
            'invest_scope' => $this->getRequestParameter('investScope'), 
            'stop_condition' => $this->getRequestParameter('stopCondition'), 
            'raise_condition' => $this->getRequestParameter('raiseCondition'),
            'purchase' => $this->getRequestParameter('purchase'), 
            'cost' => $this->getRequestParameter('cost'), 
            'feature' => $this->getRequestParameter('feature'), 
            'events' => $this->getRequestParameter('events'), 
            'warnings' => $this->getRequestParameter('warnings'),
            'announce' => $this->getRequestParameter('announce'), 
            'profit_start_date' => $this->getRequestParameter('profitStartDate'), 
            'region' => $this->getRequestParameter('region')
        );
        try {
            $this->validateProductNumber($master);
            $this->validateProductScope($master);
            $this->validateProductDates($master);
            return true;
        } catch (Exception $e) {
            if (get_class($e) == 'ValidateException') {
                $this->getRequest()->setError($e->getFormatPosition(), $e->getMessage());
            } else {
                $this->getRequest()->setError('backError', $e->getMessage());
            }
            return false;
        }
    }


    /**
     * validate empty
     *
     * @issue 2579
     * @return null
     */
    public function handleErrorHandle() {
        $this->setFlash('commit', true);
        switch ($this->getRequestParameter('act')) {
            case 'add':
                return $this->forward("Product","add");
            break;
            case 'edit':
                return $this->forward("Product","edit");
            break;   
        }
        
    }


    /**
     * Execute add action
     *
     * @return void
     *
     * @issue 2579
     */
    public function executeAdd() {
        $this->act = 'add';
        $this->product = new DepositFinancialProducts();
        $this->_getRequestParameters();
        $this->setTemplate('edit');
    }

    /**
     * get common request parameters
     *
     * @issue 2579
     * 
     * @return void
     */
    private function _getRequestParameters() {
        $this->attributes = DepositAttributesPeer::fetchStandardAdapterList(true);
    }

    /**
     * execute push 
     *
     * @return void
     *
     * @issue 2599
     */
    public function executePush() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();   
        }
        set_time_limit(0);
        $err = array();
        $pid = $this->getRequestParameter('id');

        $recommend = $this->getRequestParameter('recommend');
        if (trim($recommend) == '') {
            $this->getRequest()->setError('recommend', util::getMultiMessage('Push Message empty.'));
            $this->forward('Product', 'recommend');
        }
        $this->product = DepositFinancialProductsPeer::retrieveByPK($pid);
        $this->forward404Unless($this->product);
        $devices = PushDevicesPeer::getfilterDevices(
            $this->product->getRegion(), 
            $this->product->getBankId(),
            $this->product->getProfitType(),
            $this->product->getExpectedRate(),
            $this->product->getInvestCycle()
        );

        $total = count($devices);
        if (empty($devices)) {
            $total = 1;
            $err[] = util::getMultiMessage('Did not meet the conditions of the data');
        }

        foreach ($devices as $device) {
            try {
                PushMessagesPeer::messageEnqueue($recommend, $device->getId(), PushMessagesPeer::TYPE_CLIENT, $this->product->getId());
                //send message
                PushMessagesPeer::pushMessage($device);
            } catch (Exception $e) {
                $err[$device->getDeviceToken()] = $e->getMessage();
            }
        }

        $this->getRequest()->setError('recommend', sprintf(util::getMultiMessage('Push success %s, fail %s'), ($total - count($err)), (count($err))));
        
        $this->forward('Product', 'recommend');
    }


    /**
     * Show push message error friendly
     *
     * @param array $err error message
     *
     * @return string
     *
     * @issue  number
     */
    protected function friendlyShowPushMessage($err) {
        $errorMsg = '';
        foreach ($err as $key => $var) {
            $errorMsg .= '<span>' . sprintf(util::getMultiMessage('Token %s'), $key)
                        . sprintf(util::getMultiMessage('Push error: %s'), $var) . ' </span>';
        }
        return $errorMsg;
    } 

    /**
     * validate empty
     *
     * @issue 2579
     * @return null
     */
    public function handleErrorPush() {
        $this->forward('Product', 'recommend');
    }

    /**
     * Validate product property number
     *
     * @param array $master property number 
     *
     * @return void
     *
     * @issue 2579
     */
    protected function validateProductNumber($master) {
        try {
            

            $productValidation = new ProductValidation();
 
            $productValidation->trimValidation($master['name'], 'name');  
            $productValidation->trimValidation($master['profit_type'], 'profit_type');
            $productValidation->trimValidation($master['currency'], 'currency');  

            //special        
            if (isset($master['bank_id'])) {
                $productValidation->trimValidation($master['bank_id'], 'bank_id');    
            }
            if (isset($master['bank_name'])) {
                $productValidation->trimValidation($master['bank_name'], 'bank_id');    
            }

            $productValidation->numberValidation($master['invest_cycle'], 'invest_cycle');
            $productValidation->decimalValidation($master['expected_rate'], 'expected_rate');
            $productValidation->decimalValidation($master['actual_rate'], 'actual_rate');
            $productValidation->integerValidation($master['invest_start_amount'], 'invest_start_amount');
            $productValidation->integerValidation($master['invest_increase_amount'], 'invest_increase_amount');
        } catch (ValidateException $e) {
            throw $e;            
        }
    }


    /**
     * Validate product property scope
     *
     * @param array $master property scope
     * 
     * @return void
     *
     * @issue 2580
     */
    protected function validateProductScope($master) {
        try {
            $productValidation = new ProductValidation();
            $productValidation->scopeValidation($master['currency'], 'currency');
            $productValidation->scopeValidation($master['status'], 'status');
            $productValidation->scopeValidation($master['profit_type'], 'profit_type');
        } catch (ValidateException $e) {
            throw $e;
        }
    }

    /**
     * Validate product(sale start date, sale end date, profit start date, deadline )
     *
     * @param array $days all days
     *
     * @return void
     *
     * @issue 2579
     */
    protected function validateProductDates($days) {
        try {
            $productValidation = new ProductValidation();
            $productValidation->dateValidation($days['sale_start_date'], 'sale_start_date', $days['sale_end_date'],  'sale_end_date', '>=', true);

            $productValidation->dateValidation($days['sale_end_date'], 'sale_end_date', $days['sale_start_date'], 'sale_start_date', '<=', true);

            if ($days['profit_start_date']) {
                $productValidation->dateValidation($days['profit_start_date'], 'profit_start_date', $days['sale_start_date'], 'sale_start_date', '<=');
            }
            if ($days['deadline']) {
                $productValidation->dateValidation($days['deadline'], 'deadline', $days['sale_start_date'], 'sale_start_date', '<=');
            }
            
        } catch (ValidateException $e) {
            throw $e;
        }
    }

    
}
