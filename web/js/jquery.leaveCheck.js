/*
    this jquery extension needs to be loaded jquery ui
 */
;(function($) {     
    Array.prototype.options = function(options){
        options = $.extend({
            formId : "",
            formUrl : "",
            msgbox_msg : "您还没有保存修改的数据，是否确定离开？",
            msgbox_resizable : false,
            msgbox_maxheight : 200,
            msgbox_title : '提示'
        }, options)
        return options;
    }
    $.fn.leaveCheck = function(options){
        var options = Array.prototype.options(options);
        if(options.formId == "" || options.formId == null || options.formUrl == "" || options.formUrl == null){
            console.log('parameter error');
            return false;
        }
        $(this).bind('click',function(){
            var $this = $(this);
            options.a_url = $this.attr('href');
            var isModified = false;
            $('form').find("input[type='file']").each(function(i){
                if($(this).val() !="" && $(this).val() != null ){
                    isModified = true;
                }
            });
            if(isModified){
                $.fn.showMsg(options);
                return false;
            }
            $.ajax({
                type: "POST",
                url: options.formUrl,
                data: $("#" + options.formId).serialize(),
                success: function(data) {
                    if( data == '1' ){
                        $.fn.showMsg(options);
                    }else{
                        location.href = options.a_url;
                    }
                }
            });
            return false;
        })
    };
    $.fn.showMsg = function(options){
        if( $("#leaveConfirm").attr('id') != 'leaveConfirm' ){
            $('<div>').attr({'class':'promat', 'id':'leaveConfirm','title':options.msgbox_title}).css('diaplay','none').appendTo($('body'));
            $('<p>').text(options.msgbox_msg).appendTo($('#leaveConfirm'));
        }
        var yes = options.msgbox_buttonNo;
        var no  = options.msgbox_buttonNo;
        var params = {
            resizable: options.msgbox_resizable,
            maxheight: options.msgbox_maxheight,
            modal: true,
            buttons: {
                '确认' : function(){
                    $(this).dialog( 'close' );
                    $(this).remove();
                    location.href = options.a_url;
                },
                '关闭' : function(){
                    $(this).dialog( 'close' );
                    $(this).remove();
                }
            }
        }
        $('#leaveConfirm').dialog(params);
    }
})(jQuery);