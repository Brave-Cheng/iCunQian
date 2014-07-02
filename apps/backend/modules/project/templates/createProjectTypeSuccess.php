<div id="content" class="right">
    <?php echo form_tag("project/insertProjectType", "id=addType") ?>
        <div class="bread_crumbs jump"> <a href="<?php echo url_for('project/index');?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('创建新项目') ?> &gt; <?php echo __('第一步:选择项目类型');?></span> </div>
        <div class="box">
            <div class="formDiv">
                <div class="mb15"><?php echo __('你正在创建一个新项目，首先请选择项目类型');?>：</div>
                <div class="formItem">
                        <label class="mb10"><input type="radio" name="types" value="<?php echo ProjectPeer::INNER_PROJECT ?>" checked ="true"><?php echo __('公司项目');?></label></br />
                        <label><input type="radio" name="types" value="<?php echo projectPeer::OUTSOURCE_PROJECT;?>" ><?php echo __('外包项目');?></label>
                        <div class="clear"></div>
                </div>
            </div>
            <div class="btn_con mt10">
                <div class="btns clearfix">
                    <input type="submit" value="<?php echo __('确认选择并填写项目属性');?>" class="btn_blue" />
                    <a href="<?php echo url_for('project/index')?>"  class="btn_blue jump"><?php echo __('放弃并返回') ?></a>
                </div>
            </div>
        </div>
    </form>
</div>