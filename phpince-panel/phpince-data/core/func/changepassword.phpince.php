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
if($PHPince_logon["active"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<form method=\"post\" action=\"\">";
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban_40.png\">&nbsp;".$PHPINCE_LANG[600]."</h1>";
	if(!empty($_POST)){
		if((empty($_POST["old_password"]))||
		(empty($_POST["new_password"]))||
		(empty($_POST["new2_password"]))){
			echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[605]."</div>";
		} else {
			if((!preg_match("/[^a-zA-Z0-9]/", $_POST["new_password"]))&&(!preg_match("/[^a-zA-Z0-9]/", $_POST["new2_password"]))){
				if($_POST["new_password"]==$_POST["new2_password"]){
					if($PHPINCE_user["password"]==bl_hash($_POST["old_password"])){
						bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_acc SET password = ? WHERE id = ?", array(bl_hash($_POST["new_password"]), $PHPINCE_user["id"]), $PHPince_logon["login"]);
						echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[608]."</div>";
					} else {
						echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[607]."</div>";
					}
				} else {
					echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[606]."</div>";
				}
			} else {
				echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[603]."</div>";
			}
		}
	}
	echo "</div><div id=\"notitle\">";
	echo "<h4>".$PHPINCE_LANG[601]."</h4><input name=\"old_password\" type=\"password\" value=\"\" autocomplete=\"off\">";
	echo "<h4>".$PHPINCE_LANG[602]." | <span>".$PHPINCE_LANG[603]."</span></h4><input name=\"new_password\" type=\"password\" value=\"\" autocomplete=\"off\">";
	echo "<h4>".$PHPINCE_LANG[604]."</h4><input name=\"new2_password\" type=\"password\" value=\"\" autocomplete=\"off\">";
	echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">&nbsp;<input type=\"reset\" value=\"".$PHPINCE_LANG[10]."\">";
	echo "</div>";
	echo "</form><p>&nbsp;</p>";
}
?>