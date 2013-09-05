<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2013 Dominik Hulla
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
if($PHPINCE_perms["formating"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/style_40.png\">&nbsp;".$PHPINCE_LANG[1700]."</h1>";
	if(!empty($_POST)){
		$PHPINCE_pew2 = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_style", array(), $PHPince_logon["login"]);
		while($PHPINCE_pewf2 = $PHPINCE_pew2->fetch()){
			bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_style SET styledata = ? WHERE id = ?", array($_POST["format_".$PHPINCE_pewf2["id"]], $PHPINCE_pewf2["id"]), $PHPince_logon["login"]);
		}
		bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1702}"), $PHPince_logon["login"]);
		echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[1701]."</div>";
	}
    echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
	$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_style ORDER by id", array(), $PHPince_logon["login"]);
	while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
		if(empty($PHPINCE_LANG[(3000+$PHPINCE_pewf["id"])])){
			$PHPINCE_formating_name = $PHPINCE_LANG[1700]." #".$PHPINCE_pewf["id"];
		} else {
			$PHPINCE_formating_name = $PHPINCE_LANG[(3000+$PHPINCE_pewf["id"])];
		}
		echo "<h4>".$PHPINCE_formating_name."</h4>";
		echo "<textarea id=\"code".$PHPINCE_pewf["id"]."\" name=\"format_".$PHPINCE_pewf["id"]."\">".$PHPINCE_pewf["styledata"]."</textarea><p>&nbsp;</p>";
		if(($PHPINCE_pewf["id"]==1)||($PHPINCE_pewf["id"]==2)||($PHPINCE_pewf["id"]==5)){
			echo "<div style=\"font-size:12px;margin:-20px 0 15px 0;\">".$PHPINCE_LANG[1703]."</div>";
		}
		echo "<script>
  var editor = CodeMirror.fromTextArea(document.getElementById(\"code".$PHPINCE_pewf["id"]."\"), {
	lineNumbers: true,
	mode: \"text/html\",
	autoCloseTags: true,
	viewportMargin: Infinity,
  });
</script>";
	}
	echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">&nbsp;<input type=\"reset\" value=\"".$PHPINCE_LANG[10]."\">";
	echo "</form></div>";
} else {
	bl_redirect("/panel");
}
?>