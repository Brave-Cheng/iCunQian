var pre_price = 328;
var big_total = 0;
var sta_total = 0;
var cat_array = ['one','two','three','four','five','six','seven','eight','nine','ten'];
var cat_num_array = ['一','二','三','四','五','六','七','八','九','十'];

function addCat(count){
    var before_ele = $("#cat_div .line");
    $('.cat_li').remove();
    for(var i=1; i<=count; i++){
        var cat_id = cat_array[i-1];
        var cat_num = 'cat_'+cat_array[i-1];
        var cat_html='<li id="'+cat_num+'"class="cat_li"><div class="step_cat_title"><span class="cat_icon"></span><h4 class="number" id="'+cat_id+'">第'+cat_num_array[i-1]+'只猫</h4><span class="edit">+</span><label class="subtotal">小计：<span id="'+cat_num+'_total">00.00元</span></label></div><ul class="step_cat"id="'+cat_num+'_detail"><li><div class="field field_col"><label>CFA注册名</label><input type="text"id="'+cat_num+'_name"class="input_text"/></div></li><li><div class="field field_col"><label>是否为CFA注册猫</label><input type="radio"name="is_cfa"id="'+cat_num+'_yes_cfa"class="radio"value="1"/>是<input type="radio"name="is_cfa"id="'+cat_num+'_no_cfa"class="radio"value="0"/>否</div></li><li><div class="field field_col"><label>参赛组别</label><select id="'+cat_num+'_group"class="sel_input"><option selected="selected"value="0">幼猫组</option><option value="1">成猫公开及冠军组</option><option value="2">成猫GC大冠军组</option><option value="3">绝育公开及冠军组</option><option value="4">绝育GP大冠军组</option><option value="5">杂项</option></select></div></li><li><div class="field field_col"><label>CFA猫只注册名</label><input type="text"id="'+cat_num+'_id"class="input_text"/></div></li><li><div class="field field_col"><label>猫只出生日期</label><input type="text"id="'+cat_num+'_birthday"class="data_input cat_birthday"/><span>（格式为:月/日/年）</span></div></li><li><div class="field field_col"><label>猫只参赛年龄</label><span id="'+cat_num+'_old"></span></div></li><li><div class="field"><label>性别</label><select id="'+cat_num+'_sex"class="sel_input"><option selected="selected"value="0">公</option><option value="1">母</option></select></div><div class="field"><label>眼睛颜色</label><input type="text"id="'+cat_num+'_eye_color"class="input_text"/></div></li><li><div class="field"><label>颜色组别号#</label><input type="text"id="'+cat_num+'_eye_num"class="input_text"/></div><div class="field"><label>颜色描述</label><input type="text"id="'+cat_num+'_eye_detail"class="input_text"/></div></li><li><div class="field field_col"><label>雄亲注册名</label><input type="text"id="'+cat_num+'_fa_name"class="input_text"/></div></li><li><div class="field field_col"><label>雌亲注册名</label><input type="text"id="'+cat_num+'_ma_name"class="input_text"/></div></li><li><div class="field field_col"><label>繁育人姓名</label><input type="text"id="'+cat_num+'_breed_name"class="input_text"/></div></li><li><div class="field field_col"><label>拥有人姓名</label><input type="text"id="'+cat_num+'_own_name"class="input_text"/></div></li><li><div class="field field_col"><label>CFA赛区</label><select id="'+cat_num+'_division" class="sel_input"><option value="D">D - 国际赛区</option></select></div></li></ul></li>';
        before_ele.before(cat_html);
    }
    $('.data_input').datetimepicker({
        showButtonPanel: false,
        dateFormat: "mm/dd/yy",
        alwaysSetTime: false,
        showTime: false
    });
    $('.step_cat_title').click(actCat);
    $('.step_cat_title')[0].click();
}

function showCat(str){
    var _this = $('#cat_'+str)[0];
    var _active = $(".active")[0];
    $('.active').removeClass('active');
    if(_this != _active){
        $('#cat_'+str).addClass('active');
    }
    $('.edit').text('+');
    $('.active .edit').text('-');
}

function actCat(event){
    var num = $(this).find('.number')[0].id;
    showCat(num);
}

function checkAgency(){
    if($('#is_agency:checked').length){
        $('#agency_list').show();
    }else{
        $('#agency_list').hide();
    }
}

$(document).ready(function(){
    checkAgency();
    $('#cat_count').change();
    $('#is_agency').click(checkAgency);
})
