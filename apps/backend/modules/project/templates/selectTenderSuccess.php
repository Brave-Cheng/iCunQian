<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <?php echo form_tag("project/addSelectTender", "id=addType") ?>
        <div class="bread_crumbs jump"> <a href="<?php echo url_for('project/index');?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('创建新项目') ?> &gt; <?php echo __('第一步:选择项目类型');?></span> </div>
        <div class="box">
            <div class="formDiv">
                <div class="mb15"><?php echo __('你正在创建一个新的公司项目，是否需要投标') ?>：</div>
                <div class="formItem">
                        <label class="mb10"><input type="radio" name="isTender" value="1" checked ="true"><?php echo __("是");?></label></br />
                        <label><input type="radio" name="isTender" value="2" ><?php echo __("否");?></label>
                        <div class="clear"></div>
                </div>
            </div>
            <div class="btn_con mt10">
                <div class="btns clearfix">
                    <input type="submit" value="确认选择并填写项目属性" class="btn_blue" />
                    <a href="<?php echo url_for('project/createProjectType');?>"  class="btn_blue jump"><?php echo __('返回并选择项目类型') ?></a>
                    <a href="<?php echo url_for('project/index')?>"  class="btn_blue jump"><?php echo __('放弃并返回') ?></a>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
//$(document).ready(function(){
    //$(".jump").leaveCheck({formId:'addType',formUrl:'<?php echo url_for("project/checkType"); ?>'});
//});
</script>