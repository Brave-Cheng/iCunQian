<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('comm') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('日报查看') ?></span>
    </div>
    <div class="box">

    <div class="tables ex_tabs">
        <table>
            <tbody>
                <tr>
                    <td class="w80 bg_blue"><?php echo __('撰写人 ：') ?></td>
                    <td><?php echo __($dailyReportObj->getSfGuardUser()->getProfile()->getLastName().$dailyReportObj->getSfGuardUser()->getProfile()->getFirstName());?></td>
                </tr>
                <tr>
                    <td class="w80 bg_blue"><?php echo __('日报内容 ：')?></td>
                    <td><?php echo __(htmlspecialchars($dailyReportObj->getContent()));?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="btn_con">
        <div class="btns clearfix">
            <a href="<?php echo url_for('dailyReport/list?projectId='.$dailyReportObj->getProjectId());?>" class="btn_blue"><?php echo __('返回日报列表') ?></a>
        </div>
    </div>
    </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#date').attr('readonly', true);
    $('#date').datetimepicker(getTimepickerOptions('',false,false,false,false));
});
</script>