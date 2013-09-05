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
if($PHPINCE_perms["nav"]){
	switch($_GET["subf"]){
		case "add":
			if(is_numeric($_GET["id"])){
				$PHPINCE_NAV_number = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_nav WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"])->rowCount();
				if($PHPINCE_NAV_number==1){
					echo "<form method=\"post\" action=\"\">";
					echo "<div id=\"title\">
						  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/nav_40.png\">&nbsp;".$PHPINCE_LANG[900]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[904]."</span></h1>";
					if(!empty($_POST)){
						if((empty($_POST["link_name"]))||(empty($_POST["link_url"]))){
							echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[908]."</div>";
						} else {
							$PHPINCE_NAV_item_number = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_nav_item WHERE nav = ?", array($_GET["id"]), $PHPince_logon["login"])->rowCount();
							bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_nav_item (name, url, nav, position, set_id, set_class, set_target) VALUES (?, ?, ?, ?, ?, ?, ?)", array(bl_slay($_POST["link_name"]),bl_slay($_POST["link_url"]),$_GET["id"], $PHPINCE_NAV_item_number,bl_slay($_POST["link_id"]),bl_slay($_POST["link_class"]),bl_slay($_POST["link_target"])), $PHPince_logon["login"]);
							bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_915} ".$_POST["link_name"]), $PHPince_logon["login"]);
							bl_redirect("/panel/".$_GET["func"]);
						}
					}
					echo "</div><div id=\"notitle\">";
					if(empty($_POST["link_name"])){ $_POST["link_name"] = ""; }
					echo "<h4>".$PHPINCE_LANG[905]."</h4><input name=\"link_name\" type=\"text\" value=\"".$_POST["link_name"]."\">";
					if(empty($_POST["link_url"])){ $_POST["link_url"] = ""; }
					echo "<h4>".$PHPINCE_LANG[906]."</h4><input name=\"link_url\" type=\"text\" value=\"".$_POST["link_url"]."\">";
					echo "<h4>".$PHPINCE_LANG[907]."</h4><select name=\"link_target\">";
					$PHPINCE_TARGET = array("","_blank");
					$PHPINCE_TARGET_name = array($PHPINCE_LANG[916],$PHPINCE_LANG[917]);
					for ($i = 0; $i < count($PHPINCE_TARGET); $i++) {
						echo "<option value=\"".$PHPINCE_TARGET[$i]."\">".$PHPINCE_TARGET_name[$i]."</option>";
					}
					echo "</select>";
					if(empty($_POST["link_id"])){ $_POST["link_id"] = ""; }
					echo "<h4>#Id</h4><input name=\"link_id\" type=\"text\" value=\"".$_POST["link_id"]."\">";
					if(empty($_POST["link_class"])){ $_POST["link_class"] = ""; }
					echo "<h4>.Class</h4><input name=\"link_class\" type=\"text\" value=\"".$_POST["link_class"]."\">";
					echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
					echo "</div></form>";
				} else {
					bl_redirect("/panel/".$_GET["func"]);
				}
			} else {
				bl_redirect("/panel/".$_GET["func"]);
			}
		break;
		case "edit":
			if(is_numeric($_GET["id"])){
				$PHPINCE_NAV_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_nav_item WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($PHPINCE_NAV_query->rowCount()==1){
					$PHPINCE_NAV_V = $PHPINCE_NAV_query->fetch();
					echo "<form method=\"post\" action=\"\">";
					echo "<div id=\"title\">
						  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/nav_40.png\">&nbsp;".$PHPINCE_LANG[900]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[909]."</span></h1>";
					if(!empty($_POST)){
						if((empty($_POST["link_name"]))||(empty($_POST["link_url"]))){
							echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[908]."</div>";
						} else {
							bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_nav_item SET `name`= ?,`url`= ?,`set_id`= ?,`set_class`= ?,`set_target`= ? WHERE id = ?", array($_POST["link_name"], $_POST["link_url"], $_POST["link_id"], $_POST["link_class"], $_POST["link_target"], $_GET["id"]), $PHPince_logon["login"]);
							bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_914} ".$_GET["id"]), $PHPince_logon["login"]);
							bl_redirect("/panel/".$_GET["func"]);
						}
					}
					echo "</div><div id=\"notitle\">";
					echo "<h4>".$PHPINCE_LANG[905]."</h4><input name=\"link_name\" type=\"text\" value=\"".$PHPINCE_NAV_V["name"]."\">";
					echo "<h4>".$PHPINCE_LANG[906]."</h4><input name=\"link_url\" type=\"text\" value=\"".$PHPINCE_NAV_V["url"]."\">";
					echo "<h4>".$PHPINCE_LANG[907]."</h4><select name=\"link_target\">";
					$PHPINCE_TARGET = array("","_blank");
					$PHPINCE_TARGET_name = array($PHPINCE_LANG[916],$PHPINCE_LANG[917]);
					for ($i = 0; $i < count($PHPINCE_TARGET); $i++) {
						echo "<option value=\"".$PHPINCE_TARGET[$i]."\">".$PHPINCE_TARGET_name[$i]."</option>";
					}
					echo "</select>";
					echo "<h4>#Id</h4><input name=\"link_id\" type=\"text\" value=\"".$PHPINCE_NAV_V["set_id"]."\">";
					echo "<h4>.Class</h4><input name=\"link_class\" type=\"text\" value=\"".$PHPINCE_NAV_V["set_class"]."\">";
					echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
					echo "</div></form>";
				} else {
					bl_redirect("/panel/".$_GET["func"]);
				}
			} else {
				bl_redirect("/panel/".$_GET["func"]);
			}
		break;
		case "":
			echo "<div id=\"title\">
				  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/nav_40.png\">&nbsp;".$PHPINCE_LANG[900]."&nbsp;&raquo;&nbsp;<a href=\"javascript: bl_addnavigation()\">".$PHPINCE_LANG[901]."<span id=\"loading\"></span></a></h1>";
			echo "</div><div id=\"notitle\">";
			$PHPINCE_NAV_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_nav ORDER BY id ASC", array(), $PHPince_logon["login"]);
			while ($PHPINCE_NAV_V = $PHPINCE_NAV_query->fetch()) {
				echo "<ul id=\"sortable\" class=\"sortable nav".$PHPINCE_NAV_V["id"]."\"><li class=\"disabled\">".$PHPINCE_LANG[902]." #".$PHPINCE_NAV_V["id"]."&nbsp;&raquo;&nbsp;<a href=\"/panel/nav/add?id=".$PHPINCE_NAV_V["id"]."\">".$PHPINCE_LANG[903]."</a><div><a id=\"anav".$PHPINCE_NAV_V["id"]."\" class=\"action cancel\" href=\"javascript: bl_delnavigation_nav('".$PHPINCE_NAV_V["id"]."')\"></a></div></li>";
				$PHPINCE_NAVi_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_nav_item WHERE nav = ? ORDER BY position ASC", array($PHPINCE_NAV_V["id"]), $PHPince_logon["login"]);
				while ($PHPINCE_NAVi_V = $PHPINCE_NAVi_query->fetch()) {
					echo "<li id=\"page_".$PHPINCE_NAVi_V["id"]."\"><span></span>".$PHPINCE_NAVi_V["name"]."<div><a href=\"/panel/nav/edit?id=".$PHPINCE_NAVi_V["id"]."\" class=\"action edit\"></a><a id=\"a".$PHPINCE_NAVi_V["id"]."\" class=\"action cancel\" href=\"javascript: bl_delnavigation('".$PHPINCE_NAVi_V["id"]."')\"></a></div></li>";
				}
				echo "<li class=\"disabled\"></li></ul>";
			}
			echo "</div>";
		break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
} else {
	bl_redirect("/panel");
}
?>