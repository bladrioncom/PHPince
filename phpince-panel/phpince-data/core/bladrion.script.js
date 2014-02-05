/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2014 Dominik Hulla
| Web: http://phpince.org
| Author: Dominik Hulla / dh@bladrion.com
| Developer: Bladrion Technologies (http://bladrion.com)
+----------------------------------------------------------------------+
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| 
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
| 
| You should have received a copy of the GNU General Public License
| along with this program.  If not, see <http://www.gnu.org/licenses/>.
+----------------------------------------------------------------------*/
function bl_formSubmit(formid){
document.getElementById(formid).submit();
}
function bl_insert(thisChar, thereId) {
function theCursorPosition(ofThisInput) {
var theCursorLocation = 0;
if (document.selection) {
ofThisInput.focus();
var theSelectionRange = document.selection.createRange();
theSelectionRange.moveStart('character', -ofThisInput.value.length);
theCursorLocation = theSelectionRange.text.length;
} else if (ofThisInput.selectionStart || ofThisInput.selectionStart == '0') {
theCursorLocation = ofThisInput.selectionStart;
}
return theCursorLocation;
}
var theIdElement = document.getElementById(thereId);
var currentPos = theCursorPosition(theIdElement);
var origValue = theIdElement.value;
var newValue = origValue.substr(0, currentPos) + thisChar + origValue.substr(currentPos);
theIdElement.value = newValue;
}
function bl_runaction(del,value, url){
	$('a#a'+del).replaceWith('<img src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;"  id="iframe_load'+ del +'" src="/phpince-panel/phpince-data/core/bladrion.action.php?f='+ url +'&value='+ value +'"></iframe>').appendTo(document.body);
	$('#iframe_load'+del).load(function() {
		$("#iframe_load"+del).remove();
		$("tr#"+del).remove();  
	});
}
$(function() {
$(".sortable").sortable({
items: "li:not(.disabled)"
});
$(".sortable li").disableSelection();
var sortedIDs = $(".sortable").sortable("toArray");
$(".sortable").sortable({
update: function( event, ui ) {
	$.post("/phpince-panel/phpince-data/core/bladrion.action.php?f=nav", { type: "orderPages", pages: $(this).sortable("serialize") } );
}
});
});
function bl_delnavigation(value){
	$('a#a'+value).replaceWith('<img src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;"  id="iframe_load'+ value +'" src="/phpince-panel/phpince-data/core/bladrion.action.php?f=navdel&value='+ value +'"></iframe>').appendTo(document.body);
	$('#iframe_load'+value).load(function() {
		$("#iframe_load"+value).remove();
		$("li#page_"+value).remove();  
	});
}
function bl_delnavigation_nav(value){
	$('a#anav'+value).replaceWith('<img src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;"  id="iframe_load'+ value +'" src="/phpince-panel/phpince-data/core/bladrion.action.php?f=navxdel&value='+ value +'"></iframe>').appendTo(document.body);
	$('#iframe_load'+value).load(function() {
		$("#iframe_load"+value).remove();
		$("ul.nav"+value).remove();  
	});
}
function bl_addnavigation(){
	$('span#loading').replaceWith('<img id="loading" src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;" id="iframe_load_navadd" src="/phpince-panel/phpince-data/core/bladrion.action.php?f=navadd"></iframe>').appendTo(document.body);
	$('#iframe_load_navadd').load(function() {
		location.reload();
	});
}
function bl_runscript(value, url){
	$('a#a'+value).replaceWith('<img id="a'+value+'" src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;"  id="iframe_load'+ value +'" src="/phpince-panel/phpince-script/'+ url +'/script.phpince.php"></iframe>').appendTo(document.body);
	$('#iframe_load'+value).load(function() {
		$("#iframe_load"+value).remove();
		$('img#a'+value).replaceWith('<a id="a'+value+'" href="javascript: bl_runscript('+value+', \''+url+'\');" class="action add"></a>');
	});
}
function bl_systemupdate(){
	$('a#load').replaceWith('<img style="vertical-align:middle;" id="load" src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;" id="iframe_load" src="/phpince-panel/phpince-data/core/bladrion.action.php?f=sysupdate"></iframe>').appendTo(document.body);
	$('#iframe_load').load(function() {
		var iBody = $("#iframe_load").contents().find("body").html();
		if(iBody){
			alert(iBody);
		}
		$("#iframe_load").remove();
		location.reload(); 
	});
}
function bl_appinstaller(del,value, url){
	$('a#a'+del).replaceWith('<img src="/phpince-panel/phpince-data/core/tems/phpince-dashboard/load.gif" />');
	$('<iframe style="display:none;"  id="iframe_load'+ del +'" src="/phpince-panel/phpince-data/core/bladrion.action.php?f='+ url +'&value='+ value +'"></iframe>').appendTo(document.body);
	$('#iframe_load'+del).load(function() {
		$("#iframe_load"+del).remove();
		location.reload();  
	});
}
function bl_show(value){
	$('a#show'+value).replaceWith('<a id="show'+value+'" href="javascript: bl_hide('+value+');"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/cancel.png\"></a>');
	$("div#hide"+ value).show("slow");
}
function bl_hide(value){
	$('a#show'+value).replaceWith('<a id="show'+value+'" href="javascript: bl_show('+value+');"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/info.png\"></a>');
	$("div#hide"+ value).hide(1000);
}
function bl_show_mintextarea(value){
	switch(value){
		case "show":
			$("div#textareamineditor").show("slow");
			$('a#atextareamineditor').replaceWith('<span></span>');
		break;
	}
}