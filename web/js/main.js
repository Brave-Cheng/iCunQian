(function($){

    //tabs function.
    jQuery.fn.tabs=function(){
        return this.each(function(){
            var elem=$(this);
            var nav=elem.find('ul.tab-nav li');
            var items=elem.find('.tab-item');
            nav.each(function(index){
                $(this).click(function(){
                    var _this=$(this);
                    nav.removeClass('current');
                    _this.addClass('current');
                    items.removeClass('on');
                    items.eq(index).addClass('on');
                })
            })
        })
    }

    //select all function.
    jQuery.fn.selectAll=function(){
        return this.each(function(){
            var elem=$(this);
            var checked=false;
            var checekAllBtn=elem.find('input.cboxAll');
            var checkItems=elem.find('input.cbox');
            checekAllBtn.prop('checked',false);
            checkItems.prop('checked',false);

            checekAllBtn.on('click',function(){
                var isChecked=elem.find('input.cboxAll:checked');
                checkItems.prop('checked',$(this).prop('checked'));
            })
        })
    }

    //datePicker function
    jQuery.fn.setTimepicker=function(options){
        var defaults={
            dateFormat : "yy-mm-dd",
            showTime   :  false,
            showSecond :  false,
            showHour   :  false,
            showMinute :  false,
            changeMonth:  true,
            changeYear :  true
        }
        var opts=jQuery.extend(options, defaults);
        $(this).datepicker(opts);

    }

    //Accordion
    jQuery.fn.exAccordion=function(options){
        var defaults={
            time:200
        };
        var opts=jQuery.extend(options, defaults);

        return this.each(function(){
            var _this=$(this);
            var _header=_this.children('h3');
            var _content=_this.children('div');
            _header.each(function(index){
                var i=index;
                var _icon=$('<span class="icon">');
                $(this)
                    .addClass('ex_accordion_header').click(function(){
                        _content.eq(index).toggle();
                        $(this).toggleClass('ex_accordion_select');
                     })
                    .prepend(_icon);
            })

            _content.each(function(index){
                var i=index;
                $(this).addClass('ex_accordion_content');

            }).hide();

        })
    }

})(jQuery);

$(document).ready(function(){

    //select options style reset
    $(".select").sSelect();

    //checkbox select all
    $('.ex_tabs .tab-item,.select_all').selectAll();

    //Call tabs function.
    $('.tabs').tabs();


})