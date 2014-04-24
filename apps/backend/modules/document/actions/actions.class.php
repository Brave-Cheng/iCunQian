<?php
/**
 * 
 * @package    oa
 * @subpackage document   
 * @author     ice.leng<ice.leng@expacta.com.cn>
 * @date       2013-10-25    
 * @issue      2324 - document manager
 * @desc       document manager
 */
class documentActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }
    /**
     *             $pid  - Page to return to project id
     *             $projectIds - return to not repeat the id of the project
     *             $pager 
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2324 - document manager
     * @desc       get all document
     */
    public function executeIndex(){
        $this->projectIds = $projectIds = ProjectPeer::doSelect(new Criteria());
        $pid = $this->getRequestParameter('projectId');
        $this->pid = $pid;
        $keyWords = trim(urldecode($this->getRequestParameter('keywords')));
        $keyWords = util::replaceSpecialChar($keyWords);
        if(!$pid){ 
            $sql  = 'SELECT  * FROM %%document%% ';
            $sql .= ' LEFT JOIN  %%projectDocument%% ON %%document%%.ID=%%projectDocument%%.DOCUMENT_ID ';
            $sql .= ' LEFT JOIN  %%project%% ON %%projectDocument%%.PROJECT_ID = %%project%%.ID  WHERE 1=1 ';
            $keyWords = trim(urldecode($this->getRequestParameter('keywords')));
            $keyWords = util::replaceSpecialChar($keyWords);
            $p = array();
            $andArray = array();
            if(strlen($keyWords)){
                $andArray[] = '  %%document%%.title LIKE ?';
                $p[] = "%$keyWords%";
                $andArray[] = '  %%document%%.proprietor LIKE ?';
                $p[] = "%$keyWords%";
                $andArray[] = '  %%document%%.block_number LIKE ?';
                $p[] = "%$keyWords%";
                $andArray[] = '  %%document%%.document_number LIKE ?';
                $p[] = "%$keyWords%";
                $andArray[] = '  %%document%%.contract_number LIKE ?';
                $p[] = "%$keyWords%";
                $andArray[] = '  %%document%%.issue LIKE ?';
                $p[] = "%$keyWords%";
                $andArray[] = '  %%project%%.name LIKE ?';
                $p[] = "%$keyWords%";
            }
            if($andArray){
                $sql .= ' AND (' . implode(' OR ', $andArray) . ')';
            }           
            $sql .= ' ORDER BY %%document%%.ID DESC';  
            $sql = str_replace("%%projectDocument%%" , ProjectDocumentPeer::TABLE_NAME, $sql);
            $sql = str_replace("%%document%%" , DocumentPeer::TABLE_NAME, $sql);
            $sql = str_replace("%%project%%" , ProjectPeer::TABLE_NAME, $sql);
            $this->pager = $pager = DBUtil::pagerSql($sql, $p, "DocumentPeer");
            return;
        }
        $sql = 'SELECT * FROM  %%document%% , %%projectDocument%%
                WHERE %%projectDocument%%.PROJECT_ID=? ';
        $sql .= 'AND %%document%%.ID=%%projectDocument%%.DOCUMENT_ID';
        $p    = array($pid);
        $sql  = str_replace("%%projectDocument%%" , ProjectDocumentPeer::TABLE_NAME, $sql);
        $sql  = str_replace("%%document%%" , DocumentPeer::TABLE_NAME, $sql);
        $pager = DBUtil::pagerSql($sql, $p, "DocumentPeer");
        $this->pager = $pager;

        
    }
    public function getDoucmentInfo(){
        $this->documentObj = $documentObj = DocumentPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($this->documentObj);
        $phase = 2;
        $projectId = $this->getRequestParameter('project');
        $pid = $this->getRequestParameter('pid');
        $c = new Criteria();
        $c->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getRequestParameter('id'));
        if($projectId ){
            $c->add(ProjectDocumentPeer::PROJECT_ID, $projectId);
        }
        $this->projectDocument = $projectDocument = ProjectDocumentPeer::doSelectOne($c);
        if($pid == null && $projectId == null){
            $projectId = $projectDocument->getProjectId();
        }
        $criteria = new Criteria();
        $criteria->add(ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_NOT_END);
        $this->projectObj = ProjectPeer::doSelect($criteria);
        $project = ProjectPeer::retrieveByPK($projectId);
        if($projectDocument && $projectDocument->getProject() && $projectId != null){
            $phase = $this->projectDocument->getProject()->getPhase();
        }
        if($project){
            $phase = $project->getPhase();
        }
        $this->dataPhase = $phase;
    }
    public function executeRead(){
        $this->getDoucmentInfo();
    }
    /**
     * 
     *             $projectDocument -  document and project associated objects
     *             $projectObj      -  project   object
     *             $documentObj     -  document  object     
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-13    
     * @issue      2324 - document manager 
     * @desc       create document data
     */
    public function executeAdd(){
        $this->documentObj = $documentObj = new Document();
        $c = new Criteria();
        $c->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getRequestParameter('id'));
        $this->projectDocument = ProjectDocumentPeer::doSelectOne($c);
        $criteria = new Criteria();
        $criteria->add(ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_NOT_END);
        $this->projectObj = ProjectPeer::doSelect($criteria);
    }
    /**
     *             $this->getRequestParameter('id')  - page to return to document id  
     *             $projectDocument -  document and project associated objects
     *             $projectObj      -  project   objects
     *             $documentObj     -  document  objects
     *             id  - database to store the id of the document
     *             msg  - number of judgement     
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-13    
     * @issue      2324 - document manager 
     * @desc       insert document
     */
    public function executeInsert(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $documentObj = new Document();
            $projectDocument = new ProjectDocument();
            $this->modifideInfo($documentObj, $projectDocument);
            return $this->redirect("document/add?id=" . $documentObj->getId() . "&msg=1" );
        }else{
            $this->forward404();
        }
    }
    public function handleErrorInsert(){
        return $this->forward('document', 'add');
    }
    /**
     *
     *             page to return to all data
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-28
     * @issue      2324 - document manager
     * @desc       Matching to submit information and database information exists
     */
    public function validateInsert(){
        $documentNumber = trim($this->getRequestParameter('documentNumber'));
        $c = new Criteria();
        $c->add(DocumentPeer::DOCUMENT_NUMBER, $documentNumber);
        $documentObj = DocumentPeer::doSelect($c);
        if($documentObj){
            $this->getRequest()->setError( 'documentNumber', '文档编号已存在' );
            return false;            
        }
        return true;
    }
    /**
     *             $projectDocument -  document and project associated objects
     *             $projectObj      -  project   object
     *             $documentObj     -  document  object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2324 - document manager    
     * @desc       Modify the document information
     */
    public function executeEdit(){
        $this->getDoucmentInfo();
    }
    /**
     * 
     *             $this->getRequestParameter('id')  - page to return to document id  
     *             $projectDocument -  document and project associated objects
     *             $projectObj      -  project   objects
     *             $documentObj     -  document  objects
     *             id  - database to store the id of the document
     *             msg  - number of judgement
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2324 - document manager
     * @desc       document update
     */
    public function executeUpdate(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
           $documentObj = DocumentPeer::retrieveByPK($this->getRequestParameter('id')) ;
           $this->forward404Unless($documentObj);
           $c = new Criteria();
           $c->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getRequestParameter('id'));
           $projectDocument = ProjectDocumentPeer::doSelectOne($c);
           $this->forward404Unless($projectDocument);
           $this->modifideInfo($documentObj, $projectDocument);
           return $this->redirect("document/edit?id=" . $documentObj->getId() . "&" . html_entity_decode(util::formGetQuery('projectId','pager')).'&msg=1' );
        }else{
            $this->forward404();
       }
    }
    public function handleErrorUpdate(){
        return $this->forward('document', 'edit');        
    }

    public function modifideInfo($documentObj,  $projectDocument){
        $blockNumber = $this->getRequestParameter('blockNumber');
        if($this->getRequestParameter('project')){
            $project = ProjectPeer::retrieveByPK($this->getRequestParameter('project'));
            $blockNumber = $project->getPhase() == ProjectPeer::TENDERING_PHASE ? null : $this->getRequestParameter('blockNumber');
        }
        $documentObj->setDocumentNumber(trim($this->getRequestParameter('documentNumber')));
        $documentObj->setTitle(trim($this->getRequestParameter('title')));
        $documentObj->setProprietor(trim($this->getRequestParameter('proprietor')));
        $documentObj->setBlockNumber($blockNumber);
        $documentObj->setModifier(trim($this->getUser()->getUserId()));
        $documentObj->setIssue(trim($this->getRequestParameter('issue')));
        $documentObj->setContractNumber(trim($this->getRequestParameter('contractNumber')));
        $documentObj->save();
        $projectDocument->setProjectId($this->getRequestParameter('project'));
        $projectDocument->setDocumentId($documentObj->getId());
        $projectDocument->save();
    }
    /**
     * 
     *             page to return to all data
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-28    
     * @issue      2324 - document manager
     * @desc       Matching to submit information and database information exists
     */
    public function validateUpdate(){
        $phase = 2;
        $project = null;
        $id = trim($this->getRequestParameter('id'));
        $projectId = $this->getRequestParameter('project');
        $document = DocumentPeer::retrieveByPK($id);
        $documentNumber = trim($this->getRequestParameter('documentNumber'));
        $c = new Criteria();
        $c->add(DocumentPeer::DOCUMENT_NUMBER, $documentNumber);
        $documentObj = DocumentPeer::doSelect($c);
        // modified blockNumber
        $blockNumber = trim($this->getRequestParameter('blockNumber'));
        $criteria = new Criteria();
        $criteria->add(ProjectDocumentPeer::DOCUMENT_ID, $id);
        $projectDocument = ProjectDocumentPeer::doSelectOne($criteria);
        if($projectId != null){
            $project = ProjectPeer::retrieveByPK($projectId);
            $phase = $project->getPhase();
        }elseif($projectDocument->getProject()){
            $phase = $projectDocument->getProject()->getPhase();
        }
        
        if($phase == ProjectPeer::PROJECT_PHASE && $project && $blockNumber == null){
            $this->getRequest()->setError( 'blockNumber',  '标段号不能为空');
            return false;
        }elseif($project == null && $blockNumber == null){
            $this->getRequest()->setError( 'blockNumber',  '标段号不能为空');
            return false;
        }
        if($documentObj){
            if($id && $document->getDocumentNumber() == $documentNumber){                                                           
                return true;
            }else{
                
                $this->getRequest()->setError( 'documentNumber', '文档编号已存在' );
                return false;
            }
           
        } 
            
        return true;
    }
    /**
     * 
     *             $deleteId - page to return to document id
     *             $documentObj  -  document object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2324 - document manager
     * @desc       delete the document data in the database
     */
    public function executeDelete(){
        $deleteId = $this->getRequestParameter("deleteId");
        if($deleteId){         
            if(is_array($deleteId)){
                $documentObjs = DocumentPeer::retrieveByPKs($deleteId);
                $this->forward404Unless($documentObjs);
                foreach ($documentObjs as $documentObj){
                    $documentObj->delete();
                }               
            }else{                         
                $documentObj = DocumentPeer::retrieveByPK($deleteId);
                $this->forward404Unless($documentObj);
                $documentObj->delete();
            }
          $this->setFlash('flag', '1');
          return  $this->redirect('document/index?' . html_entity_decode(util::formGetQuery('projectId', 'pager')));
        }
        $this->setFlash('flag', '0');
        $this->redirect('document/index?' . html_entity_decode(util::formGetQuery( 'projectId', 'pager')));
    }
    /**
     *             $documentNumber - page to return to documentNumber
     * @return     1 , 0
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-30
     * @issue      2329 - projectDocument  manager
     * @desc
     */
    public function executeValidateDocumentNumber(){
        $documentNumber = $this->getRequestParameter('documentNumber');
        $c = new Criteria();
        $c->add(DocumentPeer::DOCUMENT_NUMBER, $documentNumber);
        $documentObj = DocumentPeer::doSelect($c);
        echo $documentObj ? 1 : 0 ;
        exit;
    }
    
    public function executeValidateProjectPhase(){
        $phase = 2;
        $projectId = $this->getRequestParameter('projectId');
        $project = ProjectPeer::retrieveByPK($projectId);
        if($project){
            $phase = $project->getPhase();
        }
        $this->phase = $phase;
        echo $phase;
        exit;
    }
    /**
     * 
     *       
     * @return     true false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-12    
     * @issue      2324 - document manager
     * @desc       validate add and edit page data is modifier
     */
    public function executeCheckDocument(){
        $status = false;
        $paramets = array(
                'Proprietor' => $this->getRequestParameter('proprietor'),
                'BlockNumber' => $this->getRequestParameter('blockNumber'),
                'DocumentNumber' => $this->getRequestParameter('documentNumber'),
                'Title' => $this->getRequestParameter('title'),
                'ContractNumber' => $this->getRequestParameter('contractNumber'),
                'Issue' => $this->getRequestParameter('issue')             
        );
        $projectId = $this->getRequestParameter('project');       
        if($this->getRequestParameter('id')){
            $documentObj = DocumentPeer::retrieveByPK($this->getRequestParameter('id')) ;
            $c = new Criteria();
            $c->add(ProjectDocumentPeer::DOCUMENT_ID, $this->getRequestParameter('id'));
            $projectDocument = ProjectDocumentPeer::doSelectOne($c);
            $dataProjectId = $projectDocument->getProject()? $projectDocument->getProject()->getId() : '';  
            // validate project name
            $validate = util::isModified($documentObj, 'DocumentPeer', $paramets);
            if($projectId != $dataProjectId || $validate){
                $status = true;
            }
        }elseif($this->getRequestParameter('projectId')){
            // project document validate 
            $document = array();
            $projectId = $this->getRequestParameter('projectId');
            $paramets = array(
                    'DocumentNumber' => $this->getRequestParameter('documentNumber'),
                    'Title' => $this->getRequestParameter('title'),
                    'ContractNumber' => $this->getRequestParameter('contractNumber'),
                    'Issue' => $this->getRequestParameter('issue')
            );
            $c = new Criteria();
            $c->add(ProjectDocumentPeer::PROJECT_ID, $projectId);
            $c->addAscendingOrderByColumn(ProjectDocumentPeer::ID);
            $projectDocuments = ProjectDocumentPeer::doSelect($c);
            if($projectDocuments){
                foreach ($projectDocuments as $projectDocument){
                    $document[] = isset($projectDocument) ? $projectDocument->getDocument() : null;
                }
            }
            $status = util::isModified($document, 'DocumentPeer', $paramets);
        }else{ 
            // validate project
            foreach ($paramets as $paramet){
                if($paramet != null || $projectId != null){
                    $status = true;
                }
            }
        } 
        exit($status);     
    }

    /**
     * 
     *             $selectIds - page to return to document id
     *             $documentObj  -  document object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2324 - document manager    
     * @desc       export file
     */
    public function executeExportcsv() {
        $selectIds = $this->getRequestParameter("deleteId");
        $all = $this->getRequestParameter("type");
        $documentObj = DocumentPeer::retrieveByPKs($selectIds);
        if($all){
            $documentObj = DocumentPeer::doSelect(new Criteria());
        }       
        // new object
        $objExcel = new PHPExcel();
        // for other version format
        $objWriter = new PHPExcel_Writer_Excel5($objExcel);  
        // the basic properties set documents
        $objProps = $objExcel->getProperties();
        $objProps->setCreator("Zeal Li");
        $objProps->setLastModifiedBy("Zeal Li");
        $objProps->setTitle("Office XLS Test Document");
        $objProps->setSubject("Office XLS Test Document, Demo");
        $objProps->setDescription("Test document, generated by PHPExcel.");
        $objProps->setKeywords("office excel PHPExcel");
        $objProps->setCategory("Test");
        
        //set the current sheet indexes for the content of the subsequent operation.
        //generally only when using multiple sheet need to display the call.
        //By default，PHPExcel Automatically created the first sheet set SheetIndex=0
        $objExcel->setActiveSheetIndex(0);
        $objActSheet = $objExcel->getActiveSheet();
        //The name of the sheet set the current activity
        $objActSheet->setTitle('Sheet');
        
        //Set the cell contents by PHPExcel automatic judgment according to the incoming cell content type
        
        $style = array(
                "borders" => array(
                        "inside" => array(
                                "style" => PHPExcel_Style_Border::BORDER_THIN,
                                "color" => array('rgb' => 'cfcfcf'),
                        )
                
                )
        );
        
        //set header
        $objActSheet->setCellValue('A1', util::getI18nMessage('文档编号')); 
        $objActSheet->setCellValue('B1', util::getI18nMessage('标题'));            
        $objActSheet->setCellValue('C1', util::getI18nMessage('项目名称'));         
        $objActSheet->setCellValue('D1', util::getI18nMessage('业主')); 
        $objActSheet->setCellValue('E1', util::getI18nMessage('标段号'));
        $objActSheet->setCellValue('F1', util::getI18nMessage('合同号'));
        $objActSheet->setCellValue('G1', util::getI18nMessage('期号'));
        //set header background color and border color
        $objActSheet->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objActSheet->getStyle('A1:G1')->getFill()->getStartColor()->setARGB('00279ae5');
        $objActSheet->getStyle("A1:G1")->applyFromArray($style);
       
        // set export data
        foreach ($documentObj as $key=>$document){   
            // set the background color in a row
            $color = ($key+2)%2 !=0?'00f2f7f9':'00ffffff';   
            $number = ($key+2);
            $objActSheet->getStyle("A$number:G$number")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objActSheet->getStyle("A$number:G$number")->getFill()->getStartColor()->setARGB($color);
            $objActSheet->getStyle("A$number:G$number")->applyFromArray($style);
            $objActSheet->getStyle("A$number:G$number")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle("A$number:G$number")->getBorders()->getBottom()->getColor()->setARGB('00cfcfcf');
            $objActSheet->getStyle("A$number:G$number")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle("A$number:G$number")->getBorders()->getRight()->getColor()->setARGB('00cfcfcf');
            // data
            $objActSheet->setCellValueExplicit('A'.($key+2), util::getI18nMessage(htmlspecialchars($document->getDocumentNumber())), PHPExcel_Cell_DataType::TYPE_STRING2);
            $objActSheet->setCellValueExplicit('B'.($key+2), util::getI18nMessage(htmlspecialchars($document->getTitle())), PHPExcel_Cell_DataType::TYPE_STRING2);
            $projectName = $document->getProjectDcoumentByDocument()?$document->getProjectDcoumentByDocument()->getProject()->getLongName():'';
            $objActSheet->setCellValueExplicit('C'.($key+2), util::getI18nMessage(htmlspecialchars($projectName)), PHPExcel_Cell_DataType::TYPE_STRING2);
            $objActSheet->setCellValueExplicit('D'.($key+2), util::getI18nMessage(htmlspecialchars($document->getProprietor())), PHPExcel_Cell_DataType::TYPE_STRING2);
            $objActSheet->setCellValueExplicit('E'.($key+2), util::getI18nMessage(htmlspecialchars($document->getBlockNumber())), PHPExcel_Cell_DataType::TYPE_STRING2);
            $objActSheet->setCellValueExplicit('F'.($key+2), util::getI18nMessage(htmlspecialchars($document->getContractNumber())), PHPExcel_Cell_DataType::TYPE_STRING2);
            $objActSheet->setCellValueExplicit('G'.($key+2), util::getI18nMessage(htmlspecialchars($document->getIssue())), PHPExcel_Cell_DataType::TYPE_STRING2);
        }
        
        //default width
        $objExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(24);
        //default height
        $objExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        //export
        $fileName = '文档下载'.date('Y-m-d',time()).".xls";
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="'.$fileName.'"');
        header("Content-Transfer-Encoding: binary");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $objWriter->save('php://output');
        exit;
    }

}
