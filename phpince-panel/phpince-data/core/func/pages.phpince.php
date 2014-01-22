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
if($PHPINCE_perms["pages"]){
	switch($_GET["subf"]){
		case "add":
			echo "<div id=\"title\">
			  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1400]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1401]."</span></h1>";
			if(!empty($_POST)){
				if((empty($_POST["title"]))||(empty($_POST["text"]))){
					echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1405]."</div>";
				} else {
					bl_query("INSERT INTO `".$PHPince_logon["prefix"]."phpince_pages`(`created`, `edited`, `autor`, `title`, `content`) VALUES (?, ?, ?, ?, ?)", array(bl_date(), bl_date(), $PHPINCE_user["id"], bl_slay($_POST["title"]), $_POST["text"]), $PHPince_logon["login"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1406} ".$_POST["title"]), $PHPince_logon["login"]);
					bl_redirect("/panel/".$_GET["func"]);
				}
			}
			echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
			if(empty($_POST["title"])){ $_POST["title"] = ""; }
			echo "<h4>".$PHPINCE_LANG[1402]."</h4><input name=\"title\" type=\"text\" value=\"".$_POST["title"]."\">";
			if(empty($_POST["text"])){ $_POST["text"] = ""; }
			echo "<textarea style=\"width:100%;min-height:300px;\" name=\"text\" id=\"editor\">".$_POST["text"]."</textarea>";
			echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
			echo "</form></div>";
			bl_run_editor($PHPINCE_system, $PHPINCE_LANG);
		break;
		case "edit":
			if(is_numeric($_GET["id"])){
				$PHPINCE_NAV_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_pages WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($PHPINCE_NAV_query->rowCount()==1){
					$PHPINCE_NAV_V = $PHPINCE_NAV_query->fetch();
					echo "<div id=\"title\">
					  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1400]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1411].": #".$_GET["id"]."</span></h1>";
					if(!empty($_POST)){
						if((empty($_POST["title"]))||(empty($_POST["text"]))){
							echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1405]."</div>";
						} else {
							bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_pages` SET `edited`= ?,`title`= ?,`content`= ? WHERE id = ?", array(bl_date(), bl_slay($_POST["title"]), $_POST["text"], $_GET["id"]), $PHPince_logon["login"]);
							bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1407} <a target=\"_blank\" href=\"/page/".$PHPINCE_NAV_V["id"]."\">".$_POST["title"]."</a>"), $PHPince_logon["login"]);
							$PHPINCE_NAV_V["title"] = $_POST["title"];
							$PHPINCE_NAV_V["content"] = $_POST["text"];
							echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[1408]."</div>";
						}
					}
					echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
						echo "<h4>".$PHPINCE_LANG[1402]."</h4><input name=\"title\" type=\"text\" value=\"".$PHPINCE_NAV_V["title"]."\">";
						echo "<textarea style=\"width:100%;min-height:300px;\" name=\"text\" id=\"editor\">".htmlspecialchars($PHPINCE_NAV_V["content"])."</textarea>";
						echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
					echo "</form></div>";
					bl_run_editor($PHPINCE_system, $PHPINCE_LANG);
				} else {
					bl_redirect("/panel/".$_GET["func"]);
				}
			} else {
				bl_redirect("/panel/".$_GET["func"]);
			}
		break;
		case "":
			echo "<div id=\"title\">
			  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1400]."&nbsp;&raquo;&nbsp;<a href=\"/panel/pages/add\">".$PHPINCE_LANG[1401]."</a></h1>";
			echo "</div><div id=\"notitle\">";
			echo "<table class=\"styled\">
				  <tr>
					  <th>#</th>
					  <th>".$PHPINCE_LANG[1402]."</th>
					  <th>".$PHPINCE_LANG[1404]."</th>
					  <th>".$PHPINCE_LANG[1403]."</th>
					  <th></th>
				  </tr>";
			$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_pages ORDER BY id DESC", array(), $PHPince_logon["login"]);
			if($PHPINCE_pew->rowCount()==0){
				echo "<tr><td colspan=\"5\">".$PHPINCE_LANG[1410]."</td></tr>";
			} else {
				$PHPINCE_LOG_SYS_account_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc", array(), $PHPince_logon["login"]);
				$PHPINCE_LOG_SYS_account_array = array();
				while ($PHPINCE_LOG_SYS_account_V = $PHPINCE_LOG_SYS_account_query->fetch()) {
					$PHPINCE_LOG_SYS_account_array[$PHPINCE_LOG_SYS_account_V["id"]] = $PHPINCE_LOG_SYS_account_V["account"];
				}
				$i = 1;
				while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
					echo "<tr id=\"".$i."\">
							  <td style=\"width:5%;\">".$PHPINCE_pewf["id"]."</td>
							  <td style=\"width:auto;\"><a target=\"_blank\" href=\"/page/".$PHPINCE_pewf["id"]."\">".$PHPINCE_pewf["title"]."&nbsp;<img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/elink.png\"></a></td>
							  <td style=\"width:auto;\">".$PHPINCE_LOG_SYS_account_array[$PHPINCE_pewf["autor"]]."</td>
							  <td style=\"width:auto;\">".bl_date_get($PHPINCE_pewf["edited"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."</td>
							  <td style=\"width:40px;\">";
					if(($PHPINCE_perms["pagesall"])||($PHPINCE_user["id"]==$PHPINCE_pewf["autor"])){
						echo "<a class=\"action edit\" href=\"/panel/pages/edit?id=".$PHPINCE_pewf["id"]."\"></a>";
						echo "<a onClick=\"return confirm('".$PHPINCE_LANG[30]."')\" id=\"a".$i."\" class=\"action cancel\" href=\"javascript: bl_runaction('".$i."','".$PHPINCE_pewf["id"]."', 'pagedel')\"></a>";
					}
					echo "</td></tr>";
					$i++;
				}
			}
			echo "<tr>
						  <th></th>
						  <th></th>
						  <th></th>
						  <th></th>
						  <th></th>
					  </tr>
				  </table>";
			echo "</div>";
		break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
} else {
	bl_redirect("/panel");
}
?>