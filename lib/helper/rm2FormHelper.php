<?php

/**
 * util helper
 * 
 * @package lib/helper
 */

/**
 * rm2FormSetReqValue
 * 
 * @param string $reqName name
 * @param string $value   value
 * @param int    $index   index
 * 
 * @return string
 */
function rm2FormSetReqValue($reqName, $value = null, $index = "") {
    $requeset = sfContext::getInstance()->getRequest();
    if ($reqName == null || $reqName == '') {
        return $value;
    }
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

    return $value;
}

/**
 * rm2FormGetParameter
 * 
 * @param string $name         name
 * @param value  $defaultValue value
 * @param int    $index        index
 * 
 * @return string
 */
function rm2FormGetParameter($name, $defaultValue = null, $index = "") {
    $requeset = sfContext::getInstance()->getRequest();
    if ($name == null || $name == '') {
        return $defaultValue;
    }
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

    return $value;
}

/**
 * rm2FormHiddenTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param array  $options option
 * 
 * @return string
 */
function rm2FormHiddenTag($name, $value = null, $options = array()) {
    return input_hidden_tag($name, $value, $options);
}

/**
 * rm2FormInputHiddenTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param array  $options option
 * @param int    $index   index
 * 
 * @return string
 */
function rm2FormInputHiddenTag($name, $value = null, $options = array(), $index = "") {
    return input_hidden_tag($name, rm2FormSetReqValue($name, $value, $index), $options);
}

/**
 * rm2FormInputTag
 * 
 * @param string $name    name
 * @param string $value   value  
 * @param array  $options option
 * 
 * @return string
 */
function rm2FormInputTag($name, $value = null, $options = array()) {
    return input_tag($name, rm2FormSetReqValue($name, $value), $options);
}

/**
 * rm2FormInputPwdTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param array  $options option
 * 
 * @return array
 */
function rm2FormInputPwdTag($name, $value = null, $options = array()) {
    return input_password_tag($name, $value, $options);
}

/**
 * rm2FormFileTag
 * 
 * @param string $name    name
 * @param array  $options option
 * 
 * @return string
 */
function rm2FormFileTag($name, $options = array()) {
    return input_file_tag($name, $options);
}

/**
 * rm2FormInputFileTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param option $options option
 * 
 * @return string
 */
function rm2FormInputFileTag($name, $value, $options = array()) {
    $value = rm2FormSetReqValue($value, null);
    if (is_string($options)) {
        $options .= (($options != "" ? " " : "") . "value=$value");
    } elseif (is_array($options)) {
        $options["value"] = $value;
    } else {
        //
    }
    return input_file_tag($name, $options);
}

/**
 * rm2FormSelectTag
 * 
 * @param string $name          name
 * @param array  $data          data
 * @param string $value         value
 * @param array  $options       option
 * @param array  $selectOptions option
 * 
 * @return string
 */
function rm2FormSelectTag($name, $data = array(), $value = null, $options = array(), $selectOptions = array()) {
    return select_tag($name, options_for_select($data, rm2FormSetReqValue($name, $value), $selectOptions), $options);
}

/**
 * rm2FormTextareaTag
 * 
 * @param string $name    name
 * @param string $content content
 * @param array  $options option
 * 
 * @return string
 */
function rm2FormTextareaTag($name, $content = null, $options = array()) {
    return textarea_tag($name, rm2FormSetReqValue($name, $content), $options);
}

/**
 * rm2FormSelectDayTag
 * 
 * @param string $name        name
 * @param string $value       value
 * @param array  $options     option
 * @param array  $htmlOptions option
 * 
 * @return string
 */
function rm2FormSelectDayTag($name, $value = null, $options = array(), $htmlOptions = array()) {
    if ($value == null || $value == "") {
        $value = date("j");
    }
    return select_day_tag($name, rm2FormSetReqValue($name, $value), $options, $htmlOptions);
}

/**
 * rm2FormSelectDayTag
 * 
 * @param string $name        name
 * @param string $value       value
 * @param array  $options     option
 * @param array  $htmlOptions option
 * 
 * @return string
 */
function rm2FormSelectMonthTag($name, $value = null, $options = array(), $htmlOptions = array()) {
    if ($value == null || $value == "") {
        $value = date("n");
    }
    return select_month_tag($name, rm2FormSetReqValue($name, $value), $options, $htmlOptions);
}

/**
 * rm2FormSelectYearTag
 * 
 * @param string $name        name
 * @param string $value       value
 * @param array  $options     option
 * @param array  $htmlOptions option
 * 
 * @return string
 */
function rm2FormSelectYearTag($name, $value = null, $options = array(), $htmlOptions = array()) {
    if ($value == null || $value == "") {
        $value = date("Y");
    }
    return select_year_tag($name, rm2FormSetReqValue($name, $value), $options, $htmlOptions);
}

/**
 * rm2FormSelectHourTag
 * 
 * @param string $name        name
 * @param string $value       value
 * @param array  $options     option
 * @param array  $htmlOptions option
 * 
 * @return string
 */
function rm2FormSelectHourTag($name, $value = null, $options = array(), $htmlOptions = array()) {
    $hourOption = array(
        "12" => "12:00",
        "1" => "1:00",
        "2" => "2:00",
        "3" => "3:00",
        "4" => "4:00",
        "5" => "5:00",
        "6" => "6:00",
        "7" => "7:00",
        "8" => "8:00",
        "9" => "9:00",
        "10" => "10:00",
        "11" => "11:00",
    );
    if ($value == null || $value == "") {
        $value = date("g");
    }
    return rm2FormSelectTag($name, $hourOption, $value, $htmlOptions);
}

/**
 * rm2FormSelectAmOrPmTag
 * 
 * @param string $name        name
 * @param string $value       value
 * @param array  $options     option
 * @param array  $htmlOptions option
 * 
 * @return string
 */
function rm2FormSelectAmOrPmTag($name, $value = null, $options = array(), $htmlOptions = array()) {
    $hourOption = array(
        "AM" => __("AM"),
        "PM" => __("PM")
    );
    if ($value == null || $value == "") {
        $value = date("A");
    }
    return rm2FormSelectTag($name, $hourOption, $value, $htmlOptions);
}

/**
 * rm2FormSelectDayTag
 * 
 * @param string  $name    name
 * @param string  $value   value
 * @param boolean $checked checked
 * @param array   $options option
 * 
 * @return string
 */
function rm2FormCheckTag($name, $value = null, $checked = false, $options = array()) {
    $v = rm2FormGetParameter($name);
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

/**
 * rm2FormRadionButtonTag
 * 
 * @param string $name      name
 * @param string $value     value
 * @param string $showValue value
 * @param array  $options   option
 * 
 * @return string
 */
function rm2FormRadionButtonTag($name, $value, $showValue, $options = array()) {

    return radiobutton_tag($name, $value, ($value == rm2FormSetReqValue($name, $showValue) ? true : false), $options);
}

/**
 * rm2FormChecBoxkTag
 * 
 * @param string  $name    name
 * @param string  $value   value
 * @param boolean $checked checked
 * @param array   $options option
 * 
 * @return string
 */
function rm2FormChecBoxkTag($name, $value = null, $checked = false, $options = array()) {
    $v = rm2FormGetParameter($name);
    if ($v === null) {
        $checked = $checked;
    } else {
        $checked = in_array($value, $v);
    }
    return checkbox_tag($name, $value, $checked, $options);
}

/**
 * rm2FormAltRow
 * 
 * @param int $index page
 * 
 * @return string|boolean
 */
function rm2FormAltRow($index) {
    if ($index % 2 == 1) {
        return "altRow";
    } else {
        return false;
    }
}

/**
 * rm2FormSort
 * 
 * @param string $name name
 * 
 * @return string
 */
function rm2FormSort($name) {
    $a = array();
    $requeset = sfContext::getInstance()->getRequest();
    $sortBy = rm2FormGetParameter("sortBy");
    $sort = rm2FormGetParameter("sort");
    if ($sortBy == $name) {
        if ($sort == null) {
            $sort = "DESC";
        } else if ($sort == "ASC") {
            $sort = "DESC";
        } else if ($sort == "DESC") {
            $sort = "ASC";
        } else {
            $sort = "ASC";
        }
    } else {
        $sortBy = $name;
    }

    $nums = func_num_args();
    for ($i = 1; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $value = rm2FormGetParameter($parameter);
        if ($value != null) {
            $a[$parameter] = urlencode($value);
        }
    }

    if ($sortBy != null) {
        $a["sortBy"] = $sortBy;
    }
    if ($sort != null) {
        $a["sort"] = $sort;
    }

    $pager = rm2FormGetParameter("pager");
    if ($pager != null) {
        $a["pager"] = $pager;
    }
    $s = html_entity_decode(http_build_query($a));
    return $s;
}

/**
 * rm2FormSortClass
 * 
 * @param string $name name
 * 
 * @return string
 */
function rm2FormSortClass($name) {
    $class = "";
    $requeset = sfContext::getInstance()->getRequest();
    $sortBy = rm2FormGetParameter("sortBy");
    $sort = rm2FormGetParameter("sort");
    if ($name == $sortBy) {
        if ($sort == "DESC") {
            $class = "text_link down";
        } else {
            $class = "text_link up";
        }
    }
    return $class;
}

/**
 * rm2FormGetQuery
 * 
 * @return string
 */
function rm2FormGetQuery() {
    $a = array();
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $arg = func_get_arg($i);
        $list = explode("=", $arg);
        if (count($list) > 1) {
            list($parameter, $defaultValue) = $list;
            $value = rm2FormGetParameter($parameter);
            if ($value != null) {
                $a[$parameter] = urlencode($value);
            } else {
                $a[$parameter] = urlencode($defaultValue);
            }
        } else {
            list($parameter) = $list;
            $value = rm2FormGetParameter($parameter);
            if ($value != null) {
                $a[$parameter] = urlencode($value);
            }
        }
    }
    $value = rm2FormGetParameter("pager");
    if ($value != null) {
        $a["pager"] = $value;
    }
    $s = http_build_query($a);
    return $s;
}

/**
 * rm2FormGetQueryDenyPager
 * 
 * @return string
 */
function rm2FormGetQueryDenyPager() {
    $a = array();
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $value = rm2FormGetParameter($parameter);
        if ($value != null) {
            $a[$parameter] = urlencode($value);
        }
    }
    $s = http_build_query($a);
    return $s;
}

/**
 * rm2FormInputActiveRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * @param string $buttom   buttom
 * @param string $befor    befor
 * 
 * @return string
 */
function rm2FormInputActiveRadio($name, $value, $callback = "", $buttom = "<div class='clear'></div>", $befor = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $befor . '\');">' . sfContext::getInstance()->getI18N()->__("Active", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $befor . '\');">' . sfContext::getInstance()->getI18N()->__("Inactive", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

/**
 * rm2FormInputDefaultRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * @param string $buttom   buttom
 * @param string $befor    befor
 * 
 * @return string
 */
function rm2FormInputDefaultRadio($name, $value, $callback = "", $buttom = "<div class='clear'></div>", $befor = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 0 ? "active" : "deactivated") . '" onclick="return setDefaultRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $befor . '\');">' . sfContext::getInstance()->getI18N()->__("Default", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 1 ? "inactive" : "deactivated") . '" onclick="return setDefaultRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $befor . '\');">' . sfContext::getInstance()->getI18N()->__("Override ", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

/**
 * rm2FormInputCacheOptionsRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * @param string $buttom   buttom
 * @param string $befor    befor
 * 
 * @return string
 */
function rm2FormInputCacheOptionsRadio($name, $value, $callback = "", $buttom = "<div class='clear'></div>", $befor = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a style="width:80px;" id="' . $name . 'Default" name="' . $name . 'Default" href="javascript:" class="' . ($value == 0 ? "active" : "deactivated") . '" onclick="return setCacheOption(this, \'' . $name . '\', \'0\');">' . sfContext::getInstance()->getI18N()->__("Default/Inherit", null, "messages") . '</a></span>';
    $html .= "\r\n";

    $html .= '<span><a style="width:30px;" id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setCacheOption(this, \'' . $name . '\', \'1\');">' . sfContext::getInstance()->getI18N()->__("On ", null, "messages") . '</a></span>';
    $html .= "\r\n";

    $html .= '<span><a style="width:30px;" id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 2 ? "active" : "deactivated") . '" onclick="return setCacheOption(this, \'' . $name . '\', \'2\');">' . sfContext::getInstance()->getI18N()->__("Off ", null, "messages") . '</a></span>';
    $html .= "\r\n";

    $html .= '<span><a style="width:80px;" id="' . $name . 'Static" name="' . $name . 'Static" href="javascript:" class="' . ($value == 3 ? "active" : "deactivated") . '" onclick="return setCacheOption(this, \'' . $name . '\', \'3\');">' . sfContext::getInstance()->getI18N()->__("Static HTML ", null, "messages") . '</a></span>';
    $html .= "\r\n";

    $html .= $buttom;
    return $html;
}

/**
 * rm2FormInputNoneRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * @param string $buttom   buttom
 * @param string $befor    befor
 * 
 * @return string
 */
function rm2FormInputNoneRadio($name, $value, $callback = "", $buttom = "<div class='clear'></div>", $befor = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 0 ? "active" : "deactivated") . '" onclick="return setDefaultRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $befor . '\');">' . sfContext::getInstance()->getI18N()->__("None", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 1 ? "inactive" : "deactivated") . '" onclick="return setDefaultRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $befor . '\');">' . sfContext::getInstance()->getI18N()->__("Static HTML", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

/**
 * rm2FormInputYesNoRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * 
 * @return string
 */
function rm2FormInputYesNoRadio($name, $value, $callback = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\');">' . __("Yes") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\');">' . __("No") . '</a>';
    $html .= "\r\n";
    $html .= '<div class="clear"></div>';
    return $html;
}

/**
 * rm2FormInputYesNoRadioJs
 * 
 * @param string $name        name
 * @param string $value       value
 * @param string $callback    callback
 * @param string $functionYes yes
 * @param string $functionNo  not
 * 
 * @return string
 */
function rm2FormInputYesNoRadioJs($name, $value, $callback = "", $functionYes = "", $functionNo = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\');' . $functionYes . '">' . __("Yes") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick=" setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\');' . $functionNo . '">' . __("No") . '</a>';
    $html .= "\r\n";
    $html .= '<div class="clear"></div>';
    return $html;
}

/**
 * rm2FormInputDefaultRadioJs
 * 
 * @param string $name        name
 * @param string $value       value
 * @param string $callback    callback
 * @param string $functionYes yes
 * @param string $functionNo  not
 * 
 * @return string
 */
function rm2FormInputDefaultRadioJs($name, $value, $callback = "", $functionYes = "", $functionNo = "") {
    $value = rm2FormSetReqValue($name, $value);
    $html = "";
    $html .= rm2FormInputHiddenTag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a style="width:100px;" id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\');' . $functionYes . '">' . sfContext::getInstance()->getI18N()->__("Inherit from section", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick=" setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\');' . $functionNo . '">' . sfContext::getInstance()->getI18N()->__("Override ", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= '<div class="clear"></div>';
    return $html;
}

/**
 * rm2FormHasError
 * 
 * @return boolean
 */
function rm2FormHasError() {
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        if (form_has_error($parameter)) {
            return true;
        }
    }
    return false;
}

/**
 * rm2FormGetError
 * 
 * @return string
 */
function rm2FormGetError() {
    $s = "";
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $s .= strip_tags(form_error($parameter)) . "\r\n";
    }
    return $s;
}

/**
 * rm2FormGetErrorSelectTab
 * 
 * @param int $index index
 * 
 * @return string
 */
function rm2FormGetErrorSelectTab($index = 0) {
    $s = "";
    $nums = func_num_args();
    $falg = false;
    for ($i = 1; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        if ($parameter == null) {
            continue;
        }
        foreach ($parameter as $name) {
            if (form_has_error($name)) {
                $falg = true;
                break 2;
            }
        }
    }
    if ($falg && $index == ($i)) {
        $s = "selected";
    } else if ($index == 1) {
        $s = "selected";
    }
    return $s;
}

/**
 * utilSetDisplayRowNum
 * 
 * @param string $url url
 * 
 * @return string
 */
function utilSetDisplayRowNum($url) {
    $displayRowNum = "";
    $displayRowNum .= DBUtil::getPageRowNum() != 10 ? '<a href="' . $url . "/PageRowNum/10" . '" onclick="rm2SetCookie(\'PageRowNum\', 10, 0, \'/\')">10</a> ' : '10 ';
    $displayRowNum .= DBUtil::getPageRowNum() != 20 ? '<a href="' . $url . "/PageRowNum/20" . '" onclick="rm2SetCookie(\'PageRowNum\', 20, 0, \'/\')">20</a> ' : '20 ';
    $displayRowNum .= DBUtil::getPageRowNum() != 30 ? '<a href="' . $url . "/PageRowNum/30" . '" onclick="rm2SetCookie(\'PageRowNum\', 30, 0, \'/\')">30</a> ' : '30 ';
    $displayRowNum .= DBUtil::getPageRowNum() != 40 ? '<a href="' . $url . "/PageRowNum/40" . '" onclick="rm2SetCookie(\'PageRowNum\', 40, 0, \'/\')">40</a> ' : '40 ';
    $displayRowNum .= DBUtil::getPageRowNum() != 50 ? '<a href="' . $url . "/PageRowNum/50" . '" onclick="rm2SetCookie(\'PageRowNum\', 50, 0, \'/\')">50</a> ' : '50 ';
    $displayRowNum .= "<script>rm2SetCookie('PageRowNum', " . DBUtil::getPageRowNum() . ", 0, '/');</script>";
    return __("specify number of rows to display:") . " " . $displayRowNum;
}

/**
 * rm2PagerDisplayRows
 * 
 * @param int $pager page
 * 
 * @return int
 */
function rm2PagerDisplayRows($pager) {
    if ($pager["pagerPage"] > 0) {
        $start = ($pager["pager"] - 1) * $pager["pagerPageRowNum"] + 1;
        $end = $pager["pager"] != $pager["pagerPage"] ? ($start + $pager["pagerPageRowNum"] - 1) : ($pager["pagerRowNum"] % $pager["pagerPageRowNum"] == 0 ? $start - 1 + $pager["pagerPageRowNum"] : $start - 1 + (int) ($pager["pagerRowNum"] % $pager["pagerPageRowNum"]));
    } else {
        $start = 0;
        $end = 0;
    }
    $s = "$start-$end";
    return $s;
}

/**
 * rm2PagerDisplayTotal
 * 
 * @param int $pager page
 * 
 * @return int
 */
function rm2PagerDisplayTotal($pager) {
    $s = $pager["pagerRowNum"];
    return $s;
}

?>