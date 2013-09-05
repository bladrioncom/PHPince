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
if($PHPince_logon["active"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<form method=\"post\" action=\"\">";
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/usero_40.png\">&nbsp;".$PHPINCE_LANG[700]."</h1>";
	if(!empty($_POST)){
		if (empty($_POST["email"])||(!preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $_POST["email"]))) {
			echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[705]."</div>";
		} else {
			bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_acc SET email = ? WHERE id = ?", array($_POST["email"], $PHPINCE_user["id"]), $PHPince_logon["login"]);
			echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[706]."</div>";
		}
	}
	if(empty($_POST["email"])){
		$_POST["email"] = $PHPINCE_user["email"];
	}
    echo "</div><div id=\"notitle\">";
	echo "<h4>".$PHPINCE_LANG[701]."</h4><input name=\"email\" type=\"text\" value=\"".$_POST["email"]."\" autocomplete=\"off\">";
	echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[704]."\">&nbsp;<input type=\"reset\" value=\"".$PHPINCE_LANG[10]."\">";
	echo "<p>&nbsp;</p><h4>".$PHPINCE_LANG[702]."</h4><input type=\"text\" value=\"".bl_date_get($PHPINCE_user["regdate"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."\" readonly>";
	echo "<h4>".$PHPINCE_LANG[703]."</h4><input type=\"text\" value=\"".bl_getrankname($PHPINCE_user["userlevel"],$PHPINCE_LANG)."\" readonly>";
	echo "</div>";
	echo "</form><p>&nbsp;</p>";
}
?>