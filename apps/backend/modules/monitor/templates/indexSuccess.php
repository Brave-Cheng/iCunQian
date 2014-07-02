<?php include_partial('global/confirm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><a href="<?php echo url_for('monitorAddress/index'); ?>"><?php echo __('视频监控'); ?></a></span> &gt; <span><?php echo __('监控列表'); ?></span>
    </div>
    <div class="box">
        <div>
            <span><?php echo __('以下为 ' . $monitoringAddress->getOfficeOfTheCompanyName() . ' 的监控列表，点击条目打开对应摄像头'); ?>： </span>
        </div>
        <div class="btns mt10 clearfix">
            <?php if($accessCreate){ ?>
            <a href="<?php echo url_for('monitor/add?id=' . $monitoringAddress->getId() ); ?>" class="btn_blue mr10"><?php echo __('添加摄像头'); ?></a>
            <?php } ?>
            <?php if($accessDelete){ ?>
            <a class="btn_blue mr10" onclick="return showDeleteConfirmMessage(null, 'monitorList', this.href)" href='<?php echo url_for('monitor/delete'); ?>'><?php echo __('批量删除'); ?></a>
            <?php } ?>
            <a class="btn_blue mr10" href="<?php echo url_for('monitorAddress/index'); ?>"><?php echo __('返回') ?></a>
            <?php
                if( $sf_flash->has("msg") ){
                    if( $sf_flash->get("msg") == 2 ){
                        echo "<span class='error lh30 ml10'>删除成功</span>";
                    }else if( $sf_flash->get("msg") == 0 ){
                        echo "<span class='error lh30 ml10'>请选择要删除的摄像头</span>";
                    }
                }
            ?>
        </div>
        <div class="pagerlist mt10 clearfix">
            <?php if(utilPagerDisplayTotal($pager) > 20){
                echo utilPagerPages($pager, "monitor/index" , html_entity_decode(formGetQueryDenyPager("id"))); 
            }?>
            <span class="right lh30"><?php echo __("当前显示：") ?> <?php echo utilPagerDisplayRows($pager) ?> <?php echo __("条  共：") ?> <?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
        </div>
        <form aciton="<?php echo url_for('monitor/delete'); ?>" method='post' id='monitorList' />
        <input name="monitoringAddressId" value="<?php echo $monitoringAddress->getId(); ?>" type="hidden" />
        <div class="tables ex_tabs">
            <div class="tab-item on">
                <table>
                    <thead>
                        <tr>
                            <?php if($accessUpdate && $accessDelete ){ ?>
                            <td class="w20 alignCenter"><input type="checkbox" class="cboxAll" /></td>
                            <?php } ?>
                            <td class="w160"><?php echo __('描述') ?></td>
                            <td><?php echo __('查看地址（点击观看）') ?></td>
                            <td class="w100"></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($pager['results'])){ ?>
                        <?php
                            foreach( $pager['results'] as $key=>$result ) {
                        ?>
                        <tr <?php if( $key%2 ){ echo "class='odd'"; } ?>>
                            <?php if($accessUpdate && $accessDelete ){ ?>
                            <td class="alignCenter"><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $result->getId(); ?>"/></td>
                            <?php } ?>
                            <td><?php echo htmlspecialchars($result->getDescription()); ?></td>
                            <td><?php echo htmlspecialchars($result->getIp()); ?></td>
                            <td class="operate">
                                <?php if($accessUpdate){ ?>
                                <a href='<?php echo url_for('monitor/edit?id=' . $result->getId() . '&monitoringAddressId=' . $monitoringAddress->getId() ); ?>'><?php echo __('修改'); ?></a>
                                <?php } ?>
                                <?php if($accessDelete){ ?>
                                / <a onclick="return showDeleteConfirmMessage(null, '', this.href)" href="<?php echo url_for('monitor/delete?deleteId=' . $result->getId() . '&monitoringAddressId=' . $monitoringAddress->getId() ); ?>"><?php echo __('删除'); ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr><td colspan=4><div class='no_data'><?php echo __('没有数据'); ?></div></td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
        <div class="pagerlist mt10 clearfix">
            <?php if(utilPagerDisplayTotal($pager) > 20){
                echo utilPagerPages($pager, "monitor/index" , html_entity_decode(formGetQueryDenyPager("id"))); 
            }?>
            <span class="right lh30"><?php echo __("当前显示：") ?> <?php echo utilPagerDisplayRows($pager) ?> <?php echo __("条  共：") ?> <?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <?php if($accessCreate){ ?>
                <a href="<?php echo url_for('monitor/add?id=' . $monitoringAddress->getId() ); ?>" class="btn_blue"><?php echo __('添加摄像头') ?></a>
                <?php } ?>
                <?php if($accessDelete){ ?>
                <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'monitorList', this.href)" href='<?php echo url_for('monitor/delete'); ?>'><?php echo __('批量删除') ?></a>
                <?php } ?>
                <a class="btn_blue" href="<?php echo url_for('monitorAddress/index'); ?>"><?php echo __('返回') ?></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_flash->get("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage(null);
        }
    });
</script>