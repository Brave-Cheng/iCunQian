<?php
class startDateCompare extends sfValidator{
    public function execute(&$value, &$error){
        $field1 = $this->getParameter('field1');
        $field2 = $this->getParameter('field2');
        $request = sfContext::getInstance()->getRequest();
        
        $startDate = $request->getParameter($field1);
        $endDate = $request->getParameter($field2);
        if($startDate && $endDate){
            if(date('Y-m-d', strtotime($startDate)) > date('Y-m-d', strtotime($endDate))){
                $error = $this->getParameter('msg');
                return false;
            }
        }
        return true;
    }
}