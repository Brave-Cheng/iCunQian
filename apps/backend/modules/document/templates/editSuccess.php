<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo form_tag('document/update?'. html_entity_decode(formGetQuery("keywords", 'projectId')), 'id=document')?>
<?php echo formInputHiddenTag('id',$documentObj->getId())?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('document/index')?>"><?php echo __('文档管理') ?></a> &gt; <?php echo __('文档记录内容') ?>
    </div>
    <div class="box">
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="documentNumber"><?php echo __('文档编号：');?><em class="red">*</em></label>
           <div class="iner">
               <?php echo input_tag('documentNumber',$documentObj->getDocumentNumber())?> 
               <span class="error" > <?php echo form_span_error('documentNumber') ?></span>
           </div>
       </div>
    </div>   
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="title"><?php echo __('标题：');?><em class="red">*</em></label>
           <div class="iner">
               <?php echo input_tag('title',$documentObj->getTitle())?>
               <span class="error" > <?php echo form_span_error('title') ?></span>
           </div>
       </div>
    </div> 
    <div class="formDiv">
       <div class="formItem">
               <label class="label" for="project"><?php echo __('项目名称：');?>　</label>
               <?php if($projectDocument && ProjectPeer::retrieveByPK($projectDocument->getProjectId()) && ProjectPeer::retrieveByPK($projectDocument->getProjectId())->getIsProjectEnd() != ProjectPeer::IS_PROJECT_END){?>
                   <div class="iner lh30">
                        <?php echo input_hidden_tag('project', $projectDocument->getProjectId())?>
                        <?php echo ProjectPeer::retrieveByPK($projectDocument->getProjectId())->getName()?>
                   </div>
               <?php }else{?>
           <div class="iner">
                   <?php echo select_tag("project", objects_for_select($projectObj, "getId", "getName", $projectDocument ? $projectDocument->getProjectId() : '', array('include_custom' => '选择项目')),array('class'=>'select','onchange'=>'projectChange()'))?>
                   <?php echo input_hidden_tag('pid','1')?>
                   <span class="error"> <?php echo form_span_error('project') ?> </span>             
           </div>
               <?php }?>
               
       </div>
    </div> 
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="proprietor"><?php echo __('业主：');?><em class="red">*</em></label>
           <div class="iner">
              <?php echo input_tag('proprietor',$documentObj->getProprietor())?>
               <span class="error" id="proprietorError"> <?php echo form_span_error('proprietor') ?></span>
           </div>
       </div>
    </div> 
    <div class="formDiv">  
           <div class="formItem" id="phase" style="display:<?php if( $dataPhase == ProjectPeer::TENDERING_PHASE){echo 'none';}?>">
                   <label class="label" for="blockNumber"><?php echo __('标段号：');?><em class="red">*</em></label>
               <div class="iner">
                   <?php echo input_tag('blockNumber',$documentObj->getBlockNumber())?>
                   <span class="error" id="blockNumberError"> <?php echo form_span_error('blockNumber') ?> </span>
               </div>
           </div>
    </div> 
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="contractNumber"><?php echo __('合同号：');?><em class="red">*</em></label>
           <div class="iner">
               <?php echo input_tag('contractNumber',$documentObj->getContractNumber())?> 
               <span class="error" id="contractNumberError"> <?php echo form_span_error('contractNumber') ?></span>
           </div>
       </div>
    </div> 
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="issue"><?php echo __('期号：');?><em class="red">*</em></label>
           <div class="iner">
               <?php echo input_tag('issue',$documentObj->getIssue())?> 
               <span class="error" id="issueError"> <?php echo form_span_error('issue') ?></span>
           </div>
       </div>
    </div> 
    <div class="btn_con">                 
        <div class="btns clearfix">
           <input type="submit" value="<?php echo __('确认')?>" class="btn_blue" />
           <a href="<?php echo url_for('document/index?' . html_entity_decode(formGetQuery("keywords", 'projectId')));?>" class="btn_blue jump"><?php echo __('返回')?></a>
        </div>                
    </div> 
    </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        
        if(msg == '1'){
            showSaveSuccessfullyMessage( null, "<?php echo url_for('document/index?' . html_entity_decode(formGetQuery( 'projectId', 'pager'))); ?>" );
        }
        <?php if(!$documentObj->getId()){ ?>      
        $("input[name='documentNumber']").focus();
        <?php } ?>       
        
        $(".jump").leaveCheck({formId:'document',formUrl:'<?php echo url_for('document/checkDocument?' . html_entity_decode(formGetQuery('projectId', 'pager'))); ?>'});
    });
    function projectChange(){
    $.ajax({
         type:"POST",
         url:"<?php echo url_for('document/validateProjectPhase')?>",
         data:"projectId="+$('#project').val(),
         dataType:"json",
         success:function(msg){
              if(msg == '1'){
                  $('#phase').hide();
              }else{
          	     $('#phase').show();
              }
         }
     });       
    }
</script>
