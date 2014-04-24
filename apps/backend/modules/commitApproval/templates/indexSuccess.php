<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm') ?>
<div id="content" class="right">
        <div class="bread_crumbs">
            <span><?php echo __('审批管理') ?></span> &gt; <span><?php echo __('审批列表') ?></span>
        </div>
        <div class="box">
            <!--提示与搜索 start-->
            <div class="btn_con">
                <?php echo form_tag("commitApproval/index?" . html_entity_decode(formGetQuery("keywords", "projectType", "approvalId")), "id=searchTable") ?>
                <?php $typeIndex = $sf_request->getParameter('type'); ?>
                <div class="btns mb10 clearfix">
                    <div class="clearfix mb10">
                        <p class="left">以下是与您相关的审批（单击每行查看审批详细信息）：</p>
                        <div id="search" class="right">
                            <div class="relative left">
                                <input type="submit" class="search_btn" value="" onclick="return checkKeyword();" />
                                <?php echo formInputTag("keywords", ($keywords ? $keywords : '搜索审批'), array("class" => "txt w200 gray")) ?>
                                <?php if ($sf_params->get('keywords') != null) { ?>
                                    <a title="清除搜索" href="<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "approvalId"))); ?>" class="clear_search"></a>
                                <?php } ?>
                            </div>
                            <input type="submit" class="btn_blue" onclick="return checkKeyword();" value="搜索" />
                        </div>
                    </div>
                    <?php if ($accessCreate): ?>
                        <a href="<?php echo url_for('commitApproval/selectApprovalType'); ?>" class="btn_blue">新建审批</a>
                    <?php endif; ?>
                    <?php if ($accessDelete) { ?>
                        <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'applicationList', this.href)" href='<?php echo url_for("commitApproval/delete?" . html_entity_decode(formGetQueryDenyPager("projectType", "approvalId", 'page', 'keywords'))) ?>'><?php echo __('批量删除') ?></a>
                    <?php } ?>
                </div>
                <?php
                if ($sf_flash->has('flag')) {
                    if ($sf_flash->get('flag') == '1') {
                        echo "<span class='error lh30'>" . __("删除成功") . "</span>";
                    } else if ($sf_flash->get('flag') == '0') {
                        echo "<span class='error lh30'>" . __("请选择要删除的审批") . "</span>";
                    }
                }
                ?>
            </div>
            </form>
            <!--提示与搜索 end-->
            <form action="<?php echo url_for('commitApproval/delete?' . html_entity_decode(formGetQuery("keywords", "projectType", "approvalId"))); ?>" method="post" id="applicationList" >
            <!--筛选与分页 start-->
            <div class="pagination mb10" style="float:none;">

                <div class="left mr10">
                    <label class="label"><?php echo __('根据项目筛选审批'); ?>：</label>
                    <?php echo select_tag('projectType', options_for_select($projectTypes, $projectType), "class='select' onChange='changeSearch(this,'projectType','" . url_for("commitApproval/index") . "')'") ?>
                </div>

                <div class="left mr10">
                    <label class="label"><?php echo __('根据类型筛选审批'); ?>：</label>
                    <select name="approvalId" class="select"  onChange="changeSearch(this, 'approvalId', '<?php echo url_for("commitApproval/index") ?>');">
                        <option value="0"><?php echo __('所有类型') ?></option>
                        <?php echo objects_for_select($approvalList, 'getId', 'getName', $approvalId) ?>
                    </select>
                    <?php
                    if ($sf_flash->has("confirm")) {
                        if ($sf_flash->get('confirm') == 1) {
                            echo "<span class='error lh30'>删除成功</span>";
                        } else if ($sf_flash->get('confirm') == 0) {
                            echo "<span class='error lh30'>请选择要删除的用户</span>";
                        }
                    }
                    ?>
                </div>

                <div class="clear"></div>
                <div class="pagination mt10">
                    <div class="pagerlist"><?php
                        if (utilPagerDisplayTotal($pager) > 20) {
                            echo utilPagerPages($pager, "commitApproval/index", html_entity_decode(formGetQueryDenyPager("keywords", "approvalId", "applicationId", "projectType")));
                        }
                        ?>
                        <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!--筛选与分页 end-->

            <!--内容主体 start-->
            <div class="tables">
                <div class="tab-item">
                    <table class="select_all">
                        <thead>
                            <tr>
                                <td class="w20"><input type="checkbox" class="cboxAll" /></td>
                                <td class="w20">ID</td>
                                <td class="w140">审批流程名</td>
                                <td class="w120">审批类型</td>
                                <td class="w120">属于项目</td>
                                <td class="w60">创建人</td>
                                <td class="w80">当前状态</td>
                                <td class="w40">管理</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($pager['results'])): ?>
                                <?php foreach ($pager['results'] as $key => $application): ?>
                                    <tr <?php if ($key % 2) {
                                echo "class='odd'";
                            } ?>>
                                        <td><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $application->getId(); ?>"/></td>
                                        <td><?php echo $application->getId() ?></td>
                                        <td><?php echo $application->getName() ?></td>
                                        <td><?php
                                            if ($application->getApproval()) {
                                                echo $application->getApproval()->getName();
                                            }
                                            ?></td>
                                        <td><?php
                                            if ($application->getProject()) {
                                                echo $application->getProject()->getName();
                                            }
                                            ?></td>
                                        <td><?php echo $application->getSfGuardUser()->getProfile()->getLastName() . $application->getSfGuardUser()->getProfile()->getFirstName() ?></td>
                                        <td class="red"><?php echo ApplicationPeer::getApprovalStatus($application->getCurrentStatus()); ?></td>
                                        <td class="operate">
                                            <?php if ($accessUpdate && $application->getCurrentStatus() == 0 && $sf_user->getGuardUser()->getId() == $application->getSfGuardUserId()): ?>
                                                <a href="<?php echo ApplicationPeer::getRedirectPageByApproval($application->getApprovalId(), $application->getId()) . '&' . html_entity_decode(formGetQuery("projectType", "keywords", "approvalId")) ?>">编辑</a>
                                            <?php endif; ?>
                                            <?php if ($accessRead): ?>
                                                <?php if($application->getCurrentStatus() == 2 || $application->getCurrentStatus() == 3 || $sf_user->getGuardUser()->getId() == $application->getSfGuardUserId() || $application->currentUserApproval($sf_user->getGuardUser()->getId())):?>
                                                <a class="read" href="<?php echo ApplicationPeer::getRedirectPageByApproval($application->getApprovalId(), $application->getId(), true) . '&' . html_entity_decode(formGetQuery("projectType", "keywords", "approvalId")) ?>">查看</a>
                                                <?php else:?>
                                                <a class="read" href="<?php echo ApplicationPeer::getRedirectPageByApproval($application->getApprovalId(), $application->getId(), true) . '&' . html_entity_decode(formGetQuery("projectType", "keywords", "approvalId")) ?>">审批</a>
                                                <?php endif;?>
                                            <?php endif; ?>

                                            <?php if ($accessDelete && $application->getCurrentStatus() == 0 && $sf_user->getGuardUser()->getId() == $application->getSfGuardUserId()): ?>
                                                <a onclick="return showDeleteConfirmMessage(null, ' ', this.href)"; href="<?php echo url_for('commitApproval/delete?deleteId=' . $application->getId() . html_entity_decode(formGetQueryDenyPager("projectType", "keywords", "approvalId", 'page'))) ?>">删除</a>
        <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="20" align="center">暂时没有审批</td></tr>
<?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--内容主体 end-->



            <!--筛选与分页 start-->
            <div class="pagination mb10" style="float:none;">
                <div class="left mr10">
                    <label class="label"><?php echo __('根据项目筛选审批'); ?>：</label>
<?php echo select_tag('projectType', options_for_select($projectTypes, $projectType), "class='select' onChange='changeSearch(this,'projectType','" . url_for("commitApproval/index") . "')'") ?>
                </div>

                <div class="left mr10">
                    <label class="label"><?php echo __('根据类型筛选审批'); ?>：</label>
                    <select name="approvalId" class="select"  onChange="changeSearch(this, 'approvalId', '<?php echo url_for("commitApproval/index") ?>');">
                        <option value="0"><?php echo __('所有类型') ?></option>
<?php echo objects_for_select($approvalList, 'getId', 'getName', $approvalId) ?>
                    </select>
                </div>
                <div class="clear"></div>
                <div class="pagination mt10" style="float:none;">
                    <div class="pagerlist"><?php
                        if (utilPagerDisplayTotal($pager) > 20) {
                            echo utilPagerPages($pager, "commitApproval/index", html_entity_decode(formGetQueryDenyPager("keywords", "approvalType", "projectType")));
                        }
                        ?>
                        <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!--筛选与分页 end-->
            <!--创建button start-->
            <div class="btn_con">
                <div class="btns mb10 clearfix">
                    <?php if ($accessCreate): ?>
                        <a href="<?php echo url_for('commitApproval/selectApprovalType'); ?>" class="btn_blue">新建审批</a>
                    <?php endif; ?>
                    <?php if ($accessDelete) { ?>
                        <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'applicationList', this.href)" href='<?php echo url_for("commitApproval/delete?" . html_entity_decode(formGetQueryDenyPager("projectType", "approvalId", 'page', 'keywords'))) ?>'><?php echo __('批量删除') ?></a>
<?php } ?>
                </div>
            </div>

            <!--创建button end-->
            </form>
        </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    setSearchType('keywords');
    var msg = '<?php echo $sf_request->getParameter("msg"); ?>';
    if (msg == '1') {
//                                    showSaveSuccessfullyMessage('');
    }
    var hasSignatureImage = "<?php echo $hasSignatureImage; ?>";
    if (!hasSignatureImage) {
        $(".read").bind("click", function() {
            showDeleteConfirmMessage('您还没有上传签名，无法进行审批。是否继续?', '', $(this).attr('href'));
            return false;
        })
    }
})

function checkKeyword() {
    var key = $("#keywords").val();
    var pattren = /(\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\||\")+/;
    key = key.replace(pattren, '');
    if ($.trim(key) == "" || key == '搜索审批') {
        showSaveSuccessfullyMessage("请输入正确的关键字，并且关键词请不要包含特殊符号。", null);
        return false;
    } else {
        return formSubmit('searchTable', '<?php echo url_for("commitApproval/index?" . html_entity_decode(formGetQuery("projectType", "id", 'approvalId'))) ?>', 'get');
    }
}

function changeSearch(obj, key, url)
{
    if (key == 'approvalId') {
        window.location.href = url + '?' + key + '=' + obj.value + '&' + '<?php echo html_entity_decode(formGetQuery("projectType", "keywords")) ?>';
    } else {
        window.location.href = url + '?' + key + '=' + obj.value + '&' + '<?php echo html_entity_decode(formGetQuery("keywords", "approvalId")) ?>';
    }
}
</script>