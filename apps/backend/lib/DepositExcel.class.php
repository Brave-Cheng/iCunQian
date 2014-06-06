<?php

/**
 * @package apps\backend\lib
 */

/**
 * DepositExcel
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class DepositExcel extends PHPExcel
{

    const AUTHOR = 'Expacta Inc';
    const LAST_MODIFIED = 'brave';
    const TITLE = 'Office 2007 XLSX Import';
    const SUBJECT = 'Office 2007 XLSX Test Document';
    const DESCRIPTION = 'Test document for Office 2007 XLSX, generated using PHP classes.';
    const KETWORDS = '"office 2007 openxml php';
    const CATEGROY = 'Test result file';
    
    const XLS = 'xls';
    const XLSX = 'xlsx';
    const CSV = 'csv';
    const PDF = 'pdf';
    
    const TENCERT = 'tencert';
    const JNLC    = 'jnlc';

    /**
     * set property
     * 
     * @issue 2580
     * @return null
     */
    public function setProperty() {
        $this->getProperties()->setCreator(self::AUTHOR);
        $this->getProperties()->setLastModifiedBy(self::LAST_MODIFIED);
        $this->getProperties()->setTitle(self::TITLE);
        $this->getProperties()->setSubject(self::SUBJECT);
        $this->getProperties()->setDescription(self::DESCRIPTION);
        $this->getProperties()->setKeywords(self::KETWORDS);
        $this->getProperties()->setCategory(self::CATEGROY);
    }

    /**
     * set header 
     * 
     * @param string $platform platform 
     * 
     * @issue 2580
     * @return null
     */
    public function setHeader($platform) {
        $this->setActiveSheetIndex(0);
        $headers  = DepositFinancialProductsPeer::translateFieldsMaps($platform);
        $header = array_values($headers);
        foreach (self::getColumns() as $key => $column) {
            $this->getActiveSheet()->setCellValue($column.'1', $header[$key]);
            //set cell width
            $this->getActiveSheet()->getColumnDimension($column)->setWidth(15);
            //set cell border style
            $this->getActiveSheet()->getStyle($column.'1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->getActiveSheet()->getStyle($column.'1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->getActiveSheet()->getStyle($column.'1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $this->getActiveSheet()->getStyle($column.'1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //freeze pane
            $this->getActiveSheet()->freezePaneByColumnAndRow(1, 2);
        }
    }
    
    /**
     * set special row
     * 
     * @param string $platform platform
     * 
     * @issue 2580
     * @return null
     */
    public function setSpecialRow($platform) {
        $this->getActiveSheet()->getColumnDimension('A')->setWidth(35);
        $this->getActiveSheet()->setCellValue("A1", $this->_getFieldDescription($platform));
        //Set alignments 
        $this->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        //set warp
        $this->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);  
    }
    
    /**
     * get fields description
     * 
     * @param string $platform platform 
     * 
     * @issue 2580
     * @return string
     */
    private function _getFieldDescription($platform) {
        $description = '';
        $specialFields = DepositAttributesPeer::fetchStandardAdapterList();
        $headers  = DepositFinancialProductsPeer::translateFieldsMaps($platform);
        $haystack = array_keys($headers);
        foreach ($specialFields as $field => $pieces) {
            if (in_array($field, $haystack)) {
                $description .= sprintf(util::getMultiMessage("%s The Field Must Be Set【%s】"), $headers[$field], implode(',', $pieces)) . PHP_EOL;
            }
        }
        return $description;
    }

    /**
     * set excel 
     * 
     * @param string $platform platform 
     * 
     * @issue 2580
     * @return null
     */
    public function setExcel($platform) {
        $this->setProperty();
        $this->setHeader($platform);
        $this->setSpecialRow($platform);
    }
            
    /**
     * get columns
     * 
     * @issue 2580
     * @return array
     */
    public static function getColumns() {
        return array(
            'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC'
        );
    }

    /**
     * get file extension 
     * 
     * @issue 2580
     * @return array
     */
    public static function getExtension() {
        return array(
            ''         => '-Select-',
            self::XLS  => self::XLS ,
            self::XLSX => self::XLSX,
            self::CSV  => self::CSV,
            self::PDF  => self::PDF,
        );
    }
    
    /**
     * get class name
     * 
     * @param string $extension file format
     * 
     * @issue 2580
     * @return mixed
     */
    public static function getClass($extension = '') {
        $class = array(
            self::XLS  => 'Excel5',
            self::XLSX => 'Excel2007',
            self::CSV  => 'CSV',
            self::PDF  => 'PDF',
        );
        if ($extension) {
            return $class[$extension];
        }
        return $class;
    }
    
    /**
     * read excel
     * 
     * @param string $filename filename
     * @param string $class    class name
     * 
     * @issue 2580
     * @return object
     */
    public function load($filename, $class) {
        $class = "PHPExcel_Reader_" . $class;
        $object = new $class;
        return $object->load($filename);
    }
    
    /**
     * get platform
     * 
     * @param string $platform platform name
     * 
     * @issue 2580
     * @return mixed
     */
    public static function getPlatform($platform = ''){
        $platforms = array(
            ''            => '-select-',
            self::TENCERT => util::getMultiMessage(self::TENCERT),
            self::JNLC    => util::getMultiMessage(self::JNLC),
        );
        if ($platform) {
            return $platforms[$platform];
        }
        return $platforms;
    }
    
    
}
