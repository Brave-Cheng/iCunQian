<?php
class oaApiActions extends baseOaActions
{
    public function executeIndex(){
        exit('you.wu');
    }
    public function executeLogin(){
        //http://oa.test.expacta.com.cn/frontend.php/oaApi/login?tel=MTkwNjU3MzUwNTA=&password=e7d6c6ef936c9e1a5a60225c94b111a3
        try{  
            $tel      = $this->getRequestParameter('tel');
            $tel      = $this->getTel($tel);          
            $password = $this->getRequestParameter('password');   
            $responseData = sfGuardUserProfilePeer::authorizationLogin($tel, $password);
            return $this->getResponseData($responseData); 
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }           
    }
    public function executeForgetPassword(){
        //http://oa.test.expacta.com.cn/frontend.php/oaApi/forgetPassword?tel=MTkwNjU3MzUwNTA=&name=ice
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);       
            $responseData = sfGuardUserProfilePeer::forgetPassword($tel);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    public function executeChangePassword(){
        //http://oa.test.expacta.com.cn/frontend.php/oaApi/changePassword?tel=MTkwNjU3MzUwNTA=&oldPassword=21232f297a57a5a743894a0e4a801fc3&newPassword=e7d6c6ef936c9e1a5a60225c94b111a3      
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $oldPassword  = $this->getRequestParameter('oldPassword');
            $newPassword  = $this->getRequestParameter('newPassword');
            $responseData = sfGuardUserProfilePeer::changePassword($tel, $oldPassword, $newPassword);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    public function executeGetUserInfo(){
        //http://oa.test.expacta.com.cn/frontend.php/oaApi/getUserInfo?tel=MTkwNjU3MzUwNTA=
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $responseData = sfGuardUserProfilePeer::getUserInfo($tel);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
            
    public function executeSignIn(){  
      //http://oa.test.expacta.com.cn/frontend.php/oaApi/SignIn?tel=MTkwNjU3MzUwNTA=&project_id=2&longitude=20&lattitude=11&address=成都
        try{    
           $tel  = $this->getRequestParameter('tel');
           $tel  = $this->getTel($tel);
           $projectId = $this->getRequestParameter('project_id');
           $longitude = $this->getRequestParameter('longitude');
           $lattitude = $this->getRequestParameter('lattitude');
           $address   = $this->getRequestparameter('address');
           $signInfo = array(
                 'projectId' => $projectId,
                 'longitude' => $longitude,
                 'lattitude' => $lattitude,
                 'address'   => $address
           );  
           $responseData = SignInPeer::signIn($tel, $signInfo);
           return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }             
    }
    
    public function executeGetProject(){
        //http://oa.test.expacta.com.cn/frontend.php/oaApi/GetProject?tel=MTkwNjU3MzUwNTA
        try{   
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $responseData = ProjectMemberPeer::getProject($tel);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    public function executeUpdateUserInfo(){
        //http://oa.test.expacta.com.cn/frontend.php/oaApi/updateUserInfo?tel=MTkwNjU3MzUwNTA&name=ice&telephone=13881748303&email=4200855833@qq.com
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $userParams = array(
                    'name'=>$this->getRequestParameter('name'),
                    'gender'=>$this->getRequestParameter('gender'),
                    'telephone'=>$this->getRequestParameter('telephone'),
                    'qq'=>$this->getRequestParameter('qq'),
                    'email'=>$this->getRequestParameter('email'),
                    'title'=>$this->getRequestParameter('title'),
                    'superiorLeaders'=>$this->getRequestParameter('superiorLeaders'),
                    'headPhoto'=>$this->getRequestParameter('headPhoto'),
                    'signatureImage'=>$this->getRequestParameter('signatureImage')
            );
            $responseData = sfGuardUserProfilePeer::updateUserInfo($tel,$userParams);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }               
    }  
    public function executeUploadSignatureImage($tel){
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $responseData = sfGuardUserProfilePeer::uploadSignatureImage($tel);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    public function executeGetNotice(){
       // http://oa.test.expacta.com.cn/frontend.php/oaApi/getNotice?tel=MTkwNjU3MzUwNTA=&time=1381288169&num=2&page=1
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $time = $this->getRequestParameter('time');
            $num  = $this->getRequestParameter('num');
            $page = $this->getRequestParameter('page');
            $offsetId = $this->getRequestParameter('offsetId');
            $responseData = NotificationPeer::getNotice($tel, $time, $num, $page, $offsetId);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }        
    }
    public function executeSetReading(){
        // http://oa.test.expacta.com.cn/frontend.php/oaApi/setReading?tel=MTkwNjU3MzUwNTA=&id=11
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $id = $this->getRequestParameter('id');
            $responseData = NotificationPeer::setReading($tel, $id);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    /**
     *
     * @param
     * @return
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3
     * @issue      2344 - approval manager
     * @desc       get approval self work flow
     */
    public function executeGetWorkFlows(){
        // http://oa.test.expacta.com.cn/frontend.php/oaApi/getWorkFlows?tel=MTkwNjU3MzUwNTA=
        try{
            $tel = $this->getRequestParameter('tel');
            $tel = $this->getTel($tel);
            $responseData = ApplicationWorkFlowPeer::getWorkFlows($tel);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    /**
     * 
     * @param      
     * @return     
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3    
     * @issue      2344 - approval manager
     * @desc       get approval all work flow
     */
    public function executeGetWorkFlowInfo(){
       // http://oa.test.expacta.com.cn/frontend.php/oaApi/getWorkFlowInfo?tel=MTkwNjU3MzUwNTA=&id=2
        try{
            $tel = $this->getRequestParameter('tel');
            $tel = $this->getTel($tel);
            $id  = $this->getRequestParameter('id');
            $responseData = WorkflowPeer::getWorkFlowInfo($tel, $id);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    
    public function executeGetWorkFlowInfoById(){
        try{
            $tel = $this->getRequestParameter('tel');
            $tel = $this->getTel($tel);
            $id  = $this->getRequestParameter('id');
            $responseData = WorkflowPeer::getWorkFlowInfoById($tel, $id);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    
    /**
     * 
     * @param      
     * @return     
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3    
     * @issue      2344 - approval manager
     * @desc       get engineeringSummary templete
     */
    public function executeEngineeringSummary(){
        try{
            $tel = $this->getRequestParameter('tel');
            $this->tel = $this->getTel($tel);
            $this->id  = $this->getRequestParameter('applicationId');
            $paramets= ApplicationPeer::getFormDetail($this->tel, $this->id);
            $this->name = isset($paramets['name']) ? $paramets['name'] : null;
            $this->project= isset($paramets['project']) ? $paramets['project'] : null;
            $this->obj  = isset($paramets['obj']) ? $paramets['obj'] : null;
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    /**
     *
     * @param
     * @return
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3
     * @issue      2344 - approval manager
     * @desc       get engineeringMaterials templete
     */
    public function executeEngineeringMaterials(){
        try{
            $tel = $this->getRequestParameter('tel');
            $this->tel = $this->getTel($tel);
            $this->id  = $this->getRequestParameter('applicationId');
            $paramets= ApplicationPeer::getFormDetail($this->tel, $this->id);
            $this->name = isset($paramets['name']) ? $paramets['name'] : null;
            $this->project= isset($paramets['project']) ? $paramets['project'] : null;
            $this->obj  = isset($paramets['obj']) ? $paramets['obj'] : null;
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    /**
     *
     * @param
     * @return
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3
     * @issue      2344 - approval manager
     * @desc       get engineertingSettlement templete
     */
    public function executeEngineertingSettlement(){
        try{
            $tel = $this->getRequestParameter('tel');
            $this->tel = $this->getTel($tel);
            $this->id  = $this->getRequestParameter('applicationId');
            $paramets= ApplicationPeer::getFormDetail($this->tel, $this->id);
            $this->name = isset($paramets['name']) ? $paramets['name'] : null;
            $this->project= isset($paramets['project']) ? $paramets['project'] : null;
            $this->obj  = isset($paramets['obj']) ? $paramets['obj'] : null;
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    
    public function executeEngineertingGoods(){
        try{
            $tel = $this->getRequestParameter('tel');
            $this->tel = $this->getTel($tel);
            $this->id  = $this->getRequestParameter('applicationId');
            $paramets= ApplicationPeer::getFormDetail($this->tel, $this->id);
            $this->name = isset($paramets['name']) ? $paramets['name'] : null;
            $this->obj  = isset($paramets['obj']) ? $paramets['obj'] : null;
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    /**
     * 
     * @param      
     * @return     
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3    
     * @issue      2344 - approval manager
     * @desc       set approval
     */
    public function executeSetApprove(){
        //http://oa/frontend.php/oaApi/setApprove?tel=MTkwNjU3MzUwNTA=&id=18  
        try{
            $tel = $this->getRequestParameter('tel');
            $tel = $this->getTel($tel);
            $id  = $this->getRequestParameter('id');
            $status   = $this->getRequestParameter('status');
            $comment  = $this->getRequestParameter('comment');
            $responseData = ApprovalPeer::setApprove($tel, $id, $status, $comment);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    /**
     *
     * @param
     * @return
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-3
     * @issue      24044 - approval manager
     * @desc       search workFolw History by self 
     */
    public function executeGetApplicationWorkFlowHistories(){
        // http://oa.test.expacta.com.cn/frontend.php/oaApi/getWorkFlowInfo?tel=MTkwNjU3MzUwNTA=&id=2
        try{
            $tel  = $this->getRequestParameter('tel');
            $tel  = $this->getTel($tel);
            $num  = $this->getRequestParameter('num');
            $page = $this->getRequestParameter('page');
            $responseData = ApplicationWorkFlowPeer::getApplicationWorkFlowHistories($tel, $num, $page);
             return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    
    public function executeGetWorkFlowHistoryInfo(){
        // http://oa.test.expacta.com.cn/frontend.php/oaApi/getWorkFlowHistoryInfo?tel=MTkwNjU3MzUwNTA=&id=2
        try{
            $tel = $this->getRequestParameter('tel');
            $tel = $this->getTel($tel);
            $id  = $this->getRequestParameter('id');
            $responseData = WorkflowPeer::getWorkFlowHistoryInfo($tel, $id);
            return $this->getResponseData($responseData);
        }catch(Exception $e){
            return $this->returnSystemErrorMessage($e);
        }
    }
    
}

