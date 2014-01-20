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
ob_start();
require "phpince-panel/phpince-data/core/bladrion.unisc.php";
if(!file_exists("phpince-panel/phpince-data/config/phpince.connect.php")) {
	header('HTTP/1.0 404 Not Found');
	echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array("Config not found","Config not found","Please install the system PHPince. <a href=\"install/\">Install now !</a>"),bl_fread("phpince-panel/phpince-data/core/error.html"));
	exit;
}
require "phpince-panel/phpince-data/config/phpince.connect.php";
$PHPince_logon = bl_connect($PHPINCE_config, "mysql");
$PHPINCE_config = false;
if(!$PHPince_logon["active"]){
	header('HTTP/1.0 404 Not Found');
	echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array("Connect to database failed","Connect to database failed","Connecting to your database failed. Database server is probably not available."),bl_fread("phpince-panel/phpince-data/core/error.html"));
	exit;
}
require "phpince-panel/phpince-data/core/phpince.lang.php";
$PHPINCE_LANGS = array_keys($PHPINCE_LANG);
$PHPINCE_system = bl_system($PHPince_logon);
if($PHPINCE_LANG[$PHPINCE_system["language"]]){
	$PHPINCE_LANG_AC = $PHPINCE_LANG[$PHPINCE_system["language"]];
} else {
	$PHPINCE_LANG_AC = array();
}
require "phpince-panel/phpince-data/config/phpince.secured.php";
ini_set('display_errors', '0');
ini_set('error_reporting', E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__)."/phpince-panel/phpince-data/report/phpince.error_log-".bl_hash($PHPINCE_secured["hash"]).".log");
$PHPINCE_secured = bl_hash($PHPINCE_secured["hash"]);
$PHPINCE_LANG = $PHPINCE_LANG_AC + $PHPINCE_LANG["English"];
$PHPINCE_ban = bl_checkban($PHPince_logon);
if(($PHPINCE_ban["active"]==1)&&($PHPINCE_ban["type"]=="global")){
	if($PHPINCE_ban["perma"]==1){
		$PHPINCE_ban_unban = "Permanent";
	} else {
		$PHPINCE_ban_unban = date("F j, Y, g:i a T", $PHPINCE_ban["time"]);
	}
	echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array($PHPINCE_LANG[200],$PHPINCE_LANG[200],$PHPINCE_LANG[201]."<br>[Created] ".date("F j, Y, g:i a T", $PHPINCE_ban["created"])."<br>[Unban] ".$PHPINCE_ban_unban."<br>[Autor] ".$PHPINCE_ban["autor"]."<br>[Msg] ".$PHPINCE_ban["msg"]),bl_fread("phpince-panel/phpince-data/core/error.html"));
	exit;
}
if((!empty($_GET["phpince-panel"]))&&($_GET["phpince-panel"]==1)){
	if(empty($_GET["subf"])){ $_GET["subf"] = ""; }
	if(empty($_GET["func"])){ $_GET["func"] = ""; }
	if(bl_logincheck($PHPince_logon)){
		$PHPINCE_user = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ? LIMIT 1", array($_COOKIE["phpinceacc"]), $PHPince_logon["login"])->fetch();
		$PHPINCE_perms = bl_getperms($PHPINCE_user, $PHPince_logon);
		echo "<!DOCTYPE HTML>
<html>
<head>";
		bl_metaheader($PHPINCE_system, $PHPince_logon, $PHPINCE_LANG[0]);
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/temp.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/font.css\">
<link rel=\"shortcut icon\" href=\"/phpince-panel/phpince-data/core/tems/favicon.ico\">
<script type=\"text/javascript\" src=\"/phpince-panel/phpince-data/jquery/jquery.js\"></script>
<script type=\"text/javascript\" src=\"/phpince-panel/phpince-data/jquery/jquery.ui.js\"></script>
<script type=\"text/javascript\" src=\"/phpince-panel/phpince-data/core/bladrion.script.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/phpince-panel/phpince-data/codemirror/codemirror.css\">
<script type=\"text/javascript\" src=\"/phpince-panel/phpince-data/codemirror/codemirror.js\"></script>
<script type=\"text/javascript\" src=\"/phpince-panel/phpince-data/colorbox/jquery.colorbox-min.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/phpince-panel/phpince-data/colorbox/colorbox.css\" />
</head>
<body>
	<header>
    	<div id=\"logo\"></div>
        <nav>
        	<ul>
            	<li><a class=\"a\" href=\"/\">".$PHPINCE_LANG[3]."</a></li>
                <li><a class=\"b\" href=\"/panel\">".$PHPINCE_LANG[4]."</a></li>";
				if($PHPINCE_perms["settings"]){
                	echo "<li><a class=\"c\" href=\"/panel/settings\">".$PHPINCE_LANG[5]."</a></li>";
				}
                echo "<li><a class=\"d\" href=\"/panel/logout\">".$PHPINCE_LANG[6]."</a></li>
            </ul>
        </nav>
    </header>
    <div id=\"wrapper\">
    	<div id=\"container\">
        	<nav>";
			if($PHPINCE_perms){
            	echo "<h2>".$PHPINCE_LANG[7]."</h2>";
            	echo "<ul>";
					if($PHPINCE_perms["news"]){
                		echo "<li><a href=\"/panel/news\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/news.png\">".$PHPINCE_LANG[14]."</a></li>";
					}
					if($PHPINCE_perms["pages"]){
                    	echo "<li><a href=\"/panel/pages\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/page.png\">".$PHPINCE_LANG[15]."</a></li>";
					}
					if($PHPINCE_perms["files"]){
                    	echo "<li><a href=\"/panel/files\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/file.png\">".$PHPINCE_LANG[16]."</a></li>";
					}
					if($PHPINCE_perms["users"]){
                    	echo "<li><a href=\"/panel/users\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/user.png\">".$PHPINCE_LANG[17]."</a></li>";
					}
					if($PHPINCE_perms["perms"]){
						echo "<li><a href=\"/panel/perms\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban.png\">".$PHPINCE_LANG[26]."</a></li>";
					}
					if($PHPINCE_perms["nav"]){
                    	echo "<li><a href=\"/panel/nav\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/nav.png\">".$PHPINCE_LANG[18]."</a></li>";
					}
					if($PHPINCE_perms["apps"]){
                    	echo "<li><a href=\"/panel/apps\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/app.png\">".$PHPINCE_LANG[19]."</a></li>";
					}
					if($PHPINCE_perms["formating"]){
                    	echo "<li><a href=\"/panel/formating\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/style.png\">".$PHPINCE_LANG[20]."</a></li>";
					}
					if($PHPINCE_perms["styleeditor"]){
                    	echo "<li><a href=\"/panel/styleeditor\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/style_editor.png\">".$PHPINCE_LANG[31]."</a></li>";
					}
					if($PHPINCE_perms["ban"]){
                    	echo "<li><a href=\"/panel/ban\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban.png\">".$PHPINCE_LANG[21]."</a></li>";
					}
					if($PHPINCE_perms["stats"]){
                    	echo "<li><a href=\"/panel/stats\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/stats.png\">".$PHPINCE_LANG[22]."</a></li>";
					}
					if($PHPINCE_perms["script"]){
                    	echo "<li><a href=\"/panel/script\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/script.png\">".$PHPINCE_LANG[23]."</a></li>";
					}
                echo "</ul>";
			}
                echo "<h2>".$PHPINCE_LANG[8]."</h2>
            	<ul>
                	<li><a href=\"/panel/account\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/usero.png\">".$PHPINCE_LANG[24]."</a></li>
                    <li><a href=\"/panel/changepassword\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/ban.png\">".$PHPINCE_LANG[25]."</a></li>
                </ul>
            </nav>
		<section>";
		switch($_GET["func"]){
			case "":
				if($PHPINCE_perms["systeminfo"]){
				$PHPINCE_pew_analytics = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_analytics", array(), $PHPince_logon["login"]);
				$PHPINCE_analytics = array();
				$i = 0;
				while($PHPINCE_pewf_analytics = $PHPINCE_pew_analytics->fetch()){
					$PHPINCE_analytics[$i]["session"] = $PHPINCE_pewf_analytics["session"];
					$PHPINCE_analytics[$i]["time"] = $PHPINCE_pewf_analytics["set_time"];
					$PHPINCE_analytics[$i]["bot"] = $PHPINCE_pewf_analytics["set_bot"];
					$i++;
				}
				echo "<div id=\"title\">
                	<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/admin_40.png\">&nbsp;".$PHPINCE_LANG[300]."</h1>
                </div>";
				echo "<div id=\"notitle\"><div><table class=\"styled\" style=\"width:49%; float:left;\">
                        <tr>
                            <th colspan=\"2\">".$PHPINCE_LANG[301]."</th>
                        </tr>
                        <tr>
                            <td style=\"width:32%\">".$PHPINCE_LANG[302]."</td>
                            <td style=\"width:auto\">".$PHPINCE_system["title"]."</td>
                        </tr>
						<tr>
                            <td style=\"width:32%\">".$PHPINCE_LANG[303]."</td>
                            <td style=\"width:auto\">".$PHPINCE_system["php"]."</td>
                        </tr>
						<tr>
                            <td style=\"width:32%\">".$PHPINCE_LANG[304]."</td>
                            <td style=\"width:auto\">".$PHPINCE_system["mysql"]."</td>
                        </tr>
						<tr>
                            <td style=\"width:32%\">".$PHPINCE_LANG[305]."</td>
                            <td style=\"width:auto\">";
							if((bl_sysversion($PHPINCE_system))||(!$PHPINCE_system["version_checker"])){
								echo $PHPINCE_system["system"]["SYSTEM"]." ".$PHPINCE_system["system"]["SUBVERSION"]."</a>";
							} else {
								echo "<span style=\"color:#FF0000\">".$PHPINCE_system["system"]["SYSTEM"]." ".$PHPINCE_system["system"]["SUBVERSION"]."</span>&nbsp;";
								if($PHPINCE_perms["sysupdate"]){
									echo "<a id=\"load\" href=\"javascript: bl_systemupdate()\">".$PHPINCE_LANG[27]." ".bl_sysversion($PHPINCE_system, true)."</a>";
								}
							}
							echo "</td>
                        </tr>
						<tr>
                            <td style=\"width:32%\">".$PHPINCE_LANG[306]."</td>
                            <td style=\"width:auto\">".$PHPINCE_system["system"]["CORE"]."</td>
                        </tr>
						<tr>
                            <td>".$PHPINCE_LANG[312]."</td>
                            <td>".bl_mysqlsize($PHPince_logon)."</td>
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
                            <td>".$PHPINCE_LANG[308]."</td>
                            <td>".bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news", array(), $PHPince_logon["login"])->rowCount()."</td>
                        </tr>
						<tr>
                            <td>".$PHPINCE_LANG[309]."</td>
                            <td>".bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_pages", array(), $PHPince_logon["login"])->rowCount()."</td>
                        </tr>
						<tr>
                            <td>".$PHPINCE_LANG[310]."</td>
                            <td>".bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc", array(), $PHPince_logon["login"])->rowCount()."</td>
                        </tr>
						<tr>
                            <td>".$PHPINCE_LANG[311]."</td>
                            <td>".bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ban WHERE bantime > ? OR perma = ?", array(bl_date(), 1), $PHPince_logon["login"])->rowCount()."</td>
                        </tr>
						<tr>
                            <td>".$PHPINCE_LANG[319]."</td>
                            <td>".bl_statics_gous($PHPINCE_analytics, mktime('00','00','00', date('m'), date('d'), date('Y')))."</td>
                        </tr>
						<tr>
                            <td>".$PHPINCE_LANG[318]."</td>
                            <td>".bl_getpr()."</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
					</div>";
				echo "</div>&nbsp;";
				}
				echo "<div id=\"title\">
                	<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/usero_40.png\">&nbsp;".$PHPINCE_LANG[313]."</h1>
                </div><div id=\"notitle\"><table class=\"styled\">
                        <tr>
                            <th>".$PHPINCE_LANG[314]."</th>
							<th>".$PHPINCE_LANG[315]."</th>
                            <th>".$PHPINCE_LANG[316]."</th>
                        </tr>";
				$PHPINCE_LOG_USERO_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_log WHERE account = ? AND action = ? ORDER BY id DESC LIMIT 10", array($_COOKIE["phpinceacc"], "{LOGIN}"), $PHPince_logon["login"]);
				while ($PHPINCE_LOG_USERO_V = $PHPINCE_LOG_USERO_query->fetch()) {
					echo "<tr>
					<td>".bl_date_get($PHPINCE_LOG_USERO_V["adate"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."</td>
					<td>".$PHPINCE_LOG_USERO_V["ip"]."</td>
					<td>".bl_replace(array("{TRANSLATE_102}","{TRANSLATE_133}"),array($PHPINCE_LANG[102],$PHPINCE_LANG[133]),$PHPINCE_LOG_USERO_V["msg"])."</td>
				</tr>";
				}
				echo "<tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>";
				echo "</div>";
				if($PHPINCE_perms["systemlog"]){
					if(file_exists("phpince-panel/phpince-data/report/phpince.error_log-".$PHPINCE_secured.".log")){
						$PHPINCE_ERLOG = bl_filesize(filesize("phpince-panel/phpince-data/report/phpince.error_log-".$PHPINCE_secured.".log"));
					} else {
						$PHPINCE_ERLOG = "0 B";
					}
				echo "<p>&nbsp;</p><div id=\"title\">
                	<h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/sett_40.png\">&nbsp;".$PHPINCE_LANG[317]." | <a target=\"_blank\" href=\"/phpince-panel/phpince-data/report/phpince.error_log-".$PHPINCE_secured.".log\" class=\"iframe\" title=\"PHPince - Error Log\">Error log</a>&nbsp;<span style=\"font-size:14px;\">[".$PHPINCE_ERLOG."]</span></h1>
                </div><div id=\"notitle\"><table class=\"styled\">
                        <tr>
							<th>#</th>
							<th>".$PHPINCE_LANG[320]."</th>
                            <th>".$PHPINCE_LANG[314]."</th>
							<th>".$PHPINCE_LANG[315]."</th>
                            <th>".$PHPINCE_LANG[316]."</th>
                        </tr>";
				$PHPINCE_LOG_SYS_account_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc ORDER BY id DESC", array(), $PHPince_logon["login"]);
				$PHPINCE_LOG_SYS_account_array = array();
				while ($PHPINCE_LOG_SYS_account_V = $PHPINCE_LOG_SYS_account_query->fetch()) {
					$PHPINCE_LOG_SYS_account_array[$PHPINCE_LOG_SYS_account_V["id"]] = $PHPINCE_LOG_SYS_account_V["account"];
				}
				$PHPINCE_LOG_SYS_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_log WHERE action = ? ORDER BY id DESC LIMIT 15", array("{SYSTEM}"), $PHPince_logon["login"]);
				while ($PHPINCE_LOG_SYS_V = $PHPINCE_LOG_SYS_query->fetch()) {
					echo "<tr>
					<td>".$PHPINCE_LOG_SYS_V["id"]."</td>
					<td>".$PHPINCE_LOG_SYS_account_array[$PHPINCE_LOG_SYS_V["account"]]."</td>
					<td>".bl_date_get($PHPINCE_LOG_SYS_V["adate"], "j.n.Y - g:i a", "j.n.Y - G:i", $PHPINCE_system)."</td>
					<td>".$PHPINCE_LOG_SYS_V["ip"]."</td>
					<td>".bl_replace(array("{TRANSLATE_28}","{TRANSLATE_102}","{TRANSLATE_133}","{TRANSLATE_521}","{TRANSLATE_806}","{TRANSLATE_807}","{TRANSLATE_808}","{TRANSLATE_910}","{TRANSLATE_911}","{TRANSLATE_912}","{TRANSLATE_913}","{TRANSLATE_914}","{TRANSLATE_915}", "{TRANSLATE_1002}", "{TRANSLATE_1101}", "{TRANSLATE_1212}", "{TRANSLATE_1216}", "{TRANSLATE_1307}", "{TRANSLATE_1308}", "{TRANSLATE_1406}", "{TRANSLATE_1407}", "{TRANSLATE_1409}", "{TRANSLATE_1506}", "{TRANSLATE_1507}", "{TRANSLATE_1509}", "{TRANSLATE_1516}", "{TRANSLATE_1520}", "{TRANSLATE_1521}", "{TRANSLATE_1602}", "{TRANSLATE_1603}", "{TRANSLATE_1702}"),array($PHPINCE_LANG[28],$PHPINCE_LANG[102],$PHPINCE_LANG[133],$PHPINCE_LANG[521],$PHPINCE_LANG[806],$PHPINCE_LANG[807],$PHPINCE_LANG[808],$PHPINCE_LANG[910],$PHPINCE_LANG[911],$PHPINCE_LANG[912],$PHPINCE_LANG[913],$PHPINCE_LANG[914],$PHPINCE_LANG[915],$PHPINCE_LANG[1002],$PHPINCE_LANG[1101],$PHPINCE_LANG[1212],$PHPINCE_LANG[1216],$PHPINCE_LANG[1307],$PHPINCE_LANG[1308],$PHPINCE_LANG[1406],$PHPINCE_LANG[1407],$PHPINCE_LANG[1409],$PHPINCE_LANG[1506],$PHPINCE_LANG[1507],$PHPINCE_LANG[1509],$PHPINCE_LANG[1516],$PHPINCE_LANG[1520],$PHPINCE_LANG[1521],$PHPINCE_LANG[1602],$PHPINCE_LANG[1603],$PHPINCE_LANG[1702]),$PHPINCE_LOG_SYS_V["msg"])."</td>
				</tr>";
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
				}
				echo "<p>&nbsp;</p>";
			break;
			case "settings": require bl_getsystemplugin("settings"); break;
			case "changepassword": require bl_getsystemplugin("changepassword"); break;
			case "account": require bl_getsystemplugin("account"); break;
			case "files": require bl_getsystemplugin("files"); break;
			case "nav": require bl_getsystemplugin("nav"); break;
			case "script": require bl_getsystemplugin("script"); break;
			case "ban": require bl_getsystemplugin("ban"); break;
			case "perms": require bl_getsystemplugin("perms"); break;
			case "users": require bl_getsystemplugin("users"); break;
			case "pages": require bl_getsystemplugin("pages"); break;
			case "news": require bl_getsystemplugin("news"); break;
			case "apps": require bl_getsystemplugin("apps"); break;
			case "formating": require bl_getsystemplugin("formating"); break;
			case "stats": require bl_getsystemplugin("stats"); break;
			case "styleeditor": require bl_getsystemplugin("styleeditor"); break;
			case "logout":
				bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_hash WHERE hash = ?", array($_COOKIE["phpincehash"]), $PHPince_logon["login"]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($_COOKIE["phpinceacc"], $_SERVER['REMOTE_ADDR'], bl_date(), "{LOGIN}", "{TRANSLATE_133}"), $PHPince_logon["login"]);
				setcookie('phpinceacc', '' , time()-3600 , '/' , '' , 0 );
				setcookie('phpincehash', '' , time()-3600 , '/' , '' , 0 );
				bl_redirect("/panel/login");
			break;
			default:
				bl_redirect("/panel");
		}
		echo "</section>
        </div>
    </div>
    <footer>
    	<div id=\"box\">
        	<div class=\"copy\">Powered by <a href=\"http://phpince.com\">PHPince Website</a> ".$PHPINCE_system["system"]["SYSTEM"].", copyright &copy; 2011 - 2014 by <a href=\"http://bladrion.com\">Dominik Hulla</a>.</div>
            <div class=\"lic\">Released as free software without warranties under <a href=\"http://phpince.com/page/19\">GNU GPL v3</a>(or later).</div>
        </div>
    </footer>
</body>
</html>";
	} else {
		switch($_GET["func"]){
			case "resetpass":
				if($PHPINCE_system["stopspam"]){
					if(bl_stopspam($PHPINCE_system)){
						echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array($PHPINCE_LANG[200],$PHPINCE_LANG[200],$PHPINCE_LANG[201]."<br>[Unban] Permanent<br>[Autor] STOPspam"),bl_fread("phpince-panel/phpince-data/core/error.html"));
						exit;
					}
				}
				switch($_GET["subf"]){
					case "": break;
					default:
						bl_redirect("/panel/".$_GET["func"]);
				}
				echo "<!DOCTYPE HTML><html>
				<head>";
				bl_metaheader($PHPINCE_system, $PHPince_logon, $PHPINCE_LANG[108]);
				echo "<link href=\"/phpince-panel/phpince-data/core/tems/phpince-login/login_temp.css\" rel=\"stylesheet\" type=\"text/css\">
				<link rel=\"shortcut icon\" href=\"/phpince-panel/phpince-data/core/tems/favicon.ico\">";
				echo "</head><body>";
				if(!empty($_POST)){
					if(empty($_POST["phpincekey"])){
						echo "<div id=\"phpince_error\">".$PHPINCE_LANG[114]."</div>";
					} else {
						if($_COOKIE["bladrioncapcha"]==sha1($_POST["phpince_captcha"])){
							if(!preg_match("/[^a-zA-Z0-9]/", $_POST["phpincekey"])){
								bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_resetpass WHERE expire < ?", array(bl_date()), $PHPince_logon["login"]);
								$PHPINCE_PASS_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_resetpass WHERE hash = ?", array($_POST["phpincekey"]), $PHPince_logon["login"]);
								if($PHPINCE_PASS_query->rowCount()==1){
									$PHPINCE_PASS_IV = $PHPINCE_PASS_query->fetch();
									bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_acc SET password = ? WHERE id = ?", array($PHPINCE_PASS_IV["newpass"],$PHPINCE_PASS_IV["account"]), $PHPince_logon["login"]);
									bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_resetpass WHERE hash = ?", array($_POST["phpincekey"]), $PHPince_logon["login"]);
									echo "<div id=\"phpince_succes\">".$PHPINCE_LANG[132]."</div>";
									bl_redirect("/panel/login", 2);
								} else {
									echo "<div id=\"phpince_error\">".$PHPINCE_LANG[131]."</div>";
								}
							} else {
								echo "<div id=\"phpince_error\">".$PHPINCE_LANG[131]."</div>";
							}
						} else {
							echo "<div id=\"phpince_error\">".$PHPINCE_LANG[118]."</div>";
						}
					}
				}
				echo "<form method=\"post\" action=\"\"><div id=\"container\" style=\"margin-top:8%;\">
						<div id=\"content\">
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[130]."</h2>
								<input name=\"phpincekey\" type=\"text\" value=\"\" autocomplete=\"off\" />
							</div>
							<div class=\"input\">
								<h2>Captcha</h2>
								<div id=\"captcha\">
									<img src=\"/phpince-panel/phpince-data/core/bladrion.captcha.php\" width=\"74\" height=\"25\" />
									<input name=\"phpince_captcha\" type=\"text\" value=\"\" maxlength=\"5\" autocomplete=\"off\" />
								</div>
								<span>".$PHPINCE_LANG[111]."</span>
							</div>
							<div id=\"action\">
								<input type=\"submit\" value=\"".$PHPINCE_LANG[124]."\" />";
							echo "</div>
							<div id=\"footer\">
								".$PHPINCE_LANG[1]." <a href=\"http://phpince.com\">PHPince - ".$PHPINCE_LANG[2]."</a>
							</div>
						</div>
					</div></form>
				</body></html>";
			break;
			case "password":
				if($PHPINCE_system["stopspam"]){
					if(bl_stopspam($PHPINCE_system)){
						echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array($PHPINCE_LANG[200],$PHPINCE_LANG[200],$PHPINCE_LANG[201]."<br>[Unban] Permanent<br>[Autor] STOPspam"),bl_fread("phpince-panel/phpince-data/core/error.html"));
						exit;
					}
				}
				switch($_GET["subf"]){
					case "": break;
					default:
						bl_redirect("/panel/".$_GET["func"]);
				}
				echo "<!DOCTYPE HTML><html>
				<head>";
				bl_metaheader($PHPINCE_system, $PHPince_logon, $PHPINCE_LANG[108]);
				echo "<link href=\"/phpince-panel/phpince-data/core/tems/phpince-login/login_temp.css\" rel=\"stylesheet\" type=\"text/css\">
				<link rel=\"shortcut icon\" href=\"/phpince-panel/phpince-data/core/tems/favicon.ico\">";
				echo "</head><body>";
				if(!empty($_POST)){
					if((empty($_POST["phpinceacc"]))||(empty($_POST["phpincepass"]))||(empty($_POST["phpincepass2"]))){
						echo "<div id=\"phpince_error\">".$PHPINCE_LANG[114]."</div>";
					} else {
						if($_COOKIE["bladrioncapcha"]==sha1($_POST["phpince_captcha"])){
							if((!preg_match("/[^a-zA-Z0-9]/", $_POST["phpinceacc"]))&&(!preg_match("/[^a-zA-Z0-9]/", $_POST["phpincepass"]))&&(!preg_match("/[^a-zA-Z0-9]/", $_POST["phpincepass2"]))){
								if($_POST["phpincepass"]==$_POST["phpincepass2"]){
									$PHPINCE_PASS_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE account = ?", array($_POST["phpinceacc"]), $PHPince_logon["login"]);
									if($PHPINCE_PASS_query->rowCount()==1){
										$PHPINCE_PASS_IV = $PHPINCE_PASS_query->fetch();
										$PHPINCE_cript = bl_hash(bl_randtext(5).$_POST["phpinceacc"]);
										$PHPINCE_domain = preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']);
										bl_mail($PHPINCE_system["title"]." - ".$PHPINCE_LANG[108],$PHPINCE_LANG[126]."&nbsp;".$PHPINCE_PASS_IV["account"].",<br>".$PHPINCE_LANG[127]."<h3>".$PHPINCE_cript."</h3>".$PHPINCE_LANG[128]."&nbsp;<a href=\"http://".$PHPINCE_domain."/panel/resetpass\">http://".$PHPINCE_domain."/panel/resetpass</a>",$PHPINCE_PASS_IV["email"]);
										bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_resetpass (hash, account, newpass, expire) VALUES (?, ?, ?, ?)", array($PHPINCE_cript, $PHPINCE_PASS_IV["id"], bl_hash($_POST["phpincepass"]), (bl_date()+43200)), $PHPince_logon["login"]);
										echo "<div id=\"phpince_succes\">".$PHPINCE_LANG[129]."&nbsp;".substr($PHPINCE_PASS_IV["email"], 0, true)."****".strstr($PHPINCE_PASS_IV["email"], '@')."</div>";
									} else {
										echo "<div id=\"phpince_error\">".$PHPINCE_LANG[123]."</div>";
									}
								} else {
									echo "<div id=\"phpince_error\">".$PHPINCE_LANG[125]."</div>";
								}
							} else {
								echo "<div id=\"phpince_error\">".$PHPINCE_LANG[117]."</div>";
							}
						} else {
							echo "<div id=\"phpince_error\">".$PHPINCE_LANG[118]."</div>";
						}
					}
				}
				echo "<form method=\"post\" action=\"\"><div id=\"container\" style=\"margin-top:5%;\">
						<div id=\"content\">
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[105]."</h2>
								<input name=\"phpinceacc\" type=\"text\" value=\"\" autocomplete=\"off\" />
							</div>
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[120]."</h2>
								<input name=\"phpincepass\" type=\"password\" value=\"\" autocomplete=\"off\" />
								<span>".$PHPINCE_LANG[119]."</span>
							</div>
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[121]."</h2>
								<input name=\"phpincepass2\" type=\"password\" value=\"\" autocomplete=\"off\" />
							</div>
							<div class=\"input\">
								<h2>Captcha</h2>
								<div id=\"captcha\">
									<img src=\"/phpince-panel/phpince-data/core/bladrion.captcha.php\" width=\"74\" height=\"25\" />
									<input name=\"phpince_captcha\" type=\"text\" value=\"\" maxlength=\"5\" autocomplete=\"off\" />
								</div>
								<span>".$PHPINCE_LANG[111]."</span>
							</div>
							<div id=\"action\">
								<input type=\"submit\" value=\"".$PHPINCE_LANG[124]."\" />";
							echo "</div>
							<div id=\"footer\">
								".$PHPINCE_LANG[1]." <a href=\"http://phpince.com\">PHPince - ".$PHPINCE_LANG[2]."</a>
							</div>
						</div>
					</div></form>
				</body></html>";
			break;
			case "reg":
				if($PHPINCE_system["stopspam"]){
					if(bl_stopspam($PHPINCE_system)){
						echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array($PHPINCE_LANG[200],$PHPINCE_LANG[200],$PHPINCE_LANG[201]."<br>[Unban] Permanent<br>[Autor] STOPspam"),bl_fread("phpince-panel/phpince-data/core/error.html"));
						exit;
					}
				}
				switch($_GET["subf"]){
					case "": break;
					default:
						bl_redirect("/panel/".$_GET["func"]);
				}
				if($PHPINCE_system["reg"]==0){
					bl_redirect("/panel/login", 0);
				}
				echo "<!DOCTYPE HTML><html>
				<head>";
				bl_metaheader($PHPINCE_system, $PHPince_logon, $PHPINCE_LANG[109]);
				echo "<link href=\"/phpince-panel/phpince-data/core/tems/phpince-login/login_temp.css\" rel=\"stylesheet\" type=\"text/css\">
				<link rel=\"shortcut icon\" href=\"/phpince-panel/phpince-data/core/tems/favicon.ico\">";
				echo "</head><body>";
				if(!empty($_POST)){
					if((empty($_POST["phpinceuser"]))||(empty($_POST["phpincepass"]))||(empty($_POST["phpincemail"]))){
						echo "<div id=\"phpince_error\">".$PHPINCE_LANG[114]."</div>";
					} else {
						if($_COOKIE["bladrioncapcha"]==sha1($_POST["phpince_captcha"])){
							if((!preg_match("/[^a-zA-Z0-9]/", $_POST["phpinceuser"]))&&(!preg_match("/[^a-zA-Z0-9]/", $_POST["phpincepass"]))&&(preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $_POST["phpincemail"]))){
								$PHPINCE_REG_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE account = ? OR email = ?", array($_POST["phpinceuser"], $_POST["phpincemail"]), $PHPince_logon["login"]);
								if($PHPINCE_REG_query->rowCount()==0){
									bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_acc (account, password, email, lastip, regdate) VALUES (?, ?, ?, ?, ?)", array($_POST["phpinceuser"], bl_hash($_POST["phpincepass"]), $_POST["phpincemail"], $_SERVER['REMOTE_ADDR'], bl_date()), $PHPince_logon["login"]);
									echo "<div id=\"phpince_succes\">".$PHPINCE_LANG[115]."</div>";
									bl_redirect("/panel/login", 2);
								} else {
									echo "<div id=\"phpince_error\">".$PHPINCE_LANG[116]."</div>";
								}
							} else {
								echo "<div id=\"phpince_error\">".$PHPINCE_LANG[117]."</div>";
							}
						} else {
							echo "<div id=\"phpince_error\">".$PHPINCE_LANG[118]."</div>";
						}
					}
				}
				echo "<form method=\"post\" action=\"\"><div id=\"container\" style=\"margin-top:4%;\">
						<div id=\"content\">
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[105]."</h2>
								<input name=\"phpinceuser\" type=\"text\" value=\"".$_POST["phpinceuser"]."\" autocomplete=\"off\" />
								<span>".$PHPINCE_LANG[119]."</span>
							</div>
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[106]."</h2>
								<input name=\"phpincepass\" type=\"password\" value=\"\" autocomplete=\"off\" />
							</div>
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[110]."</h2>
								<input name=\"phpincemail\" type=\"email\" value=\"".$_POST["phpincemail"]."\" autocomplete=\"off\" />
							</div>
							<div class=\"input\">
								<h2>Captcha</h2>
								<div id=\"captcha\">
									<img src=\"/phpince-panel/phpince-data/core/bladrion.captcha.php\" width=\"74\" height=\"25\" />
									<input name=\"phpince_captcha\" type=\"text\" value=\"\" maxlength=\"5\" autocomplete=\"off\" />
								</div>
								<span>".$PHPINCE_LANG[111]."</span>
							</div>
							<div class=\"terms\">".$PHPINCE_LANG[113]."</div>
							<div id=\"action\">
								<input type=\"submit\" value=\"".$PHPINCE_LANG[112]."\" />";
							echo "</div>
							<div id=\"footer\">
								".$PHPINCE_LANG[1]." <a href=\"http://phpince.com\">PHPince - ".$PHPINCE_LANG[2]."</a>
							</div>
						</div>
					</div></form>
				</body></html>";
			break;
			case "login":
				if($PHPINCE_system["stopspam"]){
					if(bl_stopspam($PHPINCE_system)){
						echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array($PHPINCE_LANG[200],$PHPINCE_LANG[200],$PHPINCE_LANG[201]."<br>[Unban] Permanent<br>[Autor] STOPspam"),bl_fread("phpince-panel/phpince-data/core/error.html"));
						exit;
					}
				}
				switch($_GET["subf"]){
					case "": break;
					default:
						bl_redirect("/panel/".$_GET["func"]);
				}
				echo "<!DOCTYPE HTML><html>
				<head>";
				bl_metaheader($PHPINCE_system, $PHPince_logon, $PHPINCE_LANG[100]);
				echo "<link href=\"/phpince-panel/phpince-data/core/tems/phpince-login/login_temp.css\" rel=\"stylesheet\" type=\"text/css\">
				<link rel=\"shortcut icon\" href=\"/phpince-panel/phpince-data/core/tems/favicon.ico\">";
				echo "</head><body>";
				if(($PHPINCE_ban["active"]==1)&&($PHPINCE_ban["type"]=="login")){			
					echo "<div id=\"phpince_error\">".bl_replace(array("{BAN_TIME}"),array($PHPINCE_system["ban"]["time"]),$PHPINCE_LANG[202])."</div>";
				} else {
					if(!empty($_POST)){
						if((empty($_POST["phpinceacc"]))||(empty($_POST["phpincepass"]))){
							echo "<div id=\"phpince_error\">".$PHPINCE_LANG[101]."</div>";
						} else {
							if((!preg_match("/[^a-zA-Z0-9]/", $_POST["phpinceacc"]))&&(!preg_match("/[^a-zA-Z0-9]/", $_POST["phpincepass"]))){
								$PHPINCE_LOGIN_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE account = ? AND password = ?", array($_POST["phpinceacc"], bl_hash($_POST["phpincepass"])), $PHPince_logon["login"]);
								if($PHPINCE_LOGIN_query->rowCount()==1){
									$PHPINCE_LOGIN_V = $PHPINCE_LOGIN_query->fetch();
									setcookie("phpinceacc", $PHPINCE_LOGIN_V["id"], 0, "/");
									$PHPINCE_LOGIN_phpincehash = bl_hash($PHPINCE_LOGIN_V["account"]."phpince".bl_hash(rand(0,900)));
									setcookie("phpincehash", $PHPINCE_LOGIN_phpincehash, 0, "/");
									bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_hash (hash, account, ip, created) VALUES (?, ?, ? , ?)", array($PHPINCE_LOGIN_phpincehash, $PHPINCE_LOGIN_V["id"], $_SERVER['REMOTE_ADDR'], bl_date()), $PHPince_logon["login"]);
									bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_acc SET lastlogin = ?, lastip = ? WHERE id = ?", array(bl_date(), $_SERVER['REMOTE_ADDR'],$PHPINCE_LOGIN_V["id"]), $PHPince_logon["login"]);
									bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_LOGIN_V["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{LOGIN}", "{TRANSLATE_102}"), $PHPince_logon["login"]);
									$PHPINCE_LOGIN_ban_login = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ban_login WHERE ip = ?", array(bl_hash($_SERVER['REMOTE_ADDR'])), $PHPince_logon["login"]);
									if($PHPINCE_LOGIN_ban_login->rowCount()==1){
										bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_ban_login WHERE ip = ?", array(bl_hash($_SERVER['REMOTE_ADDR'])), $PHPince_logon["login"]);
									}
									if(empty($PHPINCE_system["login_redirect"])){
										bl_reload();
									} else {
										bl_redirect($PHPINCE_system["login_redirect"]);
									}
								} else {
									echo "<div id=\"phpince_error\">".$PHPINCE_LANG[103]."</div>";
									$PHPINCE_LOGIN_ban_login = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ban_login WHERE ip = ?", array(bl_hash($_SERVER['REMOTE_ADDR'])), $PHPince_logon["login"]);
									$PHPINCE_LOGIN_ban_login_fetch = $PHPINCE_LOGIN_ban_login->fetch();
									if($PHPINCE_LOGIN_ban_login_fetch["denyes"]>=$PHPINCE_system["ban"]["count"]){
										bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_ban (ip, created, bantime, autor, msg, bantype) VALUES (?, ?, ?, ?, ?, ?)", array($_SERVER['REMOTE_ADDR'], bl_date(), bl_date()+($PHPINCE_system["ban"]["time"] * 60), "SYSTEM", "Login protect system", "login"), $PHPince_logon["login"]);
										bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_ban_login WHERE ip = ?", array(bl_hash($_SERVER['REMOTE_ADDR'])), $PHPince_logon["login"]);
									} else {
										if($PHPINCE_LOGIN_ban_login->rowCount()==0){
											bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_ban_login (ip, denyes) VALUES (?, ?)", array(bl_hash($_SERVER['REMOTE_ADDR']), 1), $PHPince_logon["login"]);
										} else {
											bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_ban_login SET denyes = ? WHERE ip = ?", array(($PHPINCE_LOGIN_ban_login_fetch["denyes"]+1),bl_hash($_SERVER['REMOTE_ADDR'])), $PHPince_logon["login"]);
										}
									}
								}
							} else {
								echo "<div id=\"phpince_error\">".$PHPINCE_LANG[103]."</div>";
							}
						}
					}
				}
				echo "<form method=\"post\" action=\"\"><div id=\"container\" style=\"margin-top:8%;\">
						<div id=\"content\">
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[105]."</h2>
								<input name=\"phpinceacc\" type=\"text\" value=\"\" />
							</div>
							<div class=\"input\">
								<h2>".$PHPINCE_LANG[106]."</h2>
								<input name=\"phpincepass\" type=\"password\" value=\"\" />
								<a href=\"/panel/password\">".$PHPINCE_LANG[108]."</a>
							</div>
							<div id=\"action\">
								<input type=\"submit\" value=\"".$PHPINCE_LANG[104]."\" />";
								if($PHPINCE_system["reg"]==1){
									echo "<a href=\"/panel/reg\">".$PHPINCE_LANG[107]."</a>";
								}
							echo "</div>
							<div id=\"footer\">
								".$PHPINCE_LANG[1]." <a target=\"_blank\" href=\"http://phpince.com\">PHPince - ".$PHPINCE_LANG[2]."</a>
							</div>
						</div>
					</div></form>
				</body></html>";
			break;
			default:
				bl_redirect("/panel/login");
		}
	}
} else {
	if(bl_logincheck($PHPince_logon)){
		$PHPINCE_user = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ? LIMIT 1", array($_COOKIE["phpinceacc"]), $PHPince_logon["login"])->fetch();
		$PHPINCE_perms = bl_getperms($PHPINCE_user, $PHPince_logon);
	}
	if(($PHPINCE_system["construction"]==1)&&(empty($PHPINCE_perms["construction"]))){
		header('HTTP/1.0 404 Not Found');
		echo bl_replace(array("{PHPINCE_ERROR_TITLE}","{PHPINCE_ERROR_H1}","{PHPINCE_ERROR_TEXT}"),array($PHPINCE_system["title"]." &#8250; ".$PHPINCE_LANG[203], $PHPINCE_LANG[203],$PHPINCE_LANG[204]),bl_fread("phpince-panel/phpince-data/core/error.html"));
	} else {
		if((!empty($_GET["rss"]))&&($_GET["rss"]=="1")){
			header("Content-type: application/rss+xml");
			echo "<?xml version=\"1.0\" encoding=\"".$PHPINCE_system["charset"]."\"?>\n";
			echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
			echo "<channel>\n";
			echo "<atom:link href=\"http://".$_SERVER["SERVER_NAME"]."/rss.xml\" rel=\"self\" type=\"application/rss+xml\" />\n";
			echo "<title>".$PHPINCE_system["title"]."</title>\n";
			echo "<link>http://".$_SERVER["SERVER_NAME"]."</link>\n";
			echo "<description>".$PHPINCE_system["desc"]."</description>\n";
			echo "<lastBuildDate>".date("D, d M Y H:i:s O")."</lastBuildDate>\n";
			if((!empty($_GET["cat"]))&&(is_numeric($_GET["cat"]))){
				$PHPINCE_RSS_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news WHERE ncat = ? ORDER BY id DESC LIMIT 10", array($_GET["cat"]), $PHPince_logon["login"]);
			} else {
				$PHPINCE_RSS_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news ORDER BY id DESC LIMIT 10", array(), $PHPince_logon["login"]);
			}
			while ($PHPINCE_RSS_V = $PHPINCE_RSS_query->fetch()) {
				echo "<item>\n";
				echo "<title>".$PHPINCE_RSS_V["title"]."</title>\n";
				echo "<link>http://".$_SERVER["SERVER_NAME"]."/topic/".$PHPINCE_RSS_V["id"]."</link>\n";
				echo "<guid>http://".$_SERVER["SERVER_NAME"]."/topic/".$PHPINCE_RSS_V["id"]."</guid>\n";
				echo "<pubDate>".date("D, d M Y H:i:s", $PHPINCE_RSS_V["created"])." +0000</pubDate>\n";
				echo "<description>".bl_cleanString(strip_tags($PHPINCE_RSS_V["content"]))."</description>\n";
				echo "</item>\n";
			}
			echo "</channel>\n";
			echo "</rss>";
		} else if((!empty($_GET["sitemap"]))&&($_GET["sitemap"]=="1")){
			header("Content-type: text/xml");
			echo "<?xml version=\"1.0\" encoding=\"".$PHPINCE_system["charset"]."\"?>\n";
			echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
			echo "<url>\n";
			echo "<loc>http://".$_SERVER["SERVER_NAME"]."</loc>\n";
			echo "<changefreq>weekly</changefreq>\n";
			echo "<priority>0.8</priority>\n";
			echo "</url>\n";
			$PHPINCE_SITEMAP_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_pages ORDER BY id DESC", array(), $PHPince_logon["login"]);
			while ($PHPINCE_SITEMAP_V = $PHPINCE_SITEMAP_query->fetch()) {
				echo "<url>\n";
				echo "<loc>http://".$_SERVER["SERVER_NAME"]."/page/".$PHPINCE_SITEMAP_V["id"]."</loc>\n";
				echo "<lastmod>".date("c", $PHPINCE_SITEMAP_V["edited"])."</lastmod>\n";
				echo "<changefreq>weekly</changefreq>\n";
				echo "<priority>0.5</priority>\n";
				echo "</url>\n";
			}
			$PHPINCE_SITEMAP_query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news ORDER BY id DESC", array(), $PHPince_logon["login"]);
			while ($PHPINCE_SITEMAP_V = $PHPINCE_SITEMAP_query->fetch()) {
				echo "<url>\n";
				echo "<loc>http://".$_SERVER["SERVER_NAME"]."/topic/".$PHPINCE_SITEMAP_V["id"]."</loc>\n";
				echo "<lastmod>".date("c", $PHPINCE_SITEMAP_V["edited"])."</lastmod>\n";
				echo "<changefreq>weekly</changefreq>\n";
				echo "<priority>0.5</priority>\n";
				echo "</url>\n";
			}
			echo "</urlset>";
		} else {
			require("phpince-panel/phpince-style/".$PHPINCE_system["style"]."/template.phpince.php");
		}
	}
}
ob_end_flush();
?>