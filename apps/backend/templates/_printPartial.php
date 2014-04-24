<?php 
    $application = ApplicationPeer::retrieveByPK($id);
    $approvalId = $application->getApprovalId();
    $workFlows = WorkflowPeer::getAllWorkFlowByApprovalId($approvalId);
    $applicationResults = ApplicationWorkFlowPeer::getApplicationResults($id, true);
    $count = count($workFlows);
?>
<table class="print_table mt20">
<?php foreach ($workFlows as $key => $workFlows): ?>
<?php if($key % 2  == 0){?>
<tr>
<?php }?>
    <td class="
    <?php if( $count%2 == 1 ){
              if($key == $count || $key == ($count - 1)){
                  echo 'noBorder';
              }
          }else{
              if($key == ($count - 1) || $key == ($count - 2)){
                  echo 'noBorder';
              }
          }
    ?>">
        <div class="formItem">
            <label class="label">
                <?php echo __('审核意见')?>
            </label>
            <div class="iner lh30">
               <span class="color ">：</span>
               <?php echo isset($applicationResults[$key]) ? $applicationResults[$key]->getApprovalComment() : null ?>
            </div>
        </div>
        <div class="formItem">
            <label class="label">
                <?php echo WorkflowPeer::getCurrentStepApproverRole($workFlows->getId(), $application->getDepartmentId()) ?>
            </label>
            <div class="iner lh30">
            <span class="color">：</span>
                <?php $userId = isset($applicationResults[$key]) ? $applicationResults[$key]->getSfGuardUserId() : null?>
                <?php $profile = sfGuardUserProfilePeer::getUserInfoById($userId);?>
                <?php echo$profile ? $profile->getLastName() . $profile->getFirstName() : null;?>
                
            </div>
        </div>
        <div class="formItem">
            <label class="label">
                <?php echo __('签名图片') ?> 
            </label>
            <div class="iner lh30 ">
                <span class="color imangePosition" >：</span>
                <?php if(sfGuardUserProfilePeer::getSingeByUserId($userId)){?>
                    <img src="<?php echo sfGuardUserProfilePeer::getSingeByUserId($userId)?>" height="100" >
                <?php }?>
            </div>
        </div>
    </td>
<?php endforeach; ?>

</tr>
</table>