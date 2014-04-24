<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('document/index')?>"><?php echo __('文档管理') ?></a> &gt; <?php echo __('查看文档详细页面') ?>
    </div>
<div class="box project">
        <h3 class="pro_title"><?php echo __('文档详细页面') ;?></h3>
        <div class="formDiv">
            <div class="pro_info">
                <div class="pro_item"><?php echo __('项目属性');?></div>
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('项目名称'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $projectDocument->getProject() ? $projectDocument->getProject()->getName(): null?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('业主'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $documentObj->getProprietor()?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('标段号'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $documentObj->getBlockNumber()?>
                        </div>
                        <div class="clear"></div>
                    </div>
               </div>
            <div class="pro_info">
                <div class="pro_item"><?php echo __('文档属性');?></div>
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('文档编号'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $documentObj->getDocumentNumber() ?>
                        </div>
                     </div>
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('标题'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $documentObj->getTitle()?>
                        </div>
                    </div>    
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('合同号'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $documentObj->getContractNumber()?>
                        </div>
                    </div>
                    <div class="formItem">
                        <label class="label">
                            <?php echo __('期号'); ?>：
                        </label>
                        <div class="iner lh30">
                            <?php echo $documentObj->getIssue()?>
                        </div>
                    </div>
                </div>
             </div>    
            <br />  
        <div class="btn_con">                 
            <div class="btns clearfix">
               <a href="<?php echo url_for('document/index?' . html_entity_decode(formGetQuery("keywords", 'projectId')));?>" class="btn_blue jump"><?php echo __('返回')?></a>
            </div>
        </div>
    </div>
</div>
