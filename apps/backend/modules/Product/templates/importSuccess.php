<style type="text/css">
    .none{display: none;}
    .formItem ul li{ padding: 5px 0; font-size: 12px; border-bottom: 1px solid #e5eff8;}
    .formItem span{font-size: 14px;}
    .brother{display: block; float: left;margin: 10px 10px 10px 0;}
    .borderBottom{margin-top: 10px;}
    .borderBottom, .validation{border-bottom: none;}
    .borderBottom ul{margin-top: 10px;}
    .validation span{display: none; color: red; font-size: 12px;}
</style>
<!-- float js to element-->
    
    <!--form header-->

    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div class="content-header">
            <h2><?php echo __('Product Excel Import'); ?></h2>
        </div>

        <div id="tab1">
           <div class="formItem borderBottom">                     
            <span>操作手册：</span>
                <ul>
                    <li>1. 请先下载指定格式的模板文件</li>
                    <li>2. 将理财产品数据添加到该模板文件中</li>
                    <li>3. 上传该模板文件</li>
                </ul>
            </div>
            <?php echo form_tag('Product/downloadTemplate', array('name' => 'download_template', 'id' => 'download_template', 'enctype' => 'multipart/form-data')); ?>
            
            <div class="formItem borderBottom">                     
                <span>模板下载：</span>
            </div>

            <div class="formItem">                     
                    <div class="brother">
                        <?php echo __("Template Extension"); ?>：<?php echo select_tag('extension', options_for_select($extension), array('class' => 'select_style'));?> 
                    
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo __("Platform"); ?>：<?php echo select_tag('platform', options_for_select($platform), array('class' => 'select_style'));?> 
                    </div>

                    <div>
                        <button onclick="return validate_extension();return formSubmit('download_template');">
                            <img src="/images/icons/down.png" title="<?php echo __('Down'); ?>" />
                            <?php echo __('Down'); ?>
                        </button>
                    </div>
            </div>
            <div class="formItem validation">
                <span id="extension_error">1、请选择需要下载的文件格式！</span>
                <span id="platform_error">2、请选择理财平台！</span>
            </div>

            </form>
            <div class="clear"></div>
            
            <?php echo form_tag('Product/upload', array('name' => 'import_template', 'id' => 'import_template', 'enctype' => 'multipart/form-data')); ?>


            <div class="formItem borderBottom">                     
                <span>Excel导入：</span><span style="font-size: 12px;color: rgb(114, 105, 129);">（为了方便的导入数据，建议数据量尽量控制在1000以内！）</span>
            </div>    
            <div class="formItem">     
                <div class="brother">
                    <?php echo __("File Upload"); ?>：
                    <?php echo input_file_tag('excel'); ?>
                </div>

                <div>
                    <button onclick="return validate_excel();return formSubmit('import_template');">
                        <img src="/images/icons/import-csv.png" title="<?php echo __('Down'); ?>" />
                        <?php echo __('Upload'); ?>
                    </button>
                </div>             
            </div> 
            <div class="formItem validation">
                <span id="excel_error">请选择要上传的模板文件！</span>
            </div>
            
            

            <div class="clear"></div>

            <div class="formItem validation">
                    <?php echo form_error("importError"); ?>
            </div>
            </form>
        </div>
        <!--main-->

        <div class="clear"></div>

    </div>
    <!-- float js to element-->

<script type="text/javascript">
    $(document).ready(function() {
        var msg = "<?php echo $sf_request->getParameter("rmsg"); ?>";
        if (msg == "0") {
            showDialogYes('<?php echo __("Save Successful") ?>', '<?php echo __("Message") ?>');
        }
    });

    function insert_item(val, the) {
        if ($(the).attr('checked') == 'checked') {
            $("#recommend").val(val);
        } else {
            $("#recommend").val('');
        }

    }

    function validate_extension() {
        var check = true;

        if ($('#extension').val() == '') {
            $("#extension_error").css('display','inline');
            check = false;
        } else {
            $("#extension_error").css('display','none');
        }

        if ($('#platform').val() == '') {
            $("#platform_error").css('display','inline');
            check = false;
        } else {
            $("#platform_error").css('display','none');
        }

        return check;
    }

    function validate_excel() {
       if ($('#excel').val() == '') {
            $("#excel_error").css('display','inline');
            return false;
        }
        // $("#excel_error").css('display','none'); 
    }
</script>