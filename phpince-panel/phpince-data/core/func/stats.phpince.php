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
if($PHPINCE_perms["stats"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_analytics", array(), $PHPince_logon["login"]);
	$PHPINCE_analytics = array();
	$i = 0;
	while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
		$PHPINCE_analytics[$i]["session"] = $PHPINCE_pewf["session"];
		$PHPINCE_analytics[$i]["browser"] = $PHPINCE_pewf["set_browser"];
		$PHPINCE_analytics[$i]["os"] = $PHPINCE_pewf["set_os"];
		$PHPINCE_analytics[$i]["locate_name"] = $PHPINCE_pewf["set_locate"];
		$PHPINCE_analytics[$i]["locate_code"] = $PHPINCE_pewf["set_locate_code"];
		$PHPINCE_analytics[$i]["time"] = $PHPINCE_pewf["set_time"];
		$PHPINCE_analytics[$i]["bot"] = $PHPINCE_pewf["set_bot"];
		$PHPINCE_analytics[$i]["bot_name"] = $PHPINCE_pewf["set_bot_name"];
		$i++;
	}
	$PHPINCE_pew_ref = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_analytics_ref", array(), $PHPince_logon["login"]);
	$PHPINCE_analytics_ref = array();
	$i = 0;
	while($PHPINCE_pewf_ref = $PHPINCE_pew_ref->fetch()){
		$PHPINCE_analytics_ref[$i]["domain"] = $PHPINCE_pewf_ref["set_domain"];
		$PHPINCE_analytics_ref[$i]["url"] = $PHPINCE_pewf_ref["set_url"];
		$PHPINCE_analytics_ref[$i]["click"] = $PHPINCE_pewf_ref["clicks"];
		$i++;
	}
	$PHPINCE_analytics_stats_domains = array();
	for ($i = 0; $i < count($PHPINCE_analytics_ref); $i++) {
		$PHPINCE_analytics_stats_domains[] = $PHPINCE_analytics_ref[$i]["domain"];
	}
	$PHPINCE_analytics_stats_domains = array_values(array_unique($PHPINCE_analytics_stats_domains));	
	$PHPINCE_analytics_browser = bl_statics_gsys("browser", $PHPINCE_analytics);
	$PHPINCE_analytics_os = bl_statics_gsys("os", $PHPINCE_analytics);
	$PHPINCE_analytics_locate = bl_statics_gsys("locate_name", $PHPINCE_analytics);
	$PHPINCE_analytics_bot = bl_statics_gbot($PHPINCE_analytics);
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats_40.png\">&nbsp;".$PHPINCE_LANG[1800]."</h1>";
    echo "</div>";
	echo "<div id=\"notitle\"><div><table class=\"styled\" style=\"width:49%; float:left;\">
			<tr>
				<th colspan=\"2\">".$PHPINCE_LANG[1805]."</th>
			</tr>
			<tr>
				<td style=\"width:75%\">".$PHPINCE_LANG[1801]."</td>
				<td style=\"width:auto\">".bl_statics_gous($PHPINCE_analytics, mktime('00','00','00', date('m'), date('d'), date('Y')))."</td>
			</tr>
			<tr>
				<td>".$PHPINCE_LANG[1802]."</td>
				<td>".bl_statics_gous($PHPINCE_analytics, mktime('00','00','00', date('m'), '01', date('Y')))."</td>
			</tr>
			<tr>
				<td>".$PHPINCE_LANG[1803]."</td>
				<td>".bl_statics_gous($PHPINCE_analytics, mktime('00','00','00', '01', '01', date('Y')))."</td>
			</tr>
			<tr>
				<td>".$PHPINCE_LANG[1804]."</td>
				<td>".count($PHPINCE_analytics)."</td>
			</tr>
			<tr>
				<th></th>
				<th></th>
			</tr>
		</table>
		<table class=\"styled\" style=\"width:49%; float:right;\">
			<tr>
				<th colspan=\"2\">".$PHPINCE_LANG[307]."</th>
			</tr>
			<tr>
				<td style=\"width:75%\">".$PHPINCE_LANG[1806]."</td>
				<td style=\"width:auto\">".count($PHPINCE_analytics_locate["name"])."</td>
			</tr>
			<tr>
				<td>".$PHPINCE_LANG[1807]."</td>
				<td>".count($PHPINCE_analytics_stats_domains)."</td>
			</tr>
			<tr>
				<td>".$PHPINCE_LANG[1808]."</td>
				<td>".count($PHPINCE_analytics_ref)."</td>
			</tr>
			<tr>
				<td>".$PHPINCE_LANG[1809]."</td>
				<td>".bl_statics_gbot_count(1, $PHPINCE_analytics)."</td>
			</tr>
			<tr>
				<th></th>
				<th></th>
			</tr>
		</table>
		</div></div><p>&nbsp;</p>";
	echo "<div id=\"notitle\">";
	echo "<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats_40.png\">&nbsp;".$PHPINCE_LANG[1813]."</h1><p>&nbsp;</p>";
	echo "<table class=\"styled\">
			  <tr>
				  <th style=\"width:auto;\">".$PHPINCE_LANG[1810]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1817]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1811]."</th>
			  </tr>";
	for ($i = 0; $i < count($PHPINCE_analytics_browser["name"]); $i++) {
		echo "<tr>
				  <td><img style=\"vertical-align:middle\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/stats/browser/".str_replace(' ', '-', $PHPINCE_analytics_browser["name"][$i]).".png\">&nbsp;".$PHPINCE_analytics_browser["name"][$i]."</td>";
		if(empty($PHPINCE_analytics_browser["count_now"][$i])){
			echo "<td>0%&nbsp;[0]</td>";
		} else {
			echo "<td>".round(($PHPINCE_analytics_browser["count_now"][$i]/($PHPINCE_analytics_browser["count_now_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_browser["count_now"][$i]."]</td>";
		}
		echo "<td>".round(($PHPINCE_analytics_browser["count"][$i]/($PHPINCE_analytics_browser["count_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_browser["count"][$i]."]</td>";
		echo "</tr>";
	}
	echo "<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</table><p>&nbsp;</p>";
	echo "<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats_40.png\">&nbsp;".$PHPINCE_LANG[1812]."</h1><p>&nbsp;</p>";
	echo "<table class=\"styled\">
			  <tr>
				  <th style=\"width:auto;\">".$PHPINCE_LANG[1810]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1817]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1811]."</th>
			  </tr>";
	for ($i = 0; $i < count($PHPINCE_analytics_os["name"]); $i++) {
		echo "<tr>
				  <td><img style=\"vertical-align:middle\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/stats/os/".str_replace(' ', '-', $PHPINCE_analytics_os["name"][$i]).".png\">&nbsp;".$PHPINCE_analytics_os["name"][$i]."</td>";
		if(empty($PHPINCE_analytics_os["count_now"][$i])){
			echo "<td>0%&nbsp;[0]</td>";
		} else {
			echo "<td>".round(($PHPINCE_analytics_os["count_now"][$i]/($PHPINCE_analytics_os["count_now_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_os["count_now"][$i]."]</td>";
		}
		echo "<td>".round(($PHPINCE_analytics_os["count"][$i]/($PHPINCE_analytics_os["count_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_os["count"][$i]."]</td>";
		echo "</tr>";
	}
	echo "<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</table><p>&nbsp;</p>";
	echo "<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats_40.png\">&nbsp;".$PHPINCE_LANG[1814]."</h1><p>&nbsp;</p>";
	echo "<table class=\"styled\">
			  <tr>
				  <th style=\"width:auto;\">".$PHPINCE_LANG[1810]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1817]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1811]."</th>
			  </tr>";
	for ($i = 0; $i < count($PHPINCE_analytics_locate["name"]); $i++) {
		echo "<tr>
				  <td><img style=\"vertical-align:middle\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/stats/flag/".str_replace(' ', '-', $PHPINCE_analytics_locate["name"][$i]).".png\">&nbsp;".$PHPINCE_analytics_locate["name"][$i]."</td>";
		if(empty($PHPINCE_analytics_locate["count_now"][$i])){
			echo "<td>0%&nbsp;[0]</td>";
		} else {
			echo "<td>".round(($PHPINCE_analytics_locate["count_now"][$i]/($PHPINCE_analytics_locate["count_now_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_locate["count_now"][$i]."]</td>";
		}
		echo "<td>".round(($PHPINCE_analytics_locate["count"][$i]/($PHPINCE_analytics_locate["count_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_locate["count"][$i]."]</td>";
		echo "</tr>";
	}
	echo "<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</table><p>&nbsp;</p>";
	echo "<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats_40.png\">&nbsp;".$PHPINCE_LANG[1816]."</h1><p>&nbsp;</p>";
	echo "<table class=\"styled\">
			  <tr>
				  <th style=\"width:auto;\">".$PHPINCE_LANG[1810]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1817]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1811]."</th>
			  </tr>";
	for ($i = 0; $i < count($PHPINCE_analytics_bot["name"]); $i++) {
		echo "<tr>
				  <td><img style=\"vertical-align:middle\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/stats/bot/".$PHPINCE_analytics_bot["name"][$i].".png\">&nbsp;".$PHPINCE_analytics_bot["name"][$i]."</td>";
		if(empty($PHPINCE_analytics_bot["count_now"][$i])){
			echo "<td>0%&nbsp;[0]</td>";
		} else {
			echo "<td>".round(($PHPINCE_analytics_bot["count_now"][$i]/($PHPINCE_analytics_bot["count_now_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_bot["count_now"][$i]."]</td>";
		}
		echo "<td>".round(($PHPINCE_analytics_bot["count"][$i]/($PHPINCE_analytics_bot["count_all"]/100)),2)."%&nbsp;[".$PHPINCE_analytics_bot["count"][$i]."]</td>";
		echo "</tr>";
	}
	echo "<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</table><p>&nbsp;</p>";
	echo "<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats_40.png\">&nbsp;".$PHPINCE_LANG[1815]."</h1><p>&nbsp;</p>";
	echo "<table class=\"styled\">
			  <tr>
				  <th style=\"width:auto;\">".$PHPINCE_LANG[1810]."</th>
				  <th style=\"width:20%;\">".$PHPINCE_LANG[1811]."</th>
			  </tr>";
	for ($i = 0; $i < count($PHPINCE_analytics_stats_domains); $i++) {
		echo "<tr>
				  <td>".$PHPINCE_analytics_stats_domains[$i]." <a id=\"show".$i."\" href=\"javascript: bl_show('".$i."');\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/info.png\"></a>
				  <div style=\"display:none;padding:3px 0 8px 0;\" id=\"hide".$i."\">";
		$PHPINCE_analytics_ref_fullclick = array();		
		for ($i2 = 0; $i2 < count($PHPINCE_analytics_ref); $i2++) {
			if($PHPINCE_analytics_ref[$i2]["domain"]==$PHPINCE_analytics_stats_domains[$i]){
				echo "[".$PHPINCE_analytics_ref[$i2]["click"]."] <a target=\"_blank\" href=\"".$PHPINCE_analytics_ref[$i2]["url"]."\">".$PHPINCE_analytics_ref[$i2]["url"]."</a><br>";
				$PHPINCE_analytics_ref_fullclick[] =  $PHPINCE_analytics_ref[$i2]["click"];
			}
		}
		echo "</div></td><td>".array_sum($PHPINCE_analytics_ref_fullclick)."</td>";
		echo "</tr>";
	}
	echo "<tr>
			<th></th>
			<th></th>
		</tr>
	</table><p>&nbsp;</p>";
	echo "</div>";
} else {
	bl_redirect("/panel");
}
?>