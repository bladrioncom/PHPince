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
header("Content-type: text/xml; charset=utf-8");
require "../config/phpince.secured.php";
if($_GET["phpince_secure"]==sha1($PHPINCE_secured["hash"])){
	require "../core/bladrion.unisc.php";
	if(!file_exists("../config/phpince.connect.php")) {
		exit;
	}
	require "../config/phpince.connect.php";
	$PHPince_logon = bl_connect($PHPINCE_config, "mysql");
	$PHPINCE_config = false;
	if(!$PHPince_logon["active"]){
		exit;
	}
	$PHPINCE_system = bl_system($PHPince_logon);
	$PHPINCE_system["error_log"] = "phpince.error_log-".bl_hash($PHPINCE_secured["hash"]).".log";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<phpince>
	<title>".$PHPINCE_system["title"]."</title>
	<charset>".$PHPINCE_system["charset"]."</charset>
	<php>".$PHPINCE_system["php"]."</php>
	<mysql>".$PHPINCE_system["mysql"]."</mysql>
	<version>".$PHPINCE_system["system"]["SYSTEM"].$PHPINCE_system["system"]["SUBVERSION"]."</version>
	<language>".$PHPINCE_system["language"]."</language>
	<bot>".$PHPINCE_system["bot"]."</bot>
	<construction>".$PHPINCE_system["construction"]."</construction>
	<reg>".$PHPINCE_system["reg"]."</reg>
	<version_checker>".$PHPINCE_system["version_checker"]."</version_checker>
	<inteldoc>".$PHPINCE_system["inteldoc"]."</inteldoc>
	<stopspam>".$PHPINCE_system["stopspam"]."</stopspam>
	<cloudflare_malware>".$PHPINCE_system["cloudflare_malware"]."</cloudflare_malware>
	<errorlog>".$PHPINCE_system["error_log"]."</errorlog>
</phpince>";
}
?>