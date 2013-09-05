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
require "../phpince-data/core/bladrion.unisc.php";
if(!file_exists("../phpince-data/config/phpince.connect.php")) {
	exit;
}
require "../phpince-data/config/phpince.connect.php";
$PHPince_logon = bl_connect($PHPINCE_config, "mysql");
$PHPINCE_config = false;
if(!$PHPince_logon["active"]){
	exit;
}
if(bl_logincheck($PHPince_logon)){
	$PHPINCE_user = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ? LIMIT 1", array($_COOKIE["phpinceacc"]), $PHPince_logon["login"])->fetch();
	$PHPINCE_perms = bl_getperms($PHPINCE_user, $PHPince_logon);
	if($PHPINCE_perms["script"]){
		bl_query("OPTIMIZE TABLE `".$PHPince_logon["prefix"]."phpince_acc`, `".$PHPince_logon["prefix"]."phpince_analytics`, `".$PHPince_logon["prefix"]."phpince_analytics_ref`, `".$PHPince_logon["prefix"]."phpince_app`, `".$PHPince_logon["prefix"]."phpince_ban`, `".$PHPince_logon["prefix"]."phpince_ban_login`, `".$PHPince_logon["prefix"]."phpince_hash`, `".$PHPince_logon["prefix"]."phpince_log`, `".$PHPince_logon["prefix"]."phpince_nav`, `".$PHPince_logon["prefix"]."phpince_nav_item`, `".$PHPince_logon["prefix"]."phpince_ncat`, `".$PHPince_logon["prefix"]."phpince_news`, `".$PHPince_logon["prefix"]."phpince_pages`, `".$PHPince_logon["prefix"]."phpince_perms`, `".$PHPince_logon["prefix"]."phpince_resetpass`, `".$PHPince_logon["prefix"]."phpince_style`, `".$PHPince_logon["prefix"]."phpince_system`", array(), $PHPince_logon["login"]);
		bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_1002} Optimilize.php"), $PHPince_logon["login"]);
	}
}
?>