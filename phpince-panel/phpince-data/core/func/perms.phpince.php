<?php
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
if($PHPINCE_perms["perms"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban_40.png\">&nbsp;".$PHPINCE_LANG[1100]."</h1>";
	if(!empty($_POST)){
		$PHPINCE_pew2 = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_perms", array(), $PHPince_logon["login"]);
		while($PHPINCE_pewf2 = $PHPINCE_pew2->fetch()){
			bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_perms SET userlevel = ? WHERE id = ?", array($_POST["perms_".$PHPINCE_pewf2["id"]], $PHPINCE_pewf2["id"]), $PHPince_logon["login"]);
		}
		bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1101}"), $PHPince_logon["login"]);
		echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[1103]."</div>";
	}
    echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
	$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_perms", array(), $PHPince_logon["login"]);
	while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
		echo "<h4>".$PHPINCE_LANG[(2000+$PHPINCE_pewf["id"])]."</h4><select name=\"perms_".$PHPINCE_pewf["id"]."\">";
		for ($i = 0; $i <= 10; $i++) {
			if($PHPINCE_pewf["userlevel"]==$i){
				echo "<option value=\"".$i."\" selected>".$PHPINCE_LANG[(400+$i)]." ".$PHPINCE_LANG[1102]."</option>";
			} else {
				echo "<option value=\"".$i."\">".$PHPINCE_LANG[(400+$i)]." ".$PHPINCE_LANG[1102]."</option>";
			}
		}
		echo "</select>";
	}
	echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">&nbsp;<input type=\"reset\" value=\"".$PHPINCE_LANG[10]."\">";
	echo "</form></div>";
} else {
	bl_redirect("/panel");
}
?>