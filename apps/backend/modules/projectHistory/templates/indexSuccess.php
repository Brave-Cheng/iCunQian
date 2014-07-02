<?php echo javascript_include_tag('comm') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('查看修改历史') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
    <?php echo form_tag("project/index?" . html_entity_decode(formGetQuery("sort", "sortBy", "keywords", "type")), "id=searchTable") ?>
        <div class="btns mb10 clearfix">
            <div class="clearfix mb10">
                <p class="left">以下为<?php echo $project->getName();?>项目的历史修改记录(标记红色的为前后两次版本中的不同比较)：</p>
        </div>
    </div>
    <div class="tables">
            <table>
                <thead>
                    <tr>
                        <td class="w80"><?php echo __('开始时间') ?></td>
                        <td class="w80"><?php echo __('结束时间') ?></td>
                        <td class="w100"><?php echo __('标书') ?></td>
                        <td class="w100"><?php echo __('投标状态') ?></td>
                        <td class="w200"><?php echo __('备注') ?></td>
                        <td class="w100"><?php  echo __('修改人');?></td>
                        <td class="w120"><?php echo __('修改时间');?></td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($pager['results'] as $key=>$projectHistory):?>
                <?php $style = $projectHistory->getChangeColor($key, $colorColumn);?>
                    <tr class=<?php echo $key%2==0 ? "" : "odd";?>>
                        <td><font color="<?php echo $style['StartDate']?>"><?php echo  date('Y-m-d', strtotime($projectHistory->getStartDate()));?></font></td>
                        <td><font color="<?php echo $style['EndDate']?>"><?php echo  date('Y-m-d', strtotime($projectHistory->getEndDate()));?></font></td>
                        <td><font color="<?php echo $style['IsBuyTheTenderDocument']?>"><?php echo $options[$projectHistory->getIsBuyTheTenderDocument()] ?></font><font color="<?php echo $style['TenderDocumentPrice']?>"><?php echo  $projectHistory->getTenderDocumentPrice() ? '('.$projectHistory->getTenderDocumentPrice().')' : '';?></font></td>
                        <td><font color="<?php echo $style['TenderingStatus']?>"><?php echo $statuss[$projectHistory->getTenderingStatus()];?></font></td>
                        <td><font color="<?php echo $style['Comment'] ?>"><?php echo str_replace('<br />','',htmlspecialchars_decode($projectHistory->getComment()))?></font></td>
                        <td><font color="<?php echo $style['Modifier'] ?>"><?php echo $projectHistory->getProjectModifier() ?  $projectHistory->getProjectModifier()->getLastName() . $projectHistory->getProjectModifier()->getFirstName() : '';?></td>
                        <td><?php echo date('Y-m-d H:i',strtotime($projectHistory->getUpdatedAt()));?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
    </div>
    <div class="btn_con">
        <div class="btns clearfix mb10">
            <a href="<?php  echo url_for('project/index?' .  html_entity_decode(formGetQuery("keywords", "type") ) );?>" class="btn_blue"><?php echo __(' 返回项目列表') ?></a>
        </div>
    </div>
    </div>
    </form>
    </div>
</div>

