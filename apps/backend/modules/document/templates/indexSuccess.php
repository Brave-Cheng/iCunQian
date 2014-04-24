<?php include_partial('global/confirm');?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><?php echo __('文档管理') ?></span> &gt; <span><?php echo __('列表页') ?></span>
    </div>
    <div class="box">
    <?php echo form_tag("document/index?" . html_entity_decode(formGetQuery("sort", "sortBy", "keywords", "projectId")), array("id"=>"searchProject")) ?> 
    <div class="btn_con">
        <div class="btns mb10 clearfix">
            <div id="search" class="right">
                <div class="relative left">
                    <input type="button" class="search_btn" value="" onclick="checkKeyword();"/>
                    <?php echo formInputTag("keywords", __("搜索文档"), array("class"=>"txt w200 gray"))?> 
                    <?php if($sf_params->get('keywords') != null){?>
                        <a title="清除搜索" href="<?php echo url_for('document/index') ?>" class="clear_search"></a>
                    <?php } ?>  
                </div>
                <input type="button" class="btn_blue" value="<?php echo __('搜索')?>" onclick="checkKeyword()"/>                   
            </div>
            <?php if($accessCreate){?>                  
                <a href="<?php echo url_for('document/add')?>" class="btn_blue"><?php echo __('创建文档')?></a>
            <?php }?>
            <?php if($accessDelete){?>
                <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'searchProject', this.href)" href='<?php echo url_for("document/delete?" . html_entity_decode(formGetQueryDenyPager("sortBy", "sort", "keywords","projectId", 'pager'))) ?>'><?php echo __('批量删除') ?></a>
            <?php }?>
            <?php if($accessRead){?>              
                <input type="button" class="btn_blue" value="<?php echo __('批量导出') ?>" onclick="return formSubmitCheck('searchProject', '<?php echo url_for("document/exportcsv") ?>')"/>           
                <a class="btn_blue" onclick="formSubmitCheckExportcsvAll('searchProject',this.href);return false;" href='<?php echo url_for("document/exportcsv?type=1") ?>'><?php echo __('导出全部') ?></a> 
           <?php }?>
           <div class="clear"></div>                            
        </div>
        <?php
                if( $sf_flash->has('flag') ){
                    if( $sf_flash->get('flag') == '1' ){
                        echo "<span class='error lh30'>".__("删除成功")."</span>";
                    }else if( $sf_request->getParameter("msg") == '0' ){
                        echo "<span class='error lh30'>".__("请选择要删除的文档")."</span>";
                    }
                }
            ?>
    </div>  
    <div class="tables ex_tabs">
        <div class="pagination mb10" style="float:none;">
            <div class="pagination mb10" style="float:none;">
            <div class="left mr10">
                <select name="projectId" class="select"  onChange="changeType(this,'<?php echo url_for("document/index")?>');">
                    <option value=''><?php echo __('选择全部项目')?></option>   
                    <?php foreach($projectIds as $projectId):?>                              
                    <?php if($pid == $projectId->getId()):?>
                    <option value="<?php echo $projectId->getId()?>" selected="selected"><?php echo $projectId->getName();?></option>
                    <?php else:?>
                    <option value="<?php echo $projectId->getId()?>" ><?php echo $projectId->getName();?></option>
                    <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>
         </div>
      </div>
            <div class="pagination mb10" style="float:none;">
                <div class="pagerlist">
                    <?php if(utilPagerDisplayTotal($pager) > 20 ){echo utilPagerPages($pager, "document/index" , html_entity_decode(formGetQueryDenyPager("sortBy", "sort", "keywords","projectId")));}?>                    
                    <span class="right lh30"><?php echo __("当前显示：")?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：")?><?php echo utilPagerDisplayTotal($pager)?><?php echo __("条");?></span>
                </div>
                <div class="clear"></div>
            </div>
             <?php if($sf_params->get('keywords') != null){?>
            <div class="mt5">          
                您当前搜索的是：<span style="color:#f29518;"><?php echo htmlspecialchars(urldecode($sf_params->get('keywords')))?></span>
            </div>
            <?php }?>
           <div class="tab-item on mt5">
            <table>
                <thead>
                    <tr>
                        <td class="w20"><input type="checkbox" class="cboxAll" /></td>
                        <td class="w60"><?php echo __('文档编号') ?></td>
                        <td class="w60"><?php echo __('标题') ?></td>
                        <td class="w120"><?php echo __('项目简称') ?></td>
                        <td class="w60"><?php echo __('业主') ?></td>
                        <td class="w60"><?php echo __('标段号') ?></td>
                        <td class="w60"><?php echo __('合同号') ?></td>
                        <td class="w60"><?php echo __('期号') ?></td>
                        <?php if($accessRead || $accessUpdate || $accessDelete){?>
                        <td class="w40">&nbsp;</td>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                <?php if($pager['results']){?>
                <?php foreach($pager['results'] as $key=>$document):?>
                    <tr class="<?php echo $key%2==0 ? "" : "odd";?>">
                    <td><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $document->getId(); ?>"/></td>
                    <td><?php echo htmlspecialchars(strlen($document->getDocumentNumber())>24 ? mb_substr($document->getDocumentNumber(), '0','8','utf8')."..." : $document->getDocumentNumber());?></td>               
                    <td><?php echo htmlspecialchars(strlen($document->getTitle())>24 ? mb_substr($document->getTitle(), '0','8','utf8')."..." : $document->getTitle());?></td>
                    <td><?php if($document->getProjectDcoumentByDocument()){echo htmlspecialchars($document->getProjectDcoumentByDocument()->getProject()->getName());}?></td>
                    <td><?php echo htmlspecialchars($document->getProprietor());?></td>
                    <td><?php echo htmlspecialchars(strlen($document->getblockNumber())>24 ? mb_substr($document->getblockNumber(), '0','8','utf8')."..." : $document->getblockNumber());?></td>
                    <td><?php echo htmlspecialchars(strlen($document->getContractNumber())>24 ? mb_substr($document->getContractNumber(), '0','8','utf8')."..." : $document->getContractNumber());?></td>
                    <td><?php echo htmlspecialchars(strlen($document->getIssue())>24 ? mb_substr($document->getIssue(), '0','8','utf8')."..." : $document->getIssue());?></td>
                    <?php if($accessRead || $accessUpdate || $accessDelete){?>
                        <td class="center">
                        <?php if($accessRead){?>
                            <a href="<?php echo url_for('document/read?id='.$document->getId()) .'&'. html_entity_decode(formGetQuery("keywords", 'projectId'))?>"><?php echo __('查看');?></a><br />
                        <?php }?>
                        <?php if($accessUpdate) { ?>                   
                            <a href="<?php echo url_for('document/edit?id='.$document->getId()) .'&'. html_entity_decode(formGetQuery("keywords", 'projectId'))?>">修改</a><br />
                        <?php }?>
                        <?php if($accessDelete){?> 
                            <a onclick="return showDeleteConfirmMessage('', '', this.href)" href="<?php echo url_for('document/delete?deleteId='.$document->getId() .'&'.html_entity_decode(formGetQueryDenyPager("pager")))?>">删除</a>                         
                        <?php }  ?> 
                        </td>    
                    <?php }?>       
                    </tr>
                  <?php endforeach; ?>
                  <?php }else{?>
                    <tr><td colspan=9><div class='no_data'> <?php echo __('文档列表为空'); ?> </div></td></tr>
                  <?php }?>
                </tbody>
            </table>
         </div>     
        <div class="pagination mb10" style="float:none;">
            <div class="pagination mb10" style="float:none;">
            <div class="left mr10">
                <select name="projectId" class="select"  onChange="changeType(this,'<?php echo url_for("document/index")?>');">                 
                    <option value =''><?php echo __('选择全部项目')?></option>                   
                    <?php foreach($projectIds as $projectId):?>
                    <?php if($pid == $projectId->getId()):?>                    
                    <option value="<?php echo $projectId->getId()?>" selected="selected"><?php echo $projectId->getName();?></option>
                    <?php else:?>                   
                    <option value="<?php echo $projectId->getId()?>" ><?php echo $projectId->getName();?></option>
                    <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>
         </div>
        
        </div>
        <div class="pagination mb10" style="float:none;">
            <div class="pagerlist">
                <?php if(utilPagerDisplayTotal($pager) > 20 ){echo utilPagerPages($pager, "document/index" , html_entity_decode(formGetQueryDenyPager("sortBy", "sort", "keywords","projectId")));}?>                    
            <span class="right lh30"><?php echo __("当前显示：")?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：")?><?php echo utilPagerDisplayTotal($pager)?><?php echo __("条");?></span>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="btn_con clearfix">
        <?php if($sf_params->get('keywords') != null){?>
            <div class="mt10 clearfix">
               <a class="btn_blue" href="<?php echo url_for($urlName)?>">返回文档列表</a>   
            </div> 
        <?php }?>  
      <div class="left mt15">
            <?php if($accessCreate){?>                  
                <a href="<?php echo url_for('document/add')?>" class="btn_blue"><?php echo __('创建文档')?></a>
            <?php }?>
            <?php if($accessDelete){?>
                <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'searchProject', this.href)" href='<?php echo url_for("document/delete?" . html_entity_decode(formGetQueryDenyPager("sortBy", "sort", "keywords","projectId", 'pager'))) ?>'><?php echo __('批量删除') ?></a>
            <?php }?>
            <?php if($accessRead){?>   
                <input type="button" class="btn_blue" value="<?php echo __('批量导出') ?>" onclick="return formSubmitCheck('searchProject', '<?php echo url_for("document/exportcsv") ?>')"/>
                <a class="btn_blue" onclick="formSubmitCheckExportcsvAll('searchProject',this.href);return false;" href='<?php echo url_for("document/exportcsv?type=1") ?>'><?php echo __('导出全部') ?></a> 
            <?php }?>
        </div>
    </div>
</div>
 
</div>
</form>      
</div>
<script type="text/javascript">
    function changeType(obj, url){
        window.location.href = url + '?projectId=' + obj.value;
    }
    $(document).ready(function(){
        setSearchType( 'keywords' );
    })
    function checkKeyword(){
        var key = $("#keywords").val();
        var pattren = /(\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\||\")+/;
        key = key.replace( pattren, '');
        if($.trim(key) == "" || key == '搜索文档'){
            showSaveSuccessfullyMessage("请输入正确的关键字，并且关键词请不要包含特殊符号。", null);
        }else{
            formSubmit('searchProject', '<?php echo url_for("document/index?" . html_entity_decode(formGetQuery("sortBy", "sort"))) ?>');
        }
    }
//exportCSV input:checkbox check function;
function formSubmitCheck(fid, action, method) {    
    var checkItems=$('#'+fid).find('input.cbox:checked');
    if(checkItems.length==0){
        showSaveSuccessfullyMessage( '您没有选择要导出的文件，请选择文件' );
        return false;
    }
    if (fid == null || fid == "" || fid == false) {location.href = action; return false;}
    var frm = document.getElementById(fid);
    frm.action = action;
    if (method) { frm.method = method; }   
    frm.submit();
}

    
function formSubmitCheckExportcsvAll(form, url) {    
    <?php if(!$pager['results']){ ?>      
    showSaveSuccessfullyMessage( '当前没有文档数据，无法下载，请创建文档后再导出全部。' );
    return false;
    <?php } ?>
    showDeleteConfirmMessage('确定下载全部的文档信息？', form, url);
}    

</script>
