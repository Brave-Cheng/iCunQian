<?php
function formAltRow($index) {
    if ($index % 2 == 1) { 
        return "altRow"; 
    } else {
        return false;
    }
}

function formSetReqValue($reqName, $value = null, $index = "") {
    $requeset = sfContext::getInstance()->getRequest();
    if ($reqName == null || $reqName == '') { return $value; }
    $reqName = str_replace(array("[", "]"), array("", ""), $reqName);
    if ($requeset->hasParameter($reqName)) {
        $reqValue = $requeset->getParameter($reqName);        
        if (is_array($reqValue) && $index !== "") {
            $value = $reqValue[$index];
        } else {
            $value = $reqValue;
        }
    } else {
        if (is_array($value) && $index !== "") {
            $value = $value[$index];
        }
    }
    $value = urldecode($value);
    return $value;
}

function formGetParameter($name, $defaultValue = null, $index = "") {
    $requeset = sfContext::getInstance()->getRequest();
    if ($name == null || $name == '') { return $defaultValue; }
    $name = str_replace(array("[", "]"), array("", ""), $name);
    $value = null;
    if ($requeset->hasParameter($name)) {
        $reqValue = $requeset->getParameter($name);
        if (is_object($reqValue) && $index != "") {
            $value = $reqValue[$index];
        } else {
            $value = $reqValue;
        }
    } else {
        if (is_object($value) && $index != "") {
            $value = $value[$index];
        }
    }
    $value = urldecode($value);
    return $value;
}

function formSort($name) {
    $a = array();
    $requeset = sfContext::getInstance()->getRequest();
    $sortBy = formGetParameter("sortBy");
    $sort = formGetParameter("sort");
    if ($sortBy == $name) {
        if ($sort == null) { $sort = "DESC"; }
        else if ($sort == "ASC") { $sort = "DESC"; }
        else if ($sort == "DESC") { $sort = "ASC"; }
        else { $sort = "ASC"; }
    } else { $sortBy = $name; }
    $nums = func_num_args();
    for ($i = 1; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $value = formGetParameter($parameter);
        if ($value != null) { $a[$parameter] = urlencode($value); }
    }
    if ($sortBy != null) { $a["sortBy"] = $sortBy; }
    if ($sort != null) { $a["sort"] = $sort; }

    $pager = formGetParameter("pager");
    if ($pager != null) { $a["pager"] = $pager; }
    $s = http_build_query($a);
    return $s;
}

function formSortClass($name) {
    $class = "";
    $requeset = sfContext::getInstance()->getRequest();
    $sortBy = formGetParameter("sortBy");
    $sort = formGetParameter("sort");
    if ($name == $sortBy) {
        if ($sort == "DESC") { $class = "text_link down"; } 
        else { $class = "text_link up"; }
    }
    return $class;
}

function formGetQuery() {
    $a = array();
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $arg = func_get_arg($i);        
        $list = explode("=", $arg);
        if (count($list) > 1) {
            list($parameter, $defaultValue) = $list;
            $value = formGetParameter($parameter);
            if ($value != null) { $a[$parameter] = urlencode($value); }
            else { $a[$parameter] = urlencode($defaultValue); }
        } else {
            list($parameter) = $list;
            $value = formGetParameter($parameter);
            if ($value != null) { $a[$parameter] = urlencode($value); }
        }
    }
    $value = formGetParameter("pager");
    if ($value != null) { $a["pager"] = $value; }
    $s = http_build_query($a);
    return $s;
}

function formGetQueryDenyPager() {
    $a = array();
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $value = formGetParameter($parameter);
        if ($value != null) { $a[$parameter] = urlencode($value); }
    }
    $s = http_build_query($a);   
    return $s;
}
/*
//rm
function utilPagerPages($pager, $url, $param) {
    $s = "";
    $parseUrl = parse_url($url);
    $url = $parseUrl['path'];
    $setDisplayUrl = $url;
    if ($pager["pagerPage"] > 0) {
        if($pager["pagerPage"] > 10){
            $u  = url_for($url . "?$param&pager=1");
            $s .= "<a href='$u'><< </a>";
            $p  = ($pager["pager"]-1 > 0) ? ($pager["pager"]-1) : 1;
            $u  = url_for($url . "?$param&pager=".$p);
            $s .= "&nbsp;<a href='$u'>< </a>";           
            for ($i = 1; $i <= 5; $i++) {
                if ($i == $pager["pager"]) {
                    $s .= " $i";
                    if ($param == "") { $u = url_for($url . "?pager=$i"); }
                    else { $u = url_for($url . "?$param&pager=$i"); }
                    $setDisplayUrl = $u;
                } else {
                    if ($param == "") { $u = url_for($url . "?pager=$i"); }
                    else { $u = url_for($url . "?$param&pager=$i"); }
                    $s .= " <a href='$u'>$i</a>";
                }
            }           
            $u  = url_for($url . "?$param&pager=");
            $rand = rand(1, 1000);
            $s .= "&nbsp;&nbsp;<input type='text' name='go".$rand."' id='go".$rand."' value='' size='2' />";
            $s .= "<input type='button' value='Go' onclick=\"javascript:location.href='".$u."/"."'+document.getElementById('go".$rand."').value\"  />&nbsp;&nbsp;";           
            for ($i = $pager["pagerPage"]-5; $i <= $pager["pagerPage"]; $i++) {
                if ($i == $pager["pager"]) {
                    $s .= " $i";
                    if ($param == "") { $u = url_for($url . "?pager=$i"); }
                    else { $u = url_for($url . "?$param&pager=$i"); }
                    $setDisplayUrl = $u;
                } else {
                    if ($param == "") { $u = url_for($url . "?pager=$i"); }
                    else { $u = url_for($url . "?$param&pager=$i"); }
                    $s .= " <a href='$u'>$i</a>";
                }
            }           
            $p  = ($pager["pager"]+1 > $pager["pagerPage"]) ? $pager["pagerPage"] : ($pager["pager"]+1);
            $u  = url_for($url . "?$param&pager=".$p);
            $s .= "&nbsp;<a href='$u'> ></a>";
            $p  = $pager["pagerPage"];
            $u  = url_for($url . "?$param&pager=".$p);
            $s .= "<a href='$u'> >></a>";
        }else{
            for ($i = 1; $i <= $pager["pagerPage"]; $i++) {
                if ($i == $pager["pager"]) {
                    $s .= " $i";
                    if ($param == "") { $u = url_for($url . "?pager=$i"); }
                    else { $u = url_for($url . "?$param&pager=$i"); }
                    $setDisplayUrl = $u;
                } else {
                    if ($param == "") { $u = url_for($url . "?pager=$i"); }
                    else { $u = url_for($url . "?$param&pager=$i"); }
                    $s .= " <a href='$u'>$i</a>";
                }
            }
        }
    } else {
        $i = 1;
        $s .= " 0";
        if ($param == "") { $u = url_for($url . "?pager=$i"); }
        else { $u = url_for($url . "?$param&pager=$i"); }
        $setDisplayUrl = $u;
    }
    return $s . "&nbsp;&nbsp;&nbsp;&nbsp;" . utilSetDisplayRowNum($setDisplayUrl);
}
*/
//OA
function utilPagerPages($pager, $url, $param) { 
    $s = '';
    /*
    //分页函数的参数说明
    //var_dump($pager);
    //var_dump($pager['pagerPage']);//总的页数
    //var_dump($pager['pager']);//当前页
    //var_dump($pager['pagerRowNum']);//记录的总条数
    //var_dump($pager['pagerPageRowNum']);//每页显示条数(如:20条)
    */
    if ($pager['pagerPage'] > 0) {
    	/*
        if($pager['pager'] > 1){
            $p  = ($pager['pager']-1 > 0) ? ($pager['pager']-1) : 1;
            $u  = url_for($url . "?$param&pager=".$p);
            $s .= "&nbsp;<a href='$u'>上一页</a>&nbsp;"; 
        }
        */
        $u  = url_for($url . "?$param&pager=");
        $s .= '<span> 请选择一个数字跳到 ';
        $s .= "<select class='select' name='page' onChange=\"javascript:location.href='".$u."/"."' + this.value \" >";
        for ($i = 1; $i <= $pager["pagerPage"]; $i++) {
            if($i == $pager['pager']){
                $s .= '<option selected = "selected" value="' . $i . '">' . $i . '</option>';
            }else{
                $s .= '<option value="' . $i . '">' . $i . '</option>';
            }
        }
        $s .= '</select>';
        $s .= ' 页';
        if($pager['pager'] > 1){
            $p  = ($pager['pager']-1 > 0) ? ($pager['pager']-1) : 1;
            $u  = url_for($url . "?$param&pager=".$p);
            $s .= "&nbsp;<a href='$u'>上一页</a>&nbsp;"; 
        }
        if( $pager['pager'] < $pager[ 'pagerPage']){
            $p  = ($pager['pager']+1 > $pager['pagerPage']) ? $pager['pagerPage'] : ($pager['pager']+1);
            $u  = url_for($url . "?$param&pager=".$p);
            $s .= "&nbsp;<a href='$u'>下一页</a></span>";
        }
    } else {
        $i = 1;
        $s .= "<select class='select' name='page' id='page' >";
        $s .= '<option value="' . $i . '">' . $i . '</option>';
        $s .= '</select>';
    }
    return $s;

}

function utilPagerDisplayRows($pager) {
    if ($pager["pagerPage"] > 0) {
        $start = ($pager["pager"] - 1) * $pager["pagerPageRowNum"] + 1;
        $end = $pager["pager"] != $pager["pagerPage"] ? ($start + $pager["pagerPageRowNum"] - 1) : ($pager["pagerRowNum"] % $pager["pagerPageRowNum"] == 0 ? $start - 1 + $pager["pagerPageRowNum"] : $start - 1 + (int)($pager["pagerRowNum"] % $pager["pagerPageRowNum"]));
    } else {
        $start = 0;
        $end = 0;
    }
    $s = "$start-$end";
    return $s;
}

function utilSetDisplayRowNum($url) {
    sfLoader::loadHelpers("Url");
    $currentPageRowNum = DBUtil::getPageRowNum();
    $pageRowNumArray   = range(10, 50, 10);
    $displayRowNum = "";
    foreach ($pageRowNumArray as $pageRowNum){
        if($currentPageRowNum == $pageRowNum){
            $displayRowNum .= $currentPageRowNum . " ";
        }else{
            $displayRowNum .= '<a href="'.$url."/PageRowNum/".$pageRowNum.'" onclick="$.cookie(\'PageRowNum\', '.$pageRowNum.', {expires: 7, path: \'/\'})">'.$pageRowNum.'</a> ';
        }
    }
    $displayRowNum .= "<script>$.cookie('PageRowNum', " . DBUtil::getPageRowNum() . ", {expires: 7, path: '/'});</script>";
    return __("specify number of rows to display:") . " " . $displayRowNum;
}

function utilPagerDisplayTotal($pager) {
    $s = $pager["pagerRowNum"];
    return $s;
}

function formInputActiveRadio($name, $value, $callback = "", $buttom="<div class='clear'></div>", $before="") {
    $request = sfContext::getInstance()->getRequest();
    $value   = $request->hasParameter($name) ? $request->getParameter($name) : $value;
    $html  = "";
    $html .= input_hidden_tag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("Active", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("Inactive", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

function formInputYesRadio($name, $value, $callback = "", $buttom="<div class='clear'></div>", $before="") {
    $request = sfContext::getInstance()->getRequest();
    $value   = $request->hasParameter($name) ? $request->getParameter($name) : $value;
    $html  = "";
    $html .= input_hidden_tag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("Yes", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("No", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

function formSelectStatusTag($name, $value = '', $options = array()){
    $request = sfContext::getInstance()->getRequest();
    $value = $request->hasParameter($name) ? $request->getParameter($name) : $value;
    $status= util::getStatus();
    return select_tag($name, options_for_select($status, $value, array("include_custom" => "--Select One--")), $options);
}

function formHasError() {
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        if (form_has_error($parameter)) { return true; }
    }
    return false;
}

function formGetError() {
    $s = "";
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $s .= strip_tags(form_error($parameter)) . "\r\n";
    }
    return $s;
}

function formGetErrorSelectTab($index=0) {
    $s = "";
    $nums = func_num_args();
    $falg = false;
    for ($i = 1; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        if ($parameter == null) { continue; }
        foreach ($parameter as $name) {
            if (form_has_error($name)) { $falg = true; break 2; }
        }
    }
    if ($falg && $index == ($i)) {
        $s = "selected";
    } else if($index == 1) {
        $s = "selected";
    }
    return $s;
}

function formInputTag($name, $value = null, $options = array()) {
    return input_tag($name, formSetReqValue($name, $value), $options);
}

function formInputHiddenTag($name, $value = null, $options = array()) {
    return input_hidden_tag($name, formSetReqValue($name, $value), $options);
}

function form_span_error($param, $options = array(), $catalogue = 'messages'){
    $param_for_sf = str_replace(array('[', ']'), array('{', '}'), $param);
    $param = str_replace(array('{', '}'), array('[', ']'), $param);

    $options = _parse_attributes($options);

    $request = sfContext::getInstance()->getRequest();

    $style = $request->hasError($param_for_sf) ? '' : 'display:none;';
    $options['style'] = $style.(isset($options['style']) ? $options['style']:'');

    if (!isset($options['class'])){
    $options['class'] = sfConfig::get('sf_validation_error_class', 'form_error');
    }
    if (!isset($options['id'])){
    $options['id'] = sfConfig::get('sf_validation_error_id_prefix', 'error_for_').get_id_from_name($param);
    }

    $prefix = sfConfig::get('sf_validation_error_prefix', '');
    if (isset($options['prefix'])){
        $prefix = $options['prefix'];
        unset($options['prefix']);
    }

    $suffix = sfConfig::get('sf_validation_error_suffix', '');
    if (isset($options['suffix'])){
        $suffix = $options['suffix'];
        unset($options['suffix']);
    }
    $error = $request->getError($param_for_sf, $catalogue);
    return content_tag('span', $prefix.$error.$suffix, $options)."\n";
}

function formFileTag($name, $options = array()) {
    return input_file_tag($name, $options);
}

function formCheckTag($name, $value = null, $checked = false, $options = array()) {
    $v = formGetParameter($name);
    if ($v === null) {
        if ($value == $checked) {
            $checked = true; 
        }
    } else {
        if ($v == $value && $value != null && $value != "") { 
            $checked = true; 
        } else { 
            $checked = false; 
        }
    }
    return checkbox_tag($name, $value, $checked, $options);
}

function formTextareaTag($name, $content = null, $options = array()) {
    return textarea_tag($name, formSetReqValue($name, $content), $options);
}


