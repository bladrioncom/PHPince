<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2014 Dominik Hulla
| Web: http://phpince.com
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
if($PHPINCE_perms["systeminfo"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<form method=\"post\" action=\"\">";
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/sett_40.png\">&nbsp;".$PHPINCE_LANG[500]."</h1>";
	if(!empty($_POST)){
		if((empty($_POST["site_name"]))||
		(empty($_POST["site_desc"]))||
		(empty($_POST["site_key"]))){
			echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[518]."</div>";
		} else {
			if($PHPINCE_system["style"]!=$_POST["set_style"]){
				if(file_exists("phpince-panel/phpince-style/".$_POST["set_style"]."/style.phpince.php")){
					require "phpince-panel/phpince-style/".$_POST["set_style"]."/style.phpince.php";
					if(!empty($PHPINCE_STYLE["topic_style"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["topic_style"], 1), $PHPince_logon["login"]);
					}
					if(!empty($PHPINCE_STYLE["topic_style_active"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["topic_style_active"], 2), $PHPince_logon["login"]);
					}
					if(!empty($PHPINCE_STYLE["topic_notfound"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["topic_notfound"], 3), $PHPince_logon["login"]);
					}
					if(!empty($PHPINCE_STYLE["topic_error"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["topic_error"], 4), $PHPince_logon["login"]);
					}
					if(!empty($PHPINCE_STYLE["page_style"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["page_style"], 5), $PHPince_logon["login"]);
					}
					if(!empty($PHPINCE_STYLE["page_notfound"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["page_notfound"], 6), $PHPince_logon["login"]);
					}
					if(!empty($PHPINCE_STYLE["plugin_notfound"])){
						bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_style` SET `styledata`= ? WHERE id = ?", array($PHPINCE_STYLE["plugin_notfound"], 7), $PHPince_logon["login"]);
					}
				}
			}
			bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_system SET site_name = ?, site_desc = ?, site_key = ?, site_charset = ?, site_html = ?, set_style = ?, set_lp = ?, set_bot = ?, set_editor = ?, set_time = ?, set_reg = ?, set_version = ?, set_inteldoc = ?, set_stopspam = ?, set_ban = ?, set_ban_time = ?, set_construction = ?, set_dnscloudflare = ?, login_redirect = ? WHERE data = ?", array($_POST["site_name"],$_POST["site_desc"], $_POST["site_key"], $_POST["site_charset"], $_POST["site_html"], $_POST["set_style"], $_POST["set_lp"], $_POST["set_bot"], $_POST["set_editor"], $_POST["set_time"], $_POST["set_reg"], $_POST["set_version"], $_POST["set_inteldoc"], $_POST["set_stopspam"], $_POST["set_ban"], $_POST["set_ban_time"], $_POST["set_construction"], $_POST["set_dnscloudflare"], $_POST["login_redirect"], 1), $PHPince_logon["login"]);
			bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_521}"), $PHPince_logon["login"]);
			echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[520]."</div>";
		}
	}
    echo "</div><div id=\"notitle\">";
	if(!empty($_POST["set_lp"])){ $PHPINCE_system["language"] = $_POST["set_lp"]; }
	echo "<h4>".$PHPINCE_LANG[501]."</h4><select name=\"set_lp\">";
	for ($i = 0; $i < count($PHPINCE_LANGS); $i++) {
		if($PHPINCE_system["language"]==$PHPINCE_LANGS[$i]){
			echo "<option value=\"".$PHPINCE_LANGS[$i]."\" selected>".$PHPINCE_LANGS[$i]."</option>";
		} else {
			echo "<option value=\"".$PHPINCE_LANGS[$i]."\">".$PHPINCE_LANGS[$i]."</option>";
		}
	}
	echo "</select>";
	if(!empty($_POST["site_charset"])){ $PHPINCE_system["charset"] = $_POST["site_charset"]; }
	echo "<h4>".$PHPINCE_LANG[502]."</h4><select name=\"site_charset\">";
	$PHPINCE_getcharset_array = array_keys(bl_charset(false, true));
	for ($PHPINCE_getcharset_i = 0; $PHPINCE_getcharset_i < count($PHPINCE_getcharset_array); $PHPINCE_getcharset_i++) {
		if($PHPINCE_system["charset"]==bl_charset($PHPINCE_getcharset_array[$PHPINCE_getcharset_i])){
			echo "<option value=\"".$PHPINCE_getcharset_array[$PHPINCE_getcharset_i]."\" selected>".$PHPINCE_getcharset_array[$PHPINCE_getcharset_i]."</option>";
		} else {
			echo "<option value=\"".$PHPINCE_getcharset_array[$PHPINCE_getcharset_i]."\">".$PHPINCE_getcharset_array[$PHPINCE_getcharset_i]."</option>";
		}
	}
	echo "</select>";
	if(!empty($_POST["set_editor"])){ $PHPINCE_system["editor"] = $_POST["set_editor"]; }
	echo "<h4>".$PHPINCE_LANG[505]."</h4><select name=\"set_editor\">";
	$PHPINCE_getwysiwyg_array = array_keys($PHPINCE_system["system"]["EDITOR"]);
	for ($PHPINCE_getwysiwyg_i = 0; $PHPINCE_getwysiwyg_i < count($PHPINCE_getwysiwyg_array); $PHPINCE_getwysiwyg_i++) {
		if($PHPINCE_system["editor"]==$PHPINCE_getwysiwyg_array[$PHPINCE_getwysiwyg_i]){
			echo "<option value=\"".$PHPINCE_getwysiwyg_array[$PHPINCE_getwysiwyg_i]."\" selected>".$PHPINCE_system["system"]["EDITOR"][$PHPINCE_getwysiwyg_array[$PHPINCE_getwysiwyg_i]]."</option>";
		} else {
			echo "<option value=\"".$PHPINCE_getwysiwyg_array[$PHPINCE_getwysiwyg_i]."\">".$PHPINCE_system["system"]["EDITOR"][$PHPINCE_getwysiwyg_array[$PHPINCE_getwysiwyg_i]]."</option>";
		}
	}
	echo "</select>";
	if(!empty($_POST["set_style"])){ $PHPINCE_system["style"] = $_POST["set_style"]; }
	echo "<h4>".$PHPINCE_LANG[504]."</h4><select name=\"set_style\">";
	$PHPINCE_TEMPLATE = bl_get_templates();
	for ($i = 0; $i < count($PHPINCE_TEMPLATE); $i++) {
		if($PHPINCE_system["style"]==$PHPINCE_TEMPLATE[$i]){
			echo "<option value=\"".$PHPINCE_TEMPLATE[$i]."\" selected>".$PHPINCE_TEMPLATE[$i]."</option>";
		} else {
			echo "<option value=\"".$PHPINCE_TEMPLATE[$i]."\">".$PHPINCE_TEMPLATE[$i]."</option>";
		}
	}
	echo "</select>";
	if(!empty($_POST["site_html"])){ $PHPINCE_system["html"] = $_POST["site_html"]; }
	echo "<h4>".$PHPINCE_LANG[503]."</h4><select name=\"site_html\">";
	$PHPINCE_HTML = array("HTML 5", "HTML 4");
	for ($i = 0; $i < count($PHPINCE_HTML); $i++) {
		if($PHPINCE_system["html"]==$PHPINCE_HTML[$i]){
			echo "<option value=\"".$PHPINCE_HTML[$i]."\" selected>".$PHPINCE_HTML[$i]."</option>";
		} else {
			echo "<option value=\"".$PHPINCE_HTML[$i]."\">".$PHPINCE_HTML[$i]."</option>";
		}
	}
	echo "</select>";
	if(!empty($_POST["login_redirect"])){ $PHPINCE_system["login_redirect"] = $_POST["login_redirect"]; }
	echo "<h4>".$PHPINCE_LANG[529]." | <span>".$PHPINCE_LANG[530]."</span></h4><input name=\"login_redirect\" type=\"text\" value=\"".$PHPINCE_system["login_redirect"]."\">";
	if(!empty($_POST["set_time"])){ $PHPINCE_system["timeformat"] = $_POST["set_time"]; }
	echo "<h4>".$PHPINCE_LANG[506]."</h4><select name=\"set_time\">";
	$PHPINCE_TIME = array("12", "24");
	for ($i = 0; $i < count($PHPINCE_TIME); $i++) {
		if($PHPINCE_system["timeformat"]==$PHPINCE_TIME[$i]){
			echo "<option value=\"".$PHPINCE_TIME[$i]."\" selected>".$PHPINCE_TIME[$i]." ".$PHPINCE_LANG[507]."</option>";
		} else {
			echo "<option value=\"".$PHPINCE_TIME[$i]."\">".$PHPINCE_TIME[$i]." ".$PHPINCE_LANG[507]."</option>";
		}
	}
	echo "</select>";
	if(!empty($_POST["set_construction"])){ $PHPINCE_system["construction"] = $_POST["set_construction"]; }
	echo "<h4>".$PHPINCE_LANG[527]."</h4><select name=\"set_construction\">";
	$PHPINCE_CONS = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_CONS); $i++) {
		if($PHPINCE_system["construction"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_CONS[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_CONS[$i]."</option>";
		}
	}
	echo "</select>";
	echo "<div>";
	if(!empty($_POST["set_reg"])){ $PHPINCE_system["reg"] = $_POST["set_reg"]; }
	echo "<div style=\"float:left; width:48%\"><h4>".$PHPINCE_LANG[508]."</h4><select name=\"set_reg\">";
	$PHPINCE_REG = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_REG); $i++) {
		if($PHPINCE_system["reg"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_REG[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_REG[$i]."</option>";
		}
	}
	echo "</select></div>";
	if(!empty($_POST["set_inteldoc"])){ $PHPINCE_system["inteldoc"] = $_POST["set_inteldoc"]; }
	echo "<div style=\"float:left; margin-left:4%; width:48%\"><h4>".$PHPINCE_LANG[510]."</h4><select name=\"set_inteldoc\">";
	$PHPINCE_INTELDOC = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_INTELDOC); $i++) {
		if($PHPINCE_system["inteldoc"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_INTELDOC[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_INTELDOC[$i]."</option>";
		}
	}
	echo "</select></div>";
	echo "</div>";
	echo "</div>&nbsp;";
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban_40.png\">&nbsp;".$PHPINCE_LANG[522]."</h1>
          </div><div id=\"notitle\">";
	echo "<div>";
	if(!empty($_POST["set_version"])){ $PHPINCE_system["version_checker"] = $_POST["set_version"]; }
	echo "<div style=\"float:left; width:48%\"><h4>".$PHPINCE_LANG[509]."</h4><select name=\"set_version\">";
	$PHPINCE_VER = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_VER); $i++) {
		if($PHPINCE_system["version_checker"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_VER[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_VER[$i]."</option>";
		}
	}
	echo "</select></div>";
	if(!empty($_POST["set_stopspam"])){ $PHPINCE_system["stopspam"] = $_POST["set_stopspam"]; }
	echo "<div style=\"float:left; margin-left:4%; width:48%\"><h4>".$PHPINCE_LANG[511]."</h4><select name=\"set_stopspam\">";
	$PHPINCE_STOPSPAM = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_STOPSPAM); $i++) {
		if($PHPINCE_system["stopspam"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_STOPSPAM[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_STOPSPAM[$i]."</option>";
		}
	}
	echo "</select></div>";
	if(!empty($_POST["set_ban"])){ $PHPINCE_system["ban"]["count"] = $_POST["set_ban"]; }
	echo "<div style=\"float:left; width:48%\"><h4>".$PHPINCE_LANG[523]."</h4><select name=\"set_ban\">";
	for ($i = 1; $i <= 15; $i++) {
		$i2 = $i*2;
		if($PHPINCE_system["ban"]["count"]==$i2){
			echo "<option value=\"".$i2."\" selected>".$i2.". ".$PHPINCE_LANG[525]."</option>";
		} else {
			echo "<option value=\"".$i2."\">".$i2.". ".$PHPINCE_LANG[525]."</option>";
		}
	}
	echo "</select></div>";
	if(!empty($_POST["set_ban_time"])){ $PHPINCE_system["ban"]["time"] = $_POST["set_ban_time"]; }
	echo "<div style=\"float:left; margin-left:4%; width:48%\"><h4>".$PHPINCE_LANG[524]."</h4><select name=\"set_ban_time\">";
	for ($i = 3; $i <= 15; $i++) {
		$i2 = $i*2;
		if($PHPINCE_system["ban"]["time"]==$i2){
			echo "<option value=\"".$i2."\" selected>".$i2." ".$PHPINCE_LANG[526]."</option>";
		} else {
			echo "<option value=\"".$i2."\">".$i2." ".$PHPINCE_LANG[526]."</option>";
		}
	}
	echo "</select></div>";
	if(!empty($_POST["set_dnscloudflare"])){ $PHPINCE_system["cloudflare_malware"] = $_POST["set_dnscloudflare"]; }
	echo "<h4>".$PHPINCE_LANG[528]."</h4><select name=\"set_dnscloudflare\">";
	$PHPINCE_cloudflare_malware = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_cloudflare_malware); $i++) {
		if($PHPINCE_system["cloudflare_malware"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_cloudflare_malware[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_cloudflare_malware[$i]."</option>";
		}
	}
	echo "</select>";
	echo "</div>";
	echo "</div><p>&nbsp;</p>";
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/sett_40.png\">&nbsp;".$PHPINCE_LANG[512]."</h1>
          </div><div id=\"notitle\">";
	if(!empty($_POST["site_name"])){ $PHPINCE_system["title"] = $_POST["site_name"]; }
	echo "<h4>".$PHPINCE_LANG[513]."</h4><input name=\"site_name\" type=\"text\" value=\"".$PHPINCE_system["title"]."\">";
	if(!empty($_POST["site_desc"])){ $PHPINCE_system["desc"] = $_POST["site_desc"]; }
	echo "<h4>".$PHPINCE_LANG[514]."</h4><input name=\"site_desc\" type=\"text\" value=\"".$PHPINCE_system["desc"]."\">";
	if(!empty($_POST["site_key"])){ $PHPINCE_system["key"] = $_POST["site_key"]; }
	echo "<h4>".$PHPINCE_LANG[515]." | <span>".$PHPINCE_LANG[516]."</span></h4><input name=\"site_key\" type=\"text\" value=\"".$PHPINCE_system["key"]."\">";
	if(!empty($_POST["set_bot"])){ $PHPINCE_system["bot"] = $_POST["set_bot"]; }
	echo "<h4>".$PHPINCE_LANG[517]."</h4><select name=\"set_bot\">";
	$PHPINCE_INDEXING = array(0=>$PHPINCE_LANG[12], 1=>$PHPINCE_LANG[11]);
	for ($i = 0; $i < count($PHPINCE_INDEXING); $i++) {
		if($PHPINCE_system["bot"]==$i){
			echo "<option value=\"".$i."\" selected>".$PHPINCE_INDEXING[$i]."</option>";
		} else {
			echo "<option value=\"".$i."\">".$PHPINCE_INDEXING[$i]."</option>";
		}
	}
	echo "</select>";
	echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">&nbsp;<input type=\"reset\" value=\"".$PHPINCE_LANG[10]."\">";
	echo "</div>";
	echo "</form><p>&nbsp;</p>";
} else {
	bl_redirect("/panel");
}
?>