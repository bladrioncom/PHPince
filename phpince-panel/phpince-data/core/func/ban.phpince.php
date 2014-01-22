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
if($PHPINCE_perms["ban"]){
	switch($_GET["subf"]){
		case "add":
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban_40.png\">&nbsp;".$PHPINCE_LANG[1200]."&nbsp;&raquo;&nbsp;<span>".$PHPINCE_LANG[1214]."</span></h1>";
	if(!empty($_POST)){
		if((empty($_POST["ip"]))||(!preg_match("^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}^", $_POST["ip"]))){
			echo "<div class=\"warn no\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_no.png\">".$PHPINCE_LANG[1217]."</div>";
		} else {
			if($_POST["time"]=="-1"){
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_ban (ip, created, bantime, perma, autor, msg, bantype) VALUES (?, ?, ?, ?, ?, ?, ?)", array($_POST["ip"], bl_date(), 0, 1, $PHPINCE_user["account"], bl_slay($_POST["text"]), "global"), $PHPince_logon["login"]);
			} else {
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_ban (ip, created, bantime, perma, autor, msg, bantype) VALUES (?, ?, ?, ?, ?, ?, ?)", array($_POST["ip"], bl_date(), bl_date()+(60 * 60 * 24 * $_POST["time"]), 0, $PHPINCE_user["account"], bl_slay($_POST["text"]), "global"), $PHPince_logon["login"]);
			}
			bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1216} ".$_POST["ip"]), $PHPince_logon["login"]);
			bl_redirect("/panel/".$_GET["func"]);
		}
	}
    echo "</div><div id=\"notitle\"><form method=\"post\" action=\"\">";
	if(empty($_POST["ip"])){ $_POST["ip"] = ""; }
	echo "<h4>".$PHPINCE_LANG[1201]."</h4><input name=\"ip\" type=\"text\" value=\"".$_POST["ip"]."\" autocomplete=\"off\">";
	echo "<h4>".$PHPINCE_LANG[1202]."&nbsp;|&nbsp;<span>".$PHPINCE_LANG[1215]."</span></h4><select name=\"time\">";
	echo "<option value=\"-1\">".$PHPINCE_LANG[1209]."</option>";
	for ($i = 1; $i <= 40; $i++) {
		echo "<option value=\"".($i*2)."\">".($i*2)."</option>";
	}
	echo "</select>";
	if(empty($_POST["text"])){ $_POST["text"] = ""; }
	echo "<h4>".$PHPINCE_LANG[1205]."</h4><input name=\"text\" type=\"text\" value=\"".$_POST["text"]."\" autocomplete=\"off\">";
	echo "<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">";
	echo "</form></div>";
		break;
		case "":
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban_40.png\">&nbsp;".$PHPINCE_LANG[1200]."&nbsp;&raquo;&nbsp;<a href=\"/panel/ban/add\">".$PHPINCE_LANG[1214]."</a></h1>";
    echo "</div><div id=\"notitle\">";
	echo "<table class=\"styled\">
			  <tr>
				  <th>".$PHPINCE_LANG[1201]."</th>
				  <th>".$PHPINCE_LANG[1202]."</th>
				  <th>".$PHPINCE_LANG[1206]."</th>
				  <th>".$PHPINCE_LANG[1203]."</th>
				  <th>".$PHPINCE_LANG[1204]."</th>
				  <th>".$PHPINCE_LANG[1205]."</th>
				  <th></th>
			  </tr>";
	$PHPINCE_bans = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ban ORDER BY id DESC", array(), $PHPince_logon["login"]);
	if($PHPINCE_bans->rowCount()==0){
		echo "<tr><td colspan=\"7\">".$PHPINCE_LANG[1213]."</td></tr>";
	} else {
		while($PHPINCE_bans_v = $PHPINCE_bans->fetch()){
			echo "<tr id=\"".$PHPINCE_bans_v["id"]."\">
					  <td>".$PHPINCE_bans_v["ip"]."</td>
					  <td>";
			if($PHPINCE_bans_v["perma"]==1){
				echo $PHPINCE_LANG[1209];
			} else {
				echo bl_date_get($PHPINCE_bans_v["bantime"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system);
			}
			echo "</td><td>";
			if(($PHPINCE_bans_v["bantime"] > bl_date())||($PHPINCE_bans_v["perma"]==1)){
				  echo "<span style=\"color:#0F0;\">".$PHPINCE_LANG[1207]."</span>";
			} else {
				  echo "<span style=\"color:#F00;\">".$PHPINCE_LANG[1208]."</span>";
			}
			echo "</td><td>";
			switch($PHPINCE_bans_v["bantype"]){
				case "login":
					echo $PHPINCE_LANG[1210];
				break;
				case "global":
					echo $PHPINCE_LANG[1211];
				break;
			}
			echo "</td>
					  <td>".$PHPINCE_bans_v["autor"]."</td>
					  <td>".$PHPINCE_bans_v["msg"]."</td>
					  <td><a id=\"a".$PHPINCE_bans_v["id"]."\" class=\"action cancel\" href=\"javascript: bl_runaction(".$PHPINCE_bans_v["id"].",'".$PHPINCE_bans_v["ip"]."', 'unban');\"></a></td>
				  </tr>";
		}
	}
	echo "<tr>
				  <th></th>
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