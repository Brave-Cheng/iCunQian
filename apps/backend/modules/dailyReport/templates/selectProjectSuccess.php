<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <a class="jump" href="<?php echo url_for('dailyReport/selectProject')?>"><?php echo __('撰写日报') ?></a> &gt; <span><?php echo __('选择项目') ?></span>
    </div>
    <?php echo form_tag("dailyReport/add",'id=dailyReport') ?>
    <div class="box">
            <div class="formDiv">
                <div class="mb15"><?php echo __('你当前在多个项目上，请选择您所需要撰写日报的项目') ?>：</div>
                <div class="formItem">
                <?php foreach ($projects as $key =>$project){?>
                        <label class="mb10"><input type="radio" name="projectId" value="<?php echo $project->getId();?>"<?php if($key == 0){echo "checked ='true'";}?>><?php echo __( htmlspecialchars( $project->getName() ) );?></label></br />
                          <?php }?>
                        <div class="clear"></div>
                </div>
            </div>
    <div class="btn_con">                 
          <div class="btns clearfix">
            <input type="submit" value="确认项目并前往撰写内容" class="btn_blue" />
            <a href="<?php echo url_for('project/index')?>"  class="btn_blue "><?php echo __('放弃并返回') ?></a>
         </div>               
        </div>
    </div>
    </form>
</div>
