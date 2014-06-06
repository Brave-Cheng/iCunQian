function changeActiveStatus(url, id, obj, type){
    var data =  {
        id: id
    };

    $.get(url, data, function(res) { // ajax return call
        if (res == "") {
            alert("Your request could not be completed. If this problem persists, please contact your System Administrator.");
            return;
        }
        eval("var data=" + res + "");
        obj.className = obj.className.replace(" activate", "");
        obj.className = obj.className.replace(" deactivate", "");
        if (data.active) {
            obj.className += " activate";
        } else {
            obj.className += " deactivate";
        }
    });
    return false;
}

function formSubmit(fid, action, method, submit) {
    if (fid == null || fid == "" || fid == false) { location.href = action; return false;}
    var frm = document.getElementById(fid);
    frm.action = action;
    if (method) { frm.method = method; }
    frm.submit();
    return false;
}

function rm2SetCookie(cookieName, cookieValue, expires, path, domain, secure) {
    document.cookie =
    escape(cookieName) + '=' + escape(cookieValue)
    + (expires ? '; expires=' + expires.toGMTString() : '')
    + (path ? '; path=' + path : '')
    + (domain ? '; domain=' + domain : '')
    + (secure ? '; secure' : '');
};

// Standards way of launching target="_blank"
function externalLinks() { 
    if (!document.getElementsByTagName) return; 
    var anchors = document.getElementsByTagName("a"); 
    for (var i=0; i<anchors.length; i++) { 
         var anchor = anchors[i]; 
         if (anchor.getAttribute("href") && 
                   anchor.getAttribute("rel") == "external") 
              anchor.target = "_blank"; 
    }
} 

// Make pretty radio boxes
function fancyRadio(obj) {
    if (!document.getElementsByTagName) return; 
    var myname = obj.getAttribute("name");
    var oSpans = document.getElementsByTagName("span"); 
    for (var s=0; s<oSpans.length; s++) {
        var oSpan = oSpans[s];
        for(var i = 0; i < oSpan.childNodes.length; i++) {
            if (oSpan.firstChild.nodeType != 1) continue;
            input = oSpan.childNodes[i];
            attr = input.getAttribute("name");
            if (attr.match(myname)) {
                input.parentNode.setAttribute("class","unchecked");
                obj.parentNode.setAttribute("class","checked");
            }
        }
    }
}

var expand;
function folderExpand(node) {
    if(!node.getElementsByTagName('ul')) return;
    var ul = node.getElementsByTagName('ul');
    if(!expand || expand == false ){
        ul[0].style['display'] = 'block';
        node.setAttribute("class","folder_close");
        expand = true;
    } else {
        ul[0].style['display'] = 'none';
        node.setAttribute("class","folder");
        expand = false;
    }
    
}

// Collapser
var newCollapse;
function fullView() {
    var nav     = document.getElementById('navColumn');
    var none     = document.getElementById('dTreeNav');
    var content    = document.getElementById('ttLright');
    var myLeft    = document.getElementById('ttLLeft');
    var max        = document.getElementById('maximizer');
    if(!newCollapse || newCollapse == false) {
        newCollapse = true;
        none.style['display'] = "none";
        myLeft.style['width'] = "20px";
        
        
        max.innerHTML = "<img src='/images/icons/arrow_expand.png' alt='Show Navigation' />";
        max.style['left'] = "0";
//        alert(content.style['margin-left']);
    } else {
        none.style['display'] = "block";
        myLeft.style['width'] = "200px";
        
        
        max.innerHTML = "<img src='/images/icons/arrow_collapse.png' alt='Hide Navigation' />";
        newCollapse = false;
        max.style['left'] = "186px";
    }
}

// ttLright width change to auto
function surveillance() {
    var nav     = document.getElementById('navColumn');
    var content    = document.getElementById("ttLright");
    var heightCG    = document.getElementById('contentControls');
    if(nav==null)
    {
        return;
    }
    if(content==null)
    {
        return;
    }
    if(heightCG==null)
    {
        return;
    }
    
    var h1 = window.screen.availHeight-220;
    var h2 = (h1-500)+"px";
    if (content.clientHeight<h1)
    {
       content.style['height'] = h2;
    }
}
function dormDeleteConfirm(form, url, msg) {

    if (!msg) {
        msg = "Are you sure you want to delete the record?";
    }
    showConfirmDialog(msg, "Message", 
        function() {
            rm2FormSubmit(form, url);
        });
    return false;
}

function showConfirmDialog(msg, title, callHandleYes, callHandleNo) {
    var handleYes = function() {
        this.hide();
        if (callHandleYes) { callHandleYes()  }
    };
    var handleNo = function() {
        this.hide();
        if (callHandleNo) { callHandleNo(); }
    };
    var dialog = new YAHOO.widget.SimpleDialog("simpleConfirmDialog",  
                 { width: "300px", 
                   fixedcenter: true, 
                   visible: false, 
                   draggable: true, 
                   close: true, 
                   modal: true,
                   constraintoviewport: true, 
                   buttons: [ { text:"Yes", handler:handleYes, isDefault:true },
                              { text:"No", handler:handleNo } ] 
                 } );
    dialog.setHeader(title);
    dialog.setBody(msg);
    dialog.render(document.body);
    dialog.show();
    return false;
}

function showDialogYes(msg, title, callHandleYes) {
    var handleYes = function() {
        this.hide();
        if (callHandleYes) { callHandleYes(); }
    };
    
    var dialog = new YAHOO.widget.SimpleDialog("simpleDialogYes",  
                 { width: "300px", 
                   fixedcenter: true, 
                   visible: false,
                   draggable: true, 
                   close: true, 
                   modal: true,
                   constraintoviewport: true, 
                   buttons: [ { text:"Ok", handler:handleYes, isDefault:true } ] 
                 } );
    dialog.setHeader(title);
    dialog.setBody(msg);
    dialog.render(document.body);
    dialog.show();          
}

function rm2FormSelectCheck(style) {
    var checkboxList = $(style);
    if (checkboxList && checkboxList.length < 2) return;
    for(var i = 1; i < checkboxList.length; i++) {
        
        checkboxList[i].checked = checkboxList[0].checked;
    }
}

function rm2FormSubmit(fid, action, method, submit) {
    if (fid == null || fid == "" || fid == false) { location.href = action; return false;}
    var frm = document.getElementById(fid);
    frm.action = action;
    if (method) { frm.method = method; }
    frm.submit();
    return false;
}



function cpLink(cpId,value) {
	ZeroClipboard.setMoviePath("/js/ZeroClipboard/ZeroClipboard.swf");  
    clip = new ZeroClipboard.Client();
    clip.setHandCursor( true );
    clip.setText( value );
    clip.addEventListener('complete', function (client, msg) {
    	alert("已经复制到剪切板:" + msg);
    	$('#'+cpId).text('复制链接');
    	$('#'+cpId).css('backgroundColor','#ccc');
    	//showAlertDialog(msg,'Message');
    });
    clip.glue(cpId);
}


function cpAjax(id, url, cpId){
	$.ajax({
        type:"POST",
        url: url,
        data:"id="+id,
        dataType:"html",
        error:function(){
            alert("当前ajax操作出错！");
        },
        success:function(msg){
        	cpLink(cpId, msg);
        }
    });
}


function showAlertDialog(msg, title) {
    var handleYes = function() {
        this.hide();
    };
    var dialog = new YAHOO.widget.SimpleDialog("simpleConfirmDialog",  
                 { width: "300px", 
                   fixedcenter: true, 
                   visible: false, 
                   draggable: true, 
                   close: true, 
                   modal: true,
                   constraintoviewport: true, 
                   buttons: [ { text:"Yes", handler:handleYes, isDefault:true } ] 
                 } );
    dialog.setHeader(title);
    dialog.setBody(msg);
    dialog.render(document.body);
    dialog.show();
    return false;
}















window.onload = externalLinks;
/*
window.onresize = surveillance;
window.onscroll = surveillance;*/

function setActiveRadio(radio, id, callback, befor) {
var task = function() {
var objs = document.getElementsByName(id);
var actives = document.getElementsByName(id + "Yes");
var deactivates = document.getElementsByName(id + "No");
var obj = objs[objs.length-1];
var active = actives[actives.length-1];
var deactivate = deactivates[deactivates.length-1];
//var obj = document.getElementById(id);
//var active = document.getElementById(id + "Yes");
//var deactivate = document.getElementById(id + "No");
if (obj.value == 1 && radio == deactivate) { // set inactive
obj.value = 0;
active.className = "deactivated";
deactivate.className = "inactive";
}
if (obj.value == 0 && radio == active) {
obj.value = 1;
active.className = "active";
deactivate.className = "deactivated";
}
if (callback) { eval(callback + "(radio);"); }
}
if (befor) { eval("var r = " + befor + "(radio, id, callback);");
if (!r) { return false; }
}
task();
return false;
}