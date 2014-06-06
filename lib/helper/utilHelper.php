<?php

/**
 *  util helper
 * 
 * @package lib/helper
 */

/**
 * get alt row
 * 
 * @param int $index page
 * 
 * @return mixed
 */
function formAltRow($index) {
    if ($index % 2 == 1) {
        return "altRow";
    } else {
        return false;
    }
}

/**
 * form set req value
 * 
 * @param string $reqName name
 * @param string $value   value
 * @param string $index   index
 * 
 * @return string
 */
function formSetReqValue($reqName, $value = null, $index = "") {
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
    $value = urldecode($value);
    return $value;
}

/**
 * formGetParameter
 * 
 * @param string $name         name
 * @param string $defaultValue value
 * @param string $index        index
 * 
 * @return string 
 */
function formGetParameter($name, $defaultValue = null, $index = "") {
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
    $value = urldecode($value);
    return $value;
}

/**
 * formSort 
 * 
 * @param string $name name
 * 
 * @return string
 */
function formSort($name) {
    $a = array();
    $requeset = sfContext::getInstance()->getRequest();
    $sortBy = formGetParameter("sortBy");
    $sort = formGetParameter("sort");
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
        $value = formGetParameter($parameter);
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

    $pager = formGetParameter("pager");
    if ($pager != null) {
        $a["pager"] = $pager;
    }
    $s = http_build_query($a);
    return $s;
}

/**
 * formSortClass
 * 
 * @param string $name name
 * 
 * @return string
 */
function formSortClass($name) {
    $class = "";
    $requeset = sfContext::getInstance()->getRequest();
    $sortBy = formGetParameter("sortBy");
    $sort = formGetParameter("sort");
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
 * formGetQuery
 * 
 * @return string
 */
function formGetQuery() {
    $a = array();
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $arg = func_get_arg($i);
        $list = explode("=", $arg);
        if (count($list) > 1) {
            list($parameter, $defaultValue) = $list;
            $value = formGetParameter($parameter);
            if ($value != null) {
                $a[$parameter] = urlencode($value);
            } else {
                $a[$parameter] = urlencode($defaultValue);
            }
        } else {
            list($parameter) = $list;
            $value = formGetParameter($parameter);
            if ($value != null) {
                $a[$parameter] = urlencode($value);
            }
        }
    }
    $value = formGetParameter("pager");
    if ($value != null) {
        $a["pager"] = $value;
    }
    $s = http_build_query($a);
    return $s;
}

/**
 * formGetQueryDenyPager
 * 
 * @return string
 */
function formGetQueryDenyPager() {
    $a = array();
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $value = formGetParameter($parameter);
        if ($value != null) {
            $a[$parameter] = urlencode($value);
        }
    }
    $s = http_build_query($a);
    return $s;
}

/**
 * utilPagerPages
 * 
 * @param int    $pager page
 * @param string $url   url
 * @param string $param param
 * 
 * @return string
 */
function utilPagerPages($pager, $url, $param) {
    $s = '';
    if ($pager['pagerPage'] > 0) {
        $u = url_for($url . "?$param&pager=");
        $s .= '<span>' . util::getMultiMessage('Choose Number Jump');
        $s .= "<select class='select' name='page' onChange=\"javascript:location.href='" . $u . "/" . "' + this.value \" >";
        for ($i = 1; $i <= $pager["pagerPage"]; $i++) {
            if ($i == $pager['pager']) {
                $s .= '<option selected = "selected" value="' . $i . '">' . $i . '</option>';
            } else {
                $s .= '<option value="' . $i . '">' . $i . '</option>';
            }
        }
        $s .= '</select>';
        $s .= util::getMultiMessage('Page');
        if ($pager['pager'] > 1) {
            $p = ($pager['pager'] - 1 > 0) ? ($pager['pager'] - 1) : 1;
            $u = url_for($url . "?$param&pager=" . $p);
            $s .= "&nbsp;<a href='$u'>" .util::getMultiMessage("Previous Page"). "</a>&nbsp;";
        }
        if ($pager['pager'] < $pager['pagerPage']) {
            $p = ($pager['pager'] + 1 > $pager['pagerPage']) ? $pager['pagerPage'] : ($pager['pager'] + 1);
            $u = url_for($url . "?$param&pager=" . $p);
            $s .= "&nbsp;<a href='$u'>" . util::getMultiMessage("Next Page") . "</a></span>";
        }
    } else {
        $i = 1;
        $s .= "<select class='select' name='page' id='page' >";
        $s .= '<option value="' . $i . '">' . $i . '</option>';
        $s .= '</select>';
    }
    return $s;
}

/**
 * utilPagerDisplayRows
 * 
 * @param int $pager page
 * 
 * @return int
 */
function utilPagerDisplayRows($pager) {
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
 * utilPagerDisplayTotal
 * 
 * @param int $pager page
 * 
 * @return int
 */
function utilPagerDisplayTotal($pager) {
    $s = $pager["pagerRowNum"];
    return $s;
}

/**
 * formInputActiveRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * @param string $buttom   buttom
 * @param string $before   before
 * 
 * @return string
 */
function formInputActiveRadio($name, $value, $callback = "", $buttom = "<div class='clear'></div>", $before = "") {
    $request = sfContext::getInstance()->getRequest();
    $value = $request->hasParameter($name) ? $request->getParameter($name) : $value;
    $html = "";
    $html .= input_hidden_tag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("Active", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("Inactive", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

/**
 * formInputYesRadio
 * 
 * @param string $name     name
 * @param string $value    value
 * @param string $callback callback
 * @param string $buttom   buttom
 * @param string $before   before
 * 
 * @return string
 */
function formInputYesRadio($name, $value, $callback = "", $buttom = "<div class='clear'></div>", $before = "") {
    $request = sfContext::getInstance()->getRequest();
    $value = $request->hasParameter($name) ? $request->getParameter($name) : $value;
    $html = "";
    $html .= input_hidden_tag($name, $value);
    $html .= "\r\n";
    $html .= '<span><a id="' . $name . 'Yes" name="' . $name . 'Yes" href="javascript:" class="' . ($value == 1 ? "active" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("Yes", null, "messages") . '</a></span>';
    $html .= "\r\n";
    $html .= '<a id="' . $name . 'No" name="' . $name . 'No" href="javascript:" class="' . ($value == 0 ? "inactive" : "deactivated") . '" onclick="return setActiveRadio(this, \'' . $name . '\', \'' . $callback . '\', \'' . $before . '\');">' . __("No", null, "messages") . '</a>';
    $html .= "\r\n";
    $html .= $buttom;
    return $html;
}

/**
 * formSelectStatusTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param array  $options option
 * 
 * @return string
 */
function formSelectStatusTag($name, $value = '', $options = array()) {
    $request = sfContext::getInstance()->getRequest();
    $value = $request->hasParameter($name) ? $request->getParameter($name) : $value;
    $status = util::getStatus();
    return select_tag($name, options_for_select($status, $value, array("include_custom" => "--Select One--")), $options);
}

/**
 * formHasError
 * 
 * @return boolean
 */
function formHasError() {
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
 * formGetError
 * 
 * @return string
 */
function formGetError() {
    $s = "";
    $nums = func_num_args();
    for ($i = 0; $i < $nums; $i++) {
        $parameter = func_get_arg($i);
        $s .= strip_tags(form_error($parameter)) . "\r\n";
    }
    return $s;
}

/**
 * formGetErrorSelectTab
 * 
 * @param int $index page
 * 
 * @return string
 */
function formGetErrorSelectTab($index = 0) {
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
 * formInputTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param array  $options option
 * 
 * @return string
 */
function formInputTag($name, $value = null, $options = array()) {
    return input_tag($name, formSetReqValue($name, $value), $options);
}

/**
 * formInputHiddenTag
 * 
 * @param string $name    name
 * @param string $value   value
 * @param array  $options option
 * 
 * @return string
 */
function formInputHiddenTag($name, $value = null, $options = array()) {
    return input_hidden_tag($name, formSetReqValue($name, $value), $options);
}

/**
 * formFileTag
 * 
 * @param string $name    name
 * @param array  $options option
 * 
 * @return string
 */
function formFileTag($name, $options = array()) {
    return input_file_tag($name, $options);
}

/**
 * formCheckTag
 * 
 * @param string  $name    name
 * @param string  $value   value
 * @param boolean $checked checked
 * @param array   $options option
 * 
 * @return string
 */
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

/**
 * get textarea tag
 * 
 * @param string $name    tag name
 * @param string $content content
 * @param array  $options option list
 * 
 * @return string
 */
function formTextareaTag($name, $content = null, $options = array()) {
    return textarea_tag($name, formSetReqValue($name, $content), $options);
}

