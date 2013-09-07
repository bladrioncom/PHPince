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
if($PHPINCE_perms["users"]){
	switch($_GET["subf"]){
		case "edit":
			if(is_numeric($_GET["id"])){
				$PHPINCE_NAV_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($PHPINCE_NAV_query->rowCount()==1){
					$PHPINCE_NAV_V = $PHPINCE_NAV_query->fetch();
					echo "<form method=\"post\" action=\"\">";
					echo "<div id=\"title\">
						  <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/user_40.png\">&nbsp;".$PHPINCE_LANG[1300]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_NAV_V["account"]."</span></h1>";
					if(!empty($_POST)){
						if(empty($_POST["mail"])){
							echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[705]."</div>";
						} else {
							if(!preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $_POST["mail"])) {
								echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1306]."</div>";
							} else {
								if(!empty($_POST["pass"])){
									if(!preg_match("/[^a-zA-Z0-9]/", $_POST["pass"])){
										bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_acc SET `password`= ?, `email`= ?,`userlevel`= ? WHERE id = ?", array(bl_hash($_POST["pass"]), $_POST["mail"], $_POST["level"], $_GET["id"]), $PHPince_logon["login"]);
										bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1308}: ".$PHPINCE_NAV_V["account"]), $PHPince_logon["login"]);
										bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1307}: ".$PHPINCE_NAV_V["account"]), $PHPince_logon["login"]);
										bl_redirect("/panel/".$_GET["func"]);
									} else {
										echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[603]."</div>";
									}
								} else {
									bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_acc SET `email`= ?,`userlevel`= ? WHERE id = ?", array($_POST["mail"], $_POST["level"], $_GET["id"]), $PHPince_logon["login"]);
									bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1307}: ".$PHPINCE_NAV_V["account"]), $PHPince_logon["login"]);
								bl_redirect("/panel/".$_GET["func"]);
								}
							}
						}
					}
					echo "</div><div id=\"notitle\">";
					echo "<h4>".$PHPINCE_LANG[701]."</h4><input name=\"mail\" type=\"text\" value=\"".$PHPINCE_NAV_V["email"]."\">";
					echo "<h4>".$PHPINCE_LANG[602]." | <span>".$PHPINCE_LANG[603]."</span></h4><input name=\"pass\" type=\"password\" autocomplete=\"off\">";
					echo "<h4>".$PHPINCE_LANG[703]."</h4><select name=\"level\">";
					for ($i = 1; $i <= 10; $i++) {
						if($PHPINCE_NAV_V["userlevel"]==$i){
							echo "<option value=\"".$i."\" selected>".bl_getrankname($i,$PHPINCE_LANG)."</option>";
						} else {
							echo "<option value=\"".$i."\">".bl_getrankname($i,$PHPINCE_LANG)."</option>";
						}
					}
					echo "</select>";
					echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
					echo "<p>&nbsp;</p><h4>".$PHPINCE_LANG[702]."</h4><input type=\"text\" value=\"".bl_date_get($PHPINCE_NAV_V["regdate"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."\" readonly>";
					echo "<h4>".$PHPINCE_LANG[1302]."</h4><input type=\"text\" value=\"".bl_date_get($PHPINCE_NAV_V["lastlogin"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."\" readonly>";
					echo "<h4>".$PHPINCE_LANG[1305]."</h4><input type=\"text\" value=\"".$PHPINCE_NAV_V["lastip"]."\" readonly>";
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
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/user_40.png\">&nbsp;".$PHPINCE_LANG[1300]."</h1>";
    echo "</div><div id=\"notitle\">";
	echo "<table class=\"styled\">
			  <tr>
				  <th>#</th>
				  <th>".$PHPINCE_LANG[1301]."</th>
				  <th>".$PHPINCE_LANG[1304]."</th>
				  <th>".$PHPINCE_LANG[1302]."</th>
				  <th>".$PHPINCE_LANG[1303]."</th>
				  <th></th>
			  </tr>";
	$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc ORDER BY id ASC", array(), $PHPince_logon["login"]);
	$i = 1;
	while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
		echo "<tr id=\"".$i."\">
				  <td>".$PHPINCE_pewf["id"]."</td>
				  <td style=\"width:auto;\">".$PHPINCE_pewf["account"]."</td>
				  <td style=\"width:auto;\">".bl_date_get($PHPINCE_pewf["regdate"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."</td>
				  <td style=\"width:auto;\">".bl_date_get($PHPINCE_pewf["lastlogin"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."</td>
				  <td style=\"width:auto;\">".$PHPINCE_LANG[400+$PHPINCE_pewf["userlevel"]]."</td>
				  <td style=\"width:40px;\">";
		if(($PHPINCE_pewf["userlevel"]<=$PHPINCE_user["userlevel"])&&(!($PHPINCE_pewf["id"]==$PHPINCE_user["id"]))){
			echo "<a class=\"action edit\" href=\"/panel/users/edit?id=".$PHPINCE_pewf["id"]."\"></a>";
			echo "<a onClick=\"return confirm('".$PHPINCE_LANG[30]."')\" id=\"a".$i."\" class=\"action cancel\" href=\"javascript: bl_runaction('".$i."','".$PHPINCE_pewf["id"]."', 'userdel')\"></a>";
		}
		echo "</td></tr>";
		$i++;
	}
	echo "<tr>
				  <th></th>
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