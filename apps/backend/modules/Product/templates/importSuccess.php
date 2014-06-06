<style>
    .select_style{
        height: 29px;
        line-height: 29px;
    }
    .form_must{display: none;}
</style>
<!-- float js to element-->
<div id="tabContent">
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Product Excel Import'); ?></h2>
        
    </div>
    <!--form header-->
    <!--hidden input-->
    <!--hidden input-->

    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div id="tab1">
            
            <div class="formItem">                     
                <label>操作手册：</label>
                1、请先下载指定格式的模板文件
                <br />
                2、将理财产品数据添加到该模板文件中
                <br />
                <label>&nbsp;</label>3、上传该模板文件
            </div>
            <br />
            <br />
            <!-- form tag-->
            <?php echo form_tag('Product/downloadTemplate', array('name' => 'download_template', 'id' => 'download_template', 'enctype' => 'multipart/form-data')); ?>
            <!-- form tag-->
                <div class="formItem">                     
                    <label>&nbsp;</label><?php echo __("Template Extension"); ?>：
                    <?php echo select_tag('extension', options_for_select($extension), array('class' => 'select_style'));?> 
                    <span class="form_must" id="extension_error">请选择要下载的模板文件格式</span>
                    
                    <?php echo __("Platform"); ?>：<?php echo select_tag('platform', options_for_select($platform), array('class' => 'select_style'));?> 
                    <span class="form_must" id="platform_error">请选择理财平台</span>
                    
                    <button onclick="return validate_extension();return formSubmit('download_template');">
                        <img src="/images/icons/down.png" title="<?php echo __('Down'); ?>" />
                            <?php echo __('Down'); ?>
                    </button>
                </div>
            </form>
            
            <br />
            <br />
            
            <?php echo form_tag('Product/fileImport', array('name' => 'import_template', 'id' => 'import_template', 'enctype' => 'multipart/form-data')); ?>
            <div class="formItem">                     
                <label>&nbsp;</label>
                <?php echo __("File Upload"); ?>
                <?php echo input_file_tag('excel'); ?>
                <?php echo __(form_error("excel")); ?>
                <span class="form_must" id="excel_error">请选择要上传的模板文件</span>
                <button onclick="return validate_excel();return formSubmit('import_template');">
                        <img src="/images/icons/import-csv.png" title="<?php echo __('Down'); ?>" />
                            <?php echo __('Upload'); ?>
                    </button>
            </div>
            
            <div class="formItem">
                <label>&nbsp;</label>
                <?php echo __(form_error("importError")); ?>
            </div>
        </form>
        </div>
        <!--main-->

        <div class="clear"></div>

    </div>
    <!-- float js to element-->
</form> 
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
        if ($('#extension').val() == '') {
            $("#extension_error").css('display','inline');
            return false;
        } else {
            $("#extension_error").css('display','none');
        }
        if ($("#platform").val() == '') {
            $("#platform_error").css('display','inline');
            return false;
        } else {
            $("#platform_error").css('display','none');
        }
        
    }

    function validate_excel() {
       if ($('#excel').val() == '') {
            $("#excel_error").css('display','inline');
            return false;
        }
        $("#excel_error").css('display','none'); 
    }
</script>