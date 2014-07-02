<?php include_partial('global/confirm'); ?>
<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<?php if(!$project->getIsProjectEnd()){?>
<?php echo form_tag('projectDocument/update?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type", 'pager')), 'method=post multipart=true id=document') ?>
<?php }else{?>
<?php echo form_tag('projectDocument/update?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type", 'pager')), 'method=post multipart=true ') ?>
<?php }?>
<input type="hidden" name="projectId" value="<?php echo $project->getId();?>" />
<div id="content" class="right">
   <div class="bread_crumbs">
   <a class="jump" href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")))?>"><?php echo __('项目管理') ?></a> &gt; <a class="jump" href="<?php echo url_for('project/createProjectType');?>"><?php echo __('创建新项目') ?></a> &gt; <span><?php echo __('第四部：关联文档记录') ?></span> </div>
    <div class="box">
        <div class="mb15"><?php  echo __('您正在查看项目 ').$project->getName().__(' 关联文档记录（点击删除或者添加新记录）：'); ?></div>
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
                    <?php foreach ($documents as $key=>$document){?>
                    <tr <?php if( $key%2 ){ echo "class='odd'"; } ?>>
                        <td><input type="text" name="documentNumber[]" readOnly="readOnly" value="<?php echo htmlspecialchars($document->getDocument()->getDocumentNumber())?>" class="documentNumber"/></td>
                        <td><input type="text" name="title[]" readOnly="readOnly"  value="<?php echo htmlspecialchars($document->getDocument()->getTitle())?>" /></td>
                        <td><input type="text" name="contractNumber[]" readOnly="readOnly"  value="<?php echo htmlspecialchars($document->getDocument()->getContractNumber())?>"/></td>
                        <td><input type="text" name="issue[]" readOnly="readOnly"  value="<?php echo htmlspecialchars($document->getDocument()->getIssue())?>" /></td>
                        <td class="operate"><a href="javascript:void(0);" readOnly="readOnly" class="deleRow " onclick="deleRow(this);">删除</a></td>
                        <?php echo formInputHiddenTag('documentId[]', $document->getDocument()->getId())?>

                    </tr>

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
            <?php if(!$project->getIsProjectEnd()){?>
                <input type="submit" value="<?php echo __('保存');?>" onclick="dataTitle();return false;" class="btn_blue"  id="documentSubmit" />
            <?php }?>
                <a href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("keywords", "type", 'pager'))); ?>" class="btn_blue jump"  ><?php echo __('返回');?></a>
            </div>
        </div>
    </div>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    var msg = '<?php echo $sf_request->getParameter("msg");?>';
    if(msg == '1'){
        showSaveSuccessfullyMessage( null, "<?php echo url_for('project/index?'. html_entity_decode(formGetQuery("keywords", "type", 'pager'))); ?>" );
    }
    $(".jump").leaveCheck({formId:'document',formUrl:'<?php echo url_for("projectDocument/checkDocument"); ?>'});
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
        	$('#documentSubmit').bind('click',function(){
        	    return false;
            })
            return false;
        }       
 
        $.ajax({
            type:"POST",
            url:"<?php echo url_for('projectDocument/validateDocumentNumber')?>",
            data:"documentNumber="+_docNum.val(),
            dataType:"json",
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
                    _str = $(_str+'<td><input type="hidden" value="'+rowNum+'" name="addId"><input type="text" class="documentNumber" readOnly="readOnly" name="documentNumber[]" value="'+_docNum.val() +'"/></td><td><input type="text" readOnly="readOnly" name="title[]" value="'+ _docTitle.val() +'" /></td><td><input type="text" readOnly="readOnly" name="contractNumber[]" value="'+ _contractNo.val() +'"/></td><td><input type="text" readOnly="readOnly" name="issue[]" value="'+ _issueNo.val() +'" /></td><td class="operate"><a href="javascript:void(0);" class="deleRow " onclick="deleRow(this);">删除</a></td></tr>');
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
