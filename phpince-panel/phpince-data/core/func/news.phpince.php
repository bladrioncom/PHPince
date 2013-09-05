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
if($PHPINCE_perms["news"]){
	switch($_GET["subf"]){
		case "add":
			echo "<div id=\"title\">
			  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1500]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1501]."</span></h1>";
			if(!empty($_POST)){
				if((empty($_POST["title"]))||(empty($_POST["text"]))){
					echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1505]."</div>";
				} else {
					bl_query("INSERT INTO `".$PHPince_logon["prefix"]."phpince_news`(`created`, `edited`, `autor`, `title`, `content`, `ncat`) VALUES (?, ?, ?, ?, ?, ?)", array(bl_date(), bl_date(), $PHPINCE_user["id"], bl_slay($_POST["title"]), $_POST["text"], bl_slay($_POST["cat"])), $PHPince_logon["login"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1506} ".$_POST["title"]), $PHPince_logon["login"]);
					bl_redirect("/panel/".$_GET["func"]);
				}
			}
			echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
			if(empty($_POST["title"])){ $_POST["title"] = ""; }
			echo "<h4>".$PHPINCE_LANG[1502]."</h4><input name=\"title\" type=\"text\" value=\"".$_POST["title"]."\">";
			echo "<h4>".$PHPINCE_LANG[1512]."</h4><select name=\"cat\">";
			echo "<option value=\"0\" selected>".$PHPINCE_LANG[1511]."</option>";
			$PHPINCE_cat = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat ORDER BY id", array(), $PHPince_logon["login"]);
			while($PHPINCE_catf = $PHPINCE_cat->fetch()){
				echo "<option value=\"".$PHPINCE_catf["id"]."\">".$PHPINCE_catf["cat"]."</option>";
			}
			echo "</select>";
			if(empty($_POST["text"])){ $_POST["text"] = ""; }
			echo "<textarea style=\"width:100%;min-height:300px;\" name=\"text\" id=\"editor\">".$_POST["text"]."</textarea>";
			echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
			echo "</form></div>";
			bl_run_editor($PHPINCE_system, $PHPINCE_LANG);
		break;
		case "cadd":
			if($PHPINCE_perms["newscat"]){
				echo "<div id=\"title\">
				  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1513]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1514]."</span></h1>";
				if(!empty($_POST)){
					if(empty($_POST["name"])){
						echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1517]."</div>";
					} else {
						bl_query("INSERT INTO `".$PHPince_logon["prefix"]."phpince_ncat`(`cat`) VALUES (?)", array(bl_slay($_POST["name"])), $PHPince_logon["login"]);
						bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1521} ".$_POST["name"]), $PHPince_logon["login"]);
						bl_redirect("/panel/".$_GET["func"]);
					}
				}
				echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
					echo "<h4>".$PHPINCE_LANG[1515]."</h4><input name=\"name\" type=\"text\" value=\"\">";
					echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
				echo "</form></div>";
			} else {
				bl_redirect("/panel/".$_GET["func"]);
			}
		break;
		case "edit":
			if(is_numeric($_GET["id"])){
				$PHPINCE_NAV_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($PHPINCE_NAV_query->rowCount()==1){
					$PHPINCE_NAV_V = $PHPINCE_NAV_query->fetch();
					echo "<div id=\"title\">
					  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1500]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1501]."</span></h1>";
					if(!empty($_POST)){
						if((empty($_POST["title"]))||(empty($_POST["text"]))){
							echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1505]."</div>";
						} else {
							bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_news` SET `edited`= ?,`title`= ?,`content`= ?,`ncat`= ? WHERE id = ?", array(bl_date(), bl_slay($_POST["title"]), $_POST["text"], bl_slay($_POST["cat"]), $_GET["id"]), $PHPince_logon["login"]);
							bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1507} <a target=\"_blank\" href=\"/topic/".$PHPINCE_NAV_V["id"]."\">".$_POST["title"]."</a>"), $PHPince_logon["login"]);
							$PHPINCE_NAV_V["title"] = $_POST["title"];
							$PHPINCE_NAV_V["content"] = $_POST["text"];
							echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[1508]."</div>";
						}
					}
					echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
						echo "<h4>".$PHPINCE_LANG[1502]."</h4><input name=\"title\" type=\"text\" value=\"".$PHPINCE_NAV_V["title"]."\">";
						echo "<h4>".$PHPINCE_LANG[1512]."</h4><select name=\"cat\">";
						if($PHPINCE_NAV_V["ncat"]==0){
							echo "<option value=\"0\" selected>".$PHPINCE_LANG[1511]."</option>";
						} else {
							echo "<option value=\"0\">".$PHPINCE_LANG[1511]."</option>";
						}
						$PHPINCE_cat = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat ORDER BY id", array(), $PHPince_logon["login"]);
						while($PHPINCE_catf = $PHPINCE_cat->fetch()){
							if($PHPINCE_catf["id"]==$PHPINCE_NAV_V["ncat"]){
								echo "<option value=\"".$PHPINCE_catf["id"]."\" selected>".$PHPINCE_catf["cat"]."</option>";
							} else {
								echo "<option value=\"".$PHPINCE_catf["id"]."\">".$PHPINCE_catf["cat"]."</option>";
							}
						}
						echo "</select>";
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
		case "cedit":
			if($PHPINCE_perms["newscat"]){
				if(is_numeric($_GET["id"])){
					$PHPINCE_NAV_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
					if($PHPINCE_NAV_query->rowCount()==1){
						$PHPINCE_NAV_V = $PHPINCE_NAV_query->fetch();
						echo "<div id=\"title\">
						  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1500]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1518].": #".$_GET["id"]."</span></h1>";
						if(!empty($_POST)){
							if(empty($_POST["name"])){
								echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1517]."</div>";
							} else {
								bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_ncat` SET `cat`= ? WHERE id = ?", array(bl_slay($_POST["name"]), $_GET["id"]), $PHPince_logon["login"]);
								bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1520} <a target=\"_blank\" href=\"/cat/".$PHPINCE_NAV_V["id"]."\">".$_POST["name"]."</a>"), $PHPince_logon["login"]);
								$PHPINCE_NAV_V["cat"] = $_POST["name"];
								echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[1519]."</div>";
							}
						}
						echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
							echo "<h4>".$PHPINCE_LANG[1515]."</h4><input name=\"name\" type=\"text\" value=\"".$PHPINCE_NAV_V["cat"]."\">";
							echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
						echo "</form></div>";
					} else {
						bl_redirect("/panel/".$_GET["func"]);
					}
				} else {
					bl_redirect("/panel/".$_GET["func"]);
				}
			} else {
				bl_redirect("/panel/".$_GET["func"]);
			}
		break;
		case "":
			echo "<div id=\"title\">
			  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1500]."&nbsp;&raquo;&nbsp;<a href=\"/panel/news/add\">".$PHPINCE_LANG[1501]."</a></h1>";
			echo "</div><div id=\"notitle\">";
			echo "<table class=\"styled\">
				  <tr>
					  <th>#</th>
					  <th>".$PHPINCE_LANG[1502]."</th>
					  <th>".$PHPINCE_LANG[1504]."</th>
					  <th>".$PHPINCE_LANG[1503]."</th>
					  <th></th>
				  </tr>";
			$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news ORDER BY id DESC", array(), $PHPince_logon["login"]);
			if($PHPINCE_pew->rowCount()==0){
				echo "<tr><td colspan=\"5\">".$PHPINCE_LANG[1510]."</td></tr>";
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
							  <td style=\"width:auto;\"><a target=\"_blank\" href=\"/topic/".$PHPINCE_pewf["id"]."\">".$PHPINCE_pewf["title"]."&nbsp;<img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/elink.png\"></a></td>
							  <td style=\"width:auto;\">".$PHPINCE_LOG_SYS_account_array[$PHPINCE_pewf["autor"]]."</td>
							  <td style=\"width:auto;\">".bl_date_get($PHPINCE_pewf["edited"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."</td>
							  <td style=\"width:40px;\">";
					if(($PHPINCE_perms["newsall"])||($PHPINCE_user["id"]==$PHPINCE_pewf["autor"])){
						echo "<a class=\"action edit\" href=\"/panel/news/edit?id=".$PHPINCE_pewf["id"]."\"></a>";
						echo "<a id=\"a".$i."\" class=\"action cancel\" href=\"javascript: bl_runaction('".$i."','".$PHPINCE_pewf["id"]."', 'newsdel')\"></a>";
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
			echo "<p>&nbsp;</p><h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page_40.png\">&nbsp;".$PHPINCE_LANG[1513];
			if($PHPINCE_perms["newscat"]){
				echo "&nbsp;&raquo;&nbsp;<a href=\"/panel/news/cadd\">".$PHPINCE_LANG[1514]."</a>";
			}
			echo "</h1>";
			echo "<table class=\"styled\">
				  <tr>
					  <th>#</th>
					  <th>".$PHPINCE_LANG[1515]."</th>
					  <th></th>
				  </tr>";
			$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat ORDER BY id DESC", array(), $PHPince_logon["login"]);
			if($PHPINCE_pew->rowCount()==0){
				echo "<tr><td colspan=\"5\">".$PHPINCE_LANG[1522]."</td></tr>";
			} else {
				$i = 1;
				while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
					echo "<tr id=\"c".$i."\">
							  <td style=\"width:5%;\">".$PHPINCE_pewf["id"]."</td>
							  <td style=\"width:auto;\"><a target=\"_blank\" href=\"/cat/".$PHPINCE_pewf["id"]."\">".$PHPINCE_pewf["cat"]."&nbsp;<img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/elink.png\"></a></td>
							  <td style=\"width:40px;\">";
					if($PHPINCE_perms["newscat"]){
						echo "<a class=\"action edit\" href=\"/panel/news/cedit?id=".$PHPINCE_pewf["id"]."\"></a>";
						echo "<a id=\"ac".$i."\" class=\"action cancel\" href=\"javascript: bl_runaction('c".$i."','".$PHPINCE_pewf["id"]."', 'cnewsdel')\"></a>";
					}
					echo "</td></tr>";
					$i++;
				}
			}
			echo "<tr>
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