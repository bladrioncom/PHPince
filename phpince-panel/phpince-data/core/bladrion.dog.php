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
if($_POST["loader"]=="okloader"){
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
	$PHPINCE_system = bl_system($PHPince_logon);
	if($PHPINCE_system["stopspam"]){
		if(bl_stopspam($PHPINCE_system)){
			exit;
		}
	}
	$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_analytics WHERE set_time >= ? AND session = ?", array(mktime('00','00','01',date('m'),date('d'),date('Y')), bl_hash($_SERVER['REMOTE_ADDR'])), $PHPince_logon["login"]);
	$PHPINCE_an = bl_inteldoc($PHPINCE_system);
	if($PHPINCE_pew->rowCount()==0){
		bl_query("INSERT INTO `".$PHPince_logon["prefix"]."phpince_analytics` (`session`, `set_browser`, `set_browser_version`, `set_os`, `set_locate`, `set_locate_code`, `set_time`, `set_bot`, `set_bot_name`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", array(bl_hash($_SERVER['REMOTE_ADDR']), $PHPINCE_an["browser"], $PHPINCE_an["browser_version"], $PHPINCE_an["os"], $PHPINCE_an["location_name"], $PHPINCE_an["location_code"], bl_date(), $PHPINCE_an["bot"], $PHPINCE_an["bot_name"]), $PHPince_logon["login"]);
	}
	if(!empty($_POST["referer"])){
		preg_match('@^(?:http://)?([^/]+)@i', $_POST["referer"], $ref_domain);
		preg_match('/[^.]+.[^.]+.[^.]+[^.]+\.[^.]+$/', $ref_domain[1], $ref_domain);
		$ref_domain = preg_replace('/^www\./', '', $ref_domain[0]);
		$ref_localhost = preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']);
		$ref_domain_url = preg_replace('/^www\./', '', $_POST["referer"]);
		if(($ref_domain==$ref_localhost)||(empty($ref_domain))){
			$ref_domain = "";
			$ref_domain_url = "";
		}
		if(!empty($ref_domain)){
			$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_analytics_ref WHERE set_url = ?", array($ref_domain_url), $PHPince_logon["login"]);
			if($PHPINCE_pew->rowCount()==0){
				bl_query("INSERT INTO `".$PHPince_logon["prefix"]."phpince_analytics_ref`(`set_domain`, `set_url`, `clicks`) VALUES (?, ?, ?)", array($ref_domain, $ref_domain_url, 1), $PHPince_logon["login"]);
			} else {
				bl_query("UPDATE `".$PHPince_logon["prefix"]."phpince_analytics_ref` SET `clicks`= `clicks` + 1 WHERE `set_url` = ?", array($ref_domain_url), $PHPince_logon["login"]);
			}
		}
	}
}
?>