<?php include_partial('global/confirm'); ?>
<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo form_tag('project/insertDocument?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")), 'method=post multipart=true id=document') ?>

<div id="content" class="right">
   <div class="bread_crumbs">
   <a class="jump" href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")))?>"><?php echo __('项目管理') ?></a> &gt; <a class="jump" href="<?php echo url_for('project/createProjectType');?>">创建项目</a> &gt; <span><?php echo __('第四部：关联文档记录') ?></span> </div>
    <div class="box">
        <div class="mb15"><?php  echo __('请为您新创建的公司项目 ') . $projectData['name'] . __(' 关联文档记录（您也可以跳过此步骤在项目创建后，在项目列表或者是文档管理模块内关联文档）：'); ?></div>
        <div class="tables">
        <table>
                <thead>
                <tr>
                    <td class="w120"><?php echo __('文档编号') ?></td>
                    <td class="w120"><?php echo __('标题') ?></td>
                    <td class="w120"><?php echo __('合同号') ?></td>
                    <td class="w120"><?php echo __('期号') ?></td>
                    <td class=></td>
                </tr>
                </thead>
                <tbody id="doc_list">
                    <?php if($documents){?>
                    <?php foreach ($documents['titles'] as $key=>$document){?>
                    <tr <?php if( $key%2 ){ echo "class='odd'"; } ?>>
                        <td><input type="text" name="documentNumber[]" readOnly="readOnly" value="<?php echo htmlspecialchars($documents['documentNumbers'][$key])?>"/></td>
                        <td><input type="text" name="title[]" readOnly="readOnly"  value="<?php echo htmlspecialchars($document)?>" /></td>
                        <td><input type="text" name="contractNumber[]" readOnly="readOnly"  value="<?php echo htmlspecialchars($documents['contractNumbers'][$key])?>"/></td>
                        <td><input type="text" name="issue[]" readOnly="readOnly"  value="<?php echo htmlspecialchars($documents['issues'][$key])?>" /></td>
                        <td class="operate"><a href="javascript:void(0);" readOnly="readOnly" class="deleRow " onclick="deleRow(this);">删除</a></td>
                    </tr>
                    <?php }?>
                    <?php }?>
                </tbody>         
                <tfoot id="doc_btn">
                    <tr>
                        <td>
                            <input type="text" class="txt" name="" value="" id="documentNumber">
                            <div class="error" style="display:none"><?php echo __('请填写文档编号')?></div>
                        </td>
                        <td>
                            <input type="text" class="txt" name="" value="" id="title">
                            <div class="error" style="display:none"><?php echo __('请填写标题')?></div>
                        </td>
                        <td>
                            <input type="text" class="txt" name="" value="" id="contractNumber">
                            <div class="error" style="display:none"><?php echo __('请填写合同号')?></div>
                        </td>
                        <td>
                            <input type="text" class="txt" name="" value="" id="issue">
                            <div class="error" style="display:none"><?php echo __('请填写期号')?></div>
                        </td>
                        <td class="alignCenter"><a href="javascript:;" onclick="" class="btn_blue f_none" id="addDocBtn">添加文档</a></td>
                    </tr>
                </tfoot>
            </table>
         </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <?php if($projectData['phase'] == ProjectPeer::PROJECT_PHASE && ProjectPeer::INNER_PROJECT == $projectData['type']):?>
                <input type="submit" onclick="dataTitle();return false;" value="<?php echo __('确认文档关联并设置里程碑');?>" class="btn_blue" id="documentSubmit"/>
                <?php elseif($projectData['phase'] == ProjectPeer::TENDERING_PHASE || ProjectPeer::OUTSOURCE_PROJECT == $projectData['type']):?>
                <input type="submit" onclick="dataTitle();return false;" value="<?php echo __('确认创建项目');?>" class="btn_blue" id="documentSubmit"/>
                <?php endif;?>
                <a href="<?php echo url_for('project/addProjectMember'); ?>" class="btn_blue jump"><?php echo __('返回添加项目成员');?></a>
                <a href="<?php echo url_for('project/index'); ?>" class="btn_blue jump"><?php echo __('放弃并返回');?></a>
            </div>
        </div>
    </div>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){     
	$(".jump").leaveCheck({formId:'document',formUrl:'<?php echo url_for("document/checkDocument"); ?>'});
});
$(function(){
    var rowNum=$('#doc_list tr').length;
    $('#addDocBtn').click(function(){
        var errNum=0;
        var _tbody=$('#doc_list');
        var _docNum=$('#documentNumber');
        var _docTitle=$('#title');
        var _contractNo=$('#contractNumber');
        var _issueNo=$('#issue');
        var _docNumArr=[];
        var _str='';      
       
        $('#doc_list .documentNumber').each(function(){
            _docNumArr.push($(this).val());
        })
        
        
        if($.trim(_docNum.val())==''){
            _docNum.next('div.error').show();
            errNum+=1;
        }else{
            _docNum.next('div.error').hide();
        }
        if($.inArray(_docNum.val(), _docNumArr) >= 0){
            _docNum.next('div.error').text('文档编号已存在!').show();            
            errNum+=1;
        }else{
            _docNum.next('div.error').text('请填写文档编号');
        }
        
        if(_docTitle.val()==''){
            _docTitle.next('div.error').show();
            errNum+=1;
        }else{
            _docTitle.next('div.error').hide();
        }

        if($.trim(_contractNo.val())==''){
            _contractNo.next('div.error').show();
            errNum+=1;
        }else{
            _contractNo.next('div.error').hide();
        }

        if($.trim(_issueNo.val())==''){
            _issueNo.next('div.error').show();
            errNum+=1;
        }else{
            _issueNo.next('div.error').hide();
        }
        if(errNum > 0){
        	$('#documentSubmit').unbind('click'); 
        	$('#documentSubmit').bind('click',function(){
        	    return false;
            })
            return false;
        }       
        
        $.ajax({
            type:"POST",
            url:"<?php echo url_for('document/validateDocumentNumber')?>",
            data:"documentNumber="+_docNum.val(),
            dataType:"json",
            error:function(){
                alert("当前ajax操作出错！");
            },
            success:function(msg){
                if(msg){              	
                    _docNum.next('div.error').text('文档编号已存在!').show();  
                    $('#documentSubmit').unbind('click');             
                    $('#documentSubmit').bind('click',function(){
                        return false;
                     })
                    return false;                 
                }else{
                	$('#documentSubmit').unbind('click');  
                	if(rowNum%2==1){
                        _str='<tr class="odd">';
                    }else{
                        _str='<tr>';
                    }
                    _str = $(_str+'<td><input type="text" class="documentNumber" readOnly="readOnly" name="documentNumber[]" value="'+_docNum.val() +'"/></td><td><input type="text" readOnly="readOnly" name="title[]" value="'+ _docTitle.val() +'" /></td><td><input type="text" readOnly="readOnly" name="contractNumber[]" value="'+ _contractNo.val() +'"/></td><td><input type="text" readOnly="readOnly" name="issue[]" value="'+ _issueNo.val() +'" /></td><td class="operate"><a href="javascript:void(0);" class="deleRow " onclick="deleRow(this);">删除</a></td></tr>');
                    _tbody.append(_str);
                    rowNum++;
                    _docNumArr.push(_docNum.val());
                    
                    $('#documentNumber,#title,#contractNumber,#issue').val('');
                }                    
            }
        });
               

    })
})
function dataTitle(){
    var _tbody=$('#doc_list');
    var _docNum=$('#documentNumber');
    var _docTitle=$('#title');
    var _contractNo=$('#contractNumber');
    var _issueNo=$('#issue');
    
    if(_contractNo.val() != '' || _docNum.val() != '' || _docTitle.val() != '' || _issueNo.val()!= '' ){
         showSaveSuccessfullyMessage("<?php echo __('请点击添加文档，文档记录才能保存');?>");
         return false;
    }
    $('#document').submit();
    return false;
}
function deleRow(obj){
    var _this=$(obj);
    var _tr=_this.parent().parent();
    _tr.remove();
}
</script>