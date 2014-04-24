function show(did, flagid) {
    var div = document.getElementById(did);
    var flag = document.getElementById(flagid);
    if (div.style.display == "none") {
        div.style.display = "block";
        flag.value = 1;
    } else {
        div.style.display = "none";
        flag.value = 0;
    }
}

function formSubmit(fid, action, method, submit) {
    if (fid == null || fid == "" || fid == false) {
        location.href = action;
        return false;
    }
    var frm = document.getElementById(fid);
    frm.action = action;
    if (method) {
        frm.method = method;
    }
    frm.submit();
    return false;
}

function dormDeleteConfirm(form, url, msg) {
    formSubmit(form, url);
    return false;
}

function setCookie(cookieName, cookieValue, expires, path, domain, secure) {
    document.cookie =
        escape(cookieName) + '=' + escape(cookieValue)
        + (expires ? '; expires=' + expires.toGMTString() : '')
        + (path ? '; path=' + path : '')
        + (domain ? '; domain=' + domain : '')
        + (secure ? '; secure' : '');
}
;

function formSelectCheck(style) {
    var checkboxList = $(style);
    if (checkboxList && checkboxList.length < 2)
        return;
    for (var i = 1; i < checkboxList.length; i++) {
        checkboxList[i].checked = checkboxList[0].checked;
    }
}

function showDialog(msgDivId, hasNoButton, form, url) {
    var params;
    if (hasNoButton) {
        params = {
            resizable: false,
            maxheight: 200,
            modal: true,
            buttons: {
                '确认': function() {
                    $(this).dialog('close');
                    $('#' + msgDivId).remove();
                    if (form != '') {
                        dormDeleteConfirm(form, url);
                    } else if (url != '') {
                        location.href = url;
                    }
                },
                '关闭': function() {
                    $(this).dialog('close');
                    $('#' + msgDivId).remove();
                }
            }
        }
    } else {
        params = {
            resizable: false,
            maxheight: 200,
            modal: true,
            buttons: {
                '确认': function() {
                    $(this).dialog('close');
                    $('#' + msgDivId).remove();
                    if (url != '') {
                        location.href = url;
                    }
                }
            }
        }
    }
    $('#' + msgDivId).dialog(params);
}

function showSaveSuccessfullyMessage(msg, url) {
    if (!msg) {
        msg = '保存成功';
    }
    if (!url) {
        url = '';
    }
    $('body').append("<div class='promat' id='save_promat' title='提示'><p>" + msg + "</p></div>");
    showDialog('save_promat', false, '', url);
}

function showDeleteConfirmMessage(msg, form, url) {
    if (!msg) {
        msg = '这将会永久删除选中的内容。你确定吗？';
    }
    if (!form) {
        form = '';
    }
    $('body').append("<div class='promat' id='delete_promat' title='提示'><p>" + msg + "</p></div>");
    showDialog('delete_promat', true, form, url);
    return false;
}

function setSearchType(inputId) {
    $('#' + inputId).focus(function() {
        $(this).val("");
    })
}

function addOption(obj) {
    var leftParent = obj.parent().parent().parent().attr('id');
    leftParentId = leftParent.substr(6);
    var userName = obj.text();
    var userId = obj.attr('id');
    var userLi = $('<li>');
    userLi.attr({'class': 'muser', 'id': 'muser_' + userId}).appendTo($('#right_' + leftParentId).find('ul'));
    var textSpan = $('<span>');
    textSpan.text(userName).appendTo(userLi);
    var inputSpan = $('<span>');
    inputSpan.attr('class', 'right').appendTo(userLi);
    var dele = $('<a>');
    dele.attr({'title': '点击移除', 'href': 'javascript:void();', 'data-name': userName, 'id': userId}).text('删除成员').appendTo(inputSpan);
    dele.bind('click', function() {
        removeOption(dele);
    })
    var hiddenInput = $('<input/>');
    hiddenInput.css('display', 'none');
    hiddenInput.attr({'name': 'userId[]', 'id': 'muser_' + userId}).val(userId).appendTo(inputSpan);
    $('#right_' + leftParentId).show();
    $("#user_" + userId).remove();
}

function removeOption(obj) {
    var userName = $(obj).attr('data-name');
    var userId = $(obj).attr('id');
    var rightParent = $(obj).parent().parent().parent().parent().attr('id');
    rightParentId = rightParent.substr(6);
    var userLi = $('<li>');
    userLi.attr('id', 'user_' + userId).appendTo($('#lleft_' + rightParentId + ' > ' + 'ul'));
    var addUser = $('<a>');
    addUser.attr({'title': '点击添加', 'href': 'javascript:void();', 'id': userId}).text(userName).appendTo(userLi);
    addUser.bind('click', function() {
        addOption(addUser);
    });
    $('#muser_' + userId).remove();
}

/**
 * 
 * @param {type} changeValueElement the changed input
 * @param {type} elementOne
 * @param {type} elementTwo
 * @returns {undefined}                                     */
function calculateAmount(changeValueElement, elementOne, elementTwo) {
    var elementOneValue = $("input." + elementOne).val();
    var elementTwoValue = $("input." + elementTwo).val();
    if (!isNumber(elementOneValue)) {
        $("input." + elementOne).css("border", "1px solid #C93333");
    } else {
        $("input." + elementOne).css("border", "");
    }
    if (!isNumber(elementTwoValue)) {
        $("input." + elementTwo).css("border", "1px solid #C93333");
    } else {
        $("input." + elementTwo).css("border", "");
    }
    var changedAmount = (Number(elementOneValue) + Number(elementTwoValue)).toFixed(2);
    if (isNumber(changedAmount)) {
        $("input." + changeValueElement).val(changedAmount);
    } else {
        $("input." + changeValueElement).val('');
    }
}



function isNumber(String) {
    var Letters = "-1234567890."; //可以自己增加可输入值 
    var i, c;
//    if (String.charAt(0) == '-' || String.charAt(String.length - 1) == '-') {
//        return false;
//    }
    for (i = 0; i < String.length; i++) {
        c = String.charAt(i);
        if (Letters.indexOf(c) < 0) {
            return false;
        }
    }
    return true;
}

function afterFourDecimals( string ){
	var decimals = /^(-)?(\d){0,11}\.{0,1}(\d{1,4})?$/;
	if(decimals.test(string)){
		return false;
	}
	return true;
}

