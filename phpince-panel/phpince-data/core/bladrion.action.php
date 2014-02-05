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
require "bladrion.unisc.php";
if(!file_exists("../config/phpince.connect.php")) {
	exit;
}
require "../config/phpince.connect.php";
$PHPince_logon = bl_connect($PHPINCE_config, "mysql");
$PHPINCE_config = false;
if(!$PHPince_logon["active"]){
	exit;
}
require "../config/phpince.version.php";
require "phpince.lang.php";
$PHPINCE_system = bl_system($PHPince_logon);
if($PHPINCE_LANG[$PHPINCE_system["language"]]){
	$PHPINCE_LANG_AC = $PHPINCE_LANG[$PHPINCE_system["language"]];
} else {
	$PHPINCE_LANG_AC = array();
}
$PHPINCE_LANG = $PHPINCE_LANG_AC + $PHPINCE_LANG["English"];
if(bl_logincheck($PHPince_logon)){
	$PHPINCE_user = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ? LIMIT 1", array($_COOKIE["phpinceacc"]), $PHPince_logon["login"])->fetch();
	$PHPINCE_perms = bl_getperms($PHPINCE_user, $PHPince_logon);
	switch($_GET["f"]){
		case "filedelete":
			if($PHPINCE_perms["files"]){
				if (file_exists("../../phpince-upload/".$_GET["value"])) {
					unlink("../../phpince-upload/".$_GET["value"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_807} ".bl_filecut($_GET["value"])), $PHPince_logon["login"]);
				}
			}
		break;
		case "nav":
			if($PHPINCE_perms["nav"]){
				parse_str($_POST['pages'], $pageOrder);
				foreach ($pageOrder['page'] as $key => $value) {
					bl_query("UPDATE ".$PHPince_logon["prefix"]."phpince_nav_item SET position = ? WHERE id = ?", array($key, $value), $PHPince_logon["login"]);
				}
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_910}"), $PHPince_logon["login"]);
			}
		break;
		case "navdel":
			if(($PHPINCE_perms["nav"])&&(is_numeric($_GET["value"]))){
				bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_nav_item WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_911} #".$_GET["value"]), $PHPince_logon["login"]);
			}
		break;
		case "navxdel":
			if(($PHPINCE_perms["nav"])&&(is_numeric($_GET["value"]))){
				bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_nav WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_nav_item WHERE nav = ?", array($_GET["value"]), $PHPince_logon["login"]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_912} ".$_GET["value"]), $PHPince_logon["login"]);
			}
		break;
		case "navadd":
			if($PHPINCE_perms["nav"]){
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_nav (id) VALUES (?)", array("NULL"), $PHPince_logon["login"]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_913}"), $PHPince_logon["login"]);
			}
		break;
		case "unban":
			if(($PHPINCE_perms["nav"])&&(preg_match("^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}^", $_GET["value"]))){
				bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_ban WHERE ip = ?", array($_GET["value"]), $PHPince_logon["login"]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1212} ".$_GET["value"]), $PHPince_logon["login"]);
			}
		break;
		case "userdel":
			if(($PHPINCE_perms["users"])&&(is_numeric($_GET["value"]))){
				$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				$PHPINCE_pewf = $PHPINCE_pew->fetch();
				if(($PHPINCE_pewf["userlevel"]<=$PHPINCE_user["userlevel"])&&(!($PHPINCE_pewf["id"]==$PHPINCE_user["id"]))){
					bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1212} ".$_GET["value"]), $PHPince_logon["login"]);
				}
			}
		break;
		case "pagedel":
			if(($PHPINCE_perms["pages"])&&(is_numeric($_GET["value"]))){
				$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_pages WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				if($PHPINCE_pew->rowCount()==1){
					$PHPINCE_pewf = $PHPINCE_pew->fetch();
					if(($PHPINCE_perms["pagesall"])||($PHPINCE_user["id"]==$PHPINCE_pewf["autor"])){
						bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_pages WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
						bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1409} ".$PHPINCE_pewf["title"]), $PHPince_logon["login"]);
					}
				}
			}
		break;
		case "newsdel":
			if(($PHPINCE_perms["news"])&&(is_numeric($_GET["value"]))){
				$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				if($PHPINCE_pew->rowCount()==1){
					$PHPINCE_pewf = $PHPINCE_pew->fetch();
					if(($PHPINCE_perms["newsall"])||($PHPINCE_user["id"]==$PHPINCE_pewf["autor"])){
						bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_news WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
						bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1509} ".$PHPINCE_pewf["title"]), $PHPince_logon["login"]);
					}
				}
			}
		break;
		case "cnewsdel":
			if(($PHPINCE_perms["newscat"])&&(is_numeric($_GET["value"]))){
				$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				if($PHPINCE_pew->rowCount()==1){
					$PHPINCE_pewf = $PHPINCE_pew->fetch();
					bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_ncat WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
					bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_news` SET `ncat`= ? WHERE ncat = ?", array("0", $_GET["value"]), $PHPince_logon["login"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1516} ".$PHPINCE_pewf["cat"]), $PHPince_logon["login"]);
				}
			}
		break;
		case "sysupdate":
			if($PHPINCE_perms["sysupdate"]){
				function bl_download($url, $path) {
				$newfname = $path;
				$file = fopen ($url, "rb");
				if ($file) {
					$newf = fopen ($newfname, "wb");
					if ($newf)
						while(!feof($file)) {
							fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
						}
					}
					if ($file) {
						fclose($file);
					}
					if ($newf) {
						fclose($newf);
					}
				}
				function bl_rmdir($dir) {
					if (!file_exists($dir)) return true;
					if (!is_dir($dir) || is_link($dir)) return unlink($dir);
						foreach (scandir($dir) as $item) {
							if ($item == '.' || $item == '..') continue;
							if (!bl_rmdir($dir . "/" . $item)) {
								chmod($dir . "/" . $item, 0777);
								if (!bl_rmdir($dir . "/" . $item)) return false;
							};
						}
						return rmdir($dir);
				}
				function recurse_copy($src,$dst) { 
						$dir = opendir($src); 
						@mkdir($dst); 
						while(false !== ( $file = readdir($dir)) ) { 
							if (( $file != '.' ) && ( $file != '..' )) { 
								if ( is_dir($src . '/' . $file) ) { 
									recurse_copy($src . '/' . $file,$dst . '/' . $file); 
								} else { 
									copy($src . '/' . $file,$dst . '/' . $file); 
								} 
							} 
						} 
						closedir($dir); 
					} 
				if(!is_writable("bladrion.action.php")){
					echo "[ERROR]: File is no writeable";
					exit;
				}
				if(!ini_get('allow_url_fopen')) {
					echo "[ERROR]: Download is no available, \"allow_url_fopen\" is disabled in php.ini";
					exit;
				} 
				bl_download("https://github.com/bladrioncom/PHPince/archive/master.zip", "bladrionupdate_file.zip");
				if (file_exists("bladrionupdate_file.zip")) {
					$file = 'bladrionupdate_file.zip';
					$zipArchive = new ZipArchive();
					$result = $zipArchive->open($file);
					if ($result === TRUE) {
						$zipArchive ->extractTo("update");
						$zipArchive ->close();
						unlink($file);
						bl_rmdir("update/PHPince-master/install");
						bl_rmdir("update/PHPince-master/phpince-panel/phpince-style");
						include "update/PHPince-master/update/phpince.run.php";
						bl_rmdir("update/PHPince-master/update/");
						recurse_copy("update/PHPince-master/", "../../../");
						bl_rmdir("update/PHPince-master/");
						bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_28}"), $PHPince_logon["login"]);
					} else {
						echo "[ERROR]: Zip open failed";
					}
				} else {
					echo "[ERROR]: Zip open failed";
				}
			}
		break;
		case "appuninstall":
			if(($PHPINCE_perms["apps"])&&(is_numeric($_GET["value"]))){
				$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_app WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
				if($PHPINCE_pew->rowCount()==1){
					$PHPINCE_pewf = $PHPINCE_pew->fetch();
					bl_query("DELETE FROM ".$PHPince_logon["prefix"]."phpince_app WHERE id = ?", array($_GET["value"]), $PHPince_logon["login"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1602} ".$PHPINCE_pewf["datafiles"]), $PHPince_logon["login"]);
				}
			}
		break;
		case "appinstall":
			if(($PHPINCE_perms["apps"])&&(preg_match("/^[a-zA-Z0-9 _-]+$/", $_GET["value"]))){
				$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_app WHERE datafiles = ?", array($_GET["value"]), $PHPince_logon["login"]);
				if($PHPINCE_pew->rowCount()==0){
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_app (datafiles) VALUES (?)", array($_GET["value"]), $PHPince_logon["login"]);
					bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1603} ".$_GET["value"]), $PHPince_logon["login"]);
				}
			}
		break;
	}
}
?>