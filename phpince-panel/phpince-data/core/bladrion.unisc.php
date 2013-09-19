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
function bl_connect($connect_array, $type = "mysql"){
	switch ($type) {
		case "mysql":
			try {
				$connecting = new PDO('mysql:host='.$connect_array["ip"].';port='.$connect_array["port"].';dbname='.$connect_array["db"].'', $connect_array["user"], $connect_array["pass"]);
				$active = true;
				$prefix = $connect_array["prefix"];
			} catch (PDOException $e) {
				$connecting = false;
				$active = false;
				$prefix = false;
			}
		break;
	}
	return(array(
		"login" => $connecting,
		"active" => $active,
		"prefix" => $prefix
	));
}
function printr($print){
	echo "<pre>";
	print_r($print);
	echo "</pre>";
}
function bl_system($connect){
	$query = bl_query("SELECT * FROM ".$connect["prefix"]."phpince_system WHERE data = ?", array(1), $connect["login"]);
	$fetch = $query->fetch();
	$mysql_version = $connect["login"]->getAttribute(constant("PDO::ATTR_CLIENT_VERSION"));
	$php_version = substr(phpversion(),0,strpos(phpversion(), '-'));
	if(empty($php_version)){
		$php_version = phpversion();
	}
	require dirname(dirname(__FILE__))."/config/phpince.version.php";
	return(array(
		"title" => $fetch["site_name"],
		"desc" => $fetch["site_desc"],
		"key" => $fetch["site_key"],
		"html" => $fetch["site_html"],
		"charset" => bl_charset($fetch["site_charset"]),
		"php" => $php_version,
		"mysql" => $mysql_version,
		"system" => $PHPINCE_VERSION,
		"style" => $fetch["set_style"],
		"language" => $fetch["set_lp"],
		"bot" => $fetch["set_bot"],
		"construction" => $fetch["set_construction"],
		"editor" => $fetch["set_editor"],
		"editor_fullname" => $PHPINCE_VERSION["EDITOR"][$fetch["set_editor"]],
		"timeformat" => $fetch["set_time"],
		"reg" => $fetch["set_reg"],
		"version_checker" => $fetch["set_version"],
		"inteldoc" => $fetch["set_inteldoc"],
		"stopspam" => $fetch["set_stopspam"],
		"ban" => array(
			"count" => $fetch["set_ban"],
			"time" => $fetch["set_ban_time"],
		),
	));
}
function bl_hash($input){
	require dirname(dirname(__FILE__))."/config/phpince.secured.php";
	return(sha1($input.$PHPINCE_secured["hash"]));
}
function bl_inteldoc($PHPINCE_system){
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$botname = "Noname";
	$version= "";
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'Linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'Mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'Windows';
	}
	if (preg_match('/Android/i', $u_agent)) {
		$platform = 'Android';
	} elseif (preg_match('/BlackBerry/i', $u_agent)) {
		$platform = 'BlackBerry';
	} elseif (preg_match('/iPhone|iPad/i', $u_agent)) {
		$platform = 'iOS';
	} elseif (preg_match('/Symbian|SymbOS/i', $u_agent)) {
		$platform = 'Symbian';
	}
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif(preg_match('/Firefox/i',$u_agent)){
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif(preg_match('/Chrome/i',$u_agent)){
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif(preg_match('/Safari/i',$u_agent)){
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif(preg_match('/Opera/i',$u_agent)){
		$bname = 'Opera';
		$ub = "Opera";
	} elseif(preg_match('/Netscape/i',$u_agent)){
		$bname = 'Netscape';
		$ub = "Netscape";
	}
	$bots = array("spider","bot","crawl","perl","link","retriever","walker","check","curl","archive","slurp");
	foreach ($bots as $i => $bot) {
		if (stripos($u_agent,$bot) !== false){
			$bot_identifi = '1';
		} else {
			$bot_identifi = '0';
		}
	}
	$myip = $_SERVER['REMOTE_ADDR'];
	if((("64.233.160.0"<=$myip)&&("64.233.191.255">=$myip))||(("66.102.0.0"<=$myip)&&("66.102.15.255">=$myip))||(("66.249.64.0"<=$myip)&&("66.249.95.255">=$myip))||(("72.14.192.0"<=$myip)&&("72.14.255.255">=$myip))||(("74.125.0.0"<=$myip)&&("74.125.255.255">=$myip))||(("209.85.128.0"<=$myip)&&("209.85.255.255">=$myip))||(("216.239.32.0"<=$myip)&&("216.239.63.255">=$myip))){
		$botname = "Google";
		$bot_identifi = '1';
	}
	if((("64.4.0.0"<=$myip)&&("64.4.63.255">=$myip))||(("65.52.0.0"<=$myip)&&("65.55.255.255">=$myip))||(("131.253.21.0"<=$myip)&&("131.253.47.255">=$myip))||(("157.54.0.0"<=$myip)&&("157.60.255.255">=$myip))||(("207.46.0.0"<=$myip)&&("207.46.255.255">=$myip))||(("207.68.128.0"<=$myip)&&("207.68.207.255">=$myip))){
		$botname = "Bing";
		$bot_identifi = '1';
	}
	if((("8.12.144.0"<=$myip)&&("8.12.144.255">=$myip))||(("66.196.64.0"<=$myip)&&("66.196.127.255">=$myip))||(("66.228.160.0"<=$myip)&&("66.228.191.255">=$myip))||(("67.195.0.0"<=$myip)&&("67.195.255.255">=$myip))||(("68.142.192.0"<=$myip)&&("68.142.255.255">=$myip))||(("72.30.0.0"<=$myip)&&("72.30.255.255">=$myip))||(("74.6.0.0"<=$myip)&&("74.6.255.255">=$myip))||(("202.160.176.0"<=$myip)&&("202.160.191.255">=$myip))||(("209.191.64.0"<=$myip)&&("209.191.127.255">=$myip))){
		$botname = "Yahoo";
		$bot_identifi = '1';
	}
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
	')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
	}
	$i = count($matches['browser']);
	if ($i != 1) {
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
			$version= $matches['version'][0];
		} else {
			$version= $matches['version'][1];
		}
	} else {
		$version= $matches['version'][0];
	}
	if ($version==null || $version=="") {$version="?";}
	require dirname(dirname(__FILE__))."/core/GeoIP.php";
	$connect = geoip_open(dirname(dirname(__FILE__))."/core/GeoIP.dat", GEOIP_STANDARD);
		$location_name = geoip_country_name_by_addr($connect, $_SERVER['REMOTE_ADDR']);
		$location_code = geoip_country_code_by_addr($connect, $_SERVER['REMOTE_ADDR']);
	if(empty($location_code)){
		$location_code = "Unknown";
	}
	if(empty($location_name)){
		$location_name = "Unknown";
	}
	return array('browser' => $bname, 'browser_version' => $version, 'os' => $platform, 'bot' => $bot_identifi, 'location_code' => $location_code, 'location_name' => $location_name, 'bot_name' => $botname);
}
function bl_stopspam(){
	$stopspam_visitorIP = $_SERVER['REMOTE_ADDR'];
	$stopspam_data = file_get_contents('http://cdn.teamexon.eu/stopspam/api.php?ip='.$stopspam_visitorIP.'');
	$stopspam_find = "yes";
	$stopspam_pos = strpos($stopspam_data, $stopspam_find);
	if ($stopspam_pos === false){
		return(false);	
	} else {
		return(true);
	}
}
function bl_metaheader($array, $special_title = ""){
	if($array["html"]=="HTML 5"){
		echo "<meta charset=\"".$array["charset"]."\">\n";
	} else {
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$array["charset"]."\" />\n";
	}
	if(!empty($special_title)){
		$special_title = " &#8250; ".$special_title;
	}
	echo "<title>".$array["title"].$special_title."</title>\n<meta name=\"description\" content=\"".$array["desc"]."\" />\n<meta name=\"keywords\" content=\"".$array["key"]."\" />\n<link rel=\"alternate\" type=\"application/rss+xml\" title=\"".$array["title"]." - RSS\" href=\"http://".$_SERVER['SERVER_NAME']."/rss.xml\" />\n";
	if($array["bot"]==0){
		echo "<meta name=\"robots\" content=\"noindex, nofollow\" />\n";
	} else {
		echo "<meta name=\"robots\" content=\"index, follow\" />\n";
	}
	if((empty($_GET["phpince-panel"]))&&($array["inteldoc"]==1)){
		echo "<script type=\"text/javascript\">\n (function() {\n var bl_ana = document.createElement('script'); bl_ana.type = 'text/javascript'; bl_ana.async = true;\n bl_ana.src = '/phpince-panel/phpince-data/core/bladrion.dog.js';\n var bl_anas = document.getElementsByTagName('script')[0]; bl_anas.parentNode.insertBefore(bl_ana, bl_anas);\n })();\n</script>\n";
	}
}
function bl_temp_style($style ,$PHPince_logon){
	if((!empty($style))&&(is_numeric($style))){
		$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_style WHERE id = ?", array($style), $PHPince_logon["login"]);
		if($query->rowCount()==1){
			$fetch = $query->fetch();
			return($fetch["styledata"]);
		} else {
			return(false);
		}
	}
}
function bl_temp_nav($value = false, $PHPince_logon){
	if((!empty($value))&&(is_numeric($value))){
		$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_nav_item WHERE nav = ? ORDER BY position ASC", array($value), $PHPince_logon["login"]);
		if($query){
			while ($fetch = $query->fetch()) {
				$special = array();
				if(!empty($fetch["set_id"])){
					$special["id"] = " id=\"".$fetch["set_id"]."\"";
				} else {
					$special["id"] = "";
				}
				if(!empty($fetch["set_class"])){
					$special["class"] = " class=\"".$fetch["set_class"]."\"";
				} else {
					$special["class"] = "";
				}
				if(!empty($fetch["set_target"])){
					$special["target"] = " target=\"".$fetch["set_target"]."\"";
				} else {
					$special["target"] = "";
				}
				echo "<li><a".$special["id"].$special["class"].$special["target"]." href=\"".$fetch["url"]."\">".$fetch["name"]."</a></li>\n";
			}
		}
	}
}
function bl_temp_link($PHPince_system, $type = false){
	if($type=="app"){
		echo "/phpince-panel/phpince-include/".$PHPince_system["style"]."/";
	} else {
		echo "/phpince-panel/phpince-style/".$PHPince_system["style"]."/";
	}
}
function bl_temp_content($array, $PHPince_logon, $PHPINCE_system, $PHPINCE_LANG = false){
	if(empty($_GET["phpince_temp"])){ $_GET["phpince_temp"] = ""; }
	switch ($_GET["phpince_temp"]) {
		case "page":
			if((!empty($_GET["id"]))&&(is_numeric($_GET["id"]))){
			   	if(!empty($array["page_style"])){
					$style5 = $array["page_style"];
				} else {
					$style5 = bl_temp_style(5 ,$PHPince_logon);
				}
				if(!empty($array["page_notfound"])){
					$style6 = $array["page_notfound"];
				} else {
					$style6 = bl_temp_style(6 ,$PHPince_logon);
				}
				$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_pages WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($query->rowCount()==1){
					$autor = array();
					$autor_Q = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc", array(), $PHPince_logon["login"]);
					while ($autor_QV = $autor_Q->fetch()) {
						$autor[$autor_QV["id"]] = $autor_QV["account"];
					}
					$fetch = $query->fetch();
					echo bl_replace(array("{PHPINCE_ID}","{PHPINCE_TITLE}","{PHPINCE_TEXT}","{PHPINCE_AUTOR}","{PHPINCE_DATE}","{PHPINCE_DATE_D}","{PHPINCE_DATE_M}","{PHPINCE_DATE_Y}","{PHPINCE_TIME}","{PHPINCE_TIME_H}","{PHPINCE_TIME_M}"),array($fetch["id"],$fetch["title"],$fetch["content"],$autor[$fetch["autor"]],date("j.n.Y",$fetch["created"]),date("j",$fetch["created"]),date("n",$fetch["created"]),date("Y",$fetch["created"]),bl_date_get($fetch["created"], "g:i a", "G:i", $PHPINCE_system),bl_date_get($fetch["created"], "g", "G", $PHPINCE_system),bl_date_get($fetch["created"], "i a", "i", $PHPINCE_system)),$style5);
				} else {
					echo $style6;
				}
			} else {
				bl_redirect("/");
			}
		break;
		case "topic":
			if((!empty($_GET["id"]))&&(is_numeric($_GET["id"]))){
			   	if(!empty($array["topic_style_active"])){
					$style2 = $array["topic_style_active"];
				} else {
					$style2 = bl_temp_style(2 ,$PHPince_logon);
				}
				if(!empty($array["topic_notfound"])){
					$style3 = $array["topic_notfound"];
				} else {
					$style3 = bl_temp_style(3 ,$PHPince_logon);
				}
				$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($query->rowCount()==1){
					$autor = array();
					$autor_Q = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc", array(), $PHPince_logon["login"]);
					while ($autor_QV = $autor_Q->fetch()) {
						$autor[$autor_QV["id"]] = $autor_QV["account"];
					}
					$cat = array();
					$cat_Q = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat", array(), $PHPince_logon["login"]);
					while ($cat_QV = $cat_Q->fetch()) {
						$cat[$cat_QV["id"]] = $cat_QV["cat"];
					}
					$fetch = $query->fetch();
					if($fetch["ncat"]=="0"){
						$category = $PHPINCE_LANG[1511];
					} else {
						$category = $cat[$fetch["ncat"]];
					}
					echo bl_replace(array("{PHPINCE_ID}","{PHPINCE_TITLE}","{PHPINCE_TEXT}","{PHPINCE_AUTOR}","{PHPINCE_DATE}","{PHPINCE_DATE_D}","{PHPINCE_DATE_M}","{PHPINCE_DATE_Y}","{PHPINCE_TIME}","{PHPINCE_TIME_H}","{PHPINCE_TIME_M}","{PHPINCE_CAT}"),array($fetch["id"],$fetch["title"],$fetch["content"],$autor[$fetch["autor"]],date("j.n.Y",$fetch["created"]),date("j",$fetch["created"]),date("n",$fetch["created"]),date("Y",$fetch["created"]),bl_date_get($fetch["created"], "g:i a", "G:i", $PHPINCE_system),bl_date_get($fetch["created"], "g", "G", $PHPINCE_system),bl_date_get($fetch["created"], "i a", "i", $PHPINCE_system),$category),$style2);
				} else {
					echo $style3;
				}
			} else {
				bl_redirect("/");
			}
		break;
		case "app":
			if((!empty($_GET["id"]))&&(is_numeric($_GET["id"]))){
				if(bl_logincheck($PHPince_logon)){
					$PHPINCE_user = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc WHERE id = ? LIMIT 1", array($_COOKIE["phpinceacc"]), $PHPince_logon["login"])->fetch();
				}
				if(!empty($array["plugin_notfound"])){
					$style7 = $array["plugin_notfound"];
				} else {
					$style7 = bl_temp_style(7 ,$PHPince_logon);
				}
				$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_app WHERE id = ?", array($_GET["id"]), $PHPince_logon["login"]);
				if($query->rowCount()==1){
					$fetch = $query->fetch();
					if(file_exists("phpince-panel/phpince-include/".$fetch["datafiles"]."/index.php")){
					require "phpince-panel/phpince-include/".$fetch["datafiles"]."/index.php";
					} else {
						echo $style7;
					}
				} else {
					echo $style7;
				}
			} else {
				bl_redirect("/");
			}
		break;
		default:
			if((!empty($array["topic_limit"]))&&(is_numeric($array["topic_limit"]))){
				$array["topic_limit"] = $array["topic_limit"];
			} else {
				$array["topic_limit"] = false;
			}
			if(!empty($array["topic_style"])){
				$style1 = $array["topic_style"];
			} else {
				$style1 = bl_temp_style(1 ,$PHPince_logon);
			}
			if(!empty($array["topic_error"])){
				$style4 = $array["topic_error"];
			} else {
				$style4 = bl_temp_style(4 ,$PHPince_logon);
			}
			if(!empty($_GET["topic_cat"])){
				$array["topic_cat"] = $_GET["topic_cat"];
			}
			if((!empty($array["topic_cat"]))&&(is_numeric($array["topic_cat"]))){
				if((!empty($array["topic_limit"]))&&(is_numeric($array["topic_limit"]))){
					$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news WHERE ncat = ? ORDER BY id DESC LIMIT ".$array["topic_limit"], array($array["topic_cat"]), $PHPince_logon["login"]);
				} else {
					$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news WHERE ncat = ? ORDER BY id DESC", array($array["topic_cat"]), $PHPince_logon["login"]);
				}
			} else {
				if((!empty($array["topic_limit"]))&&(is_numeric($array["topic_limit"]))){
					$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news ORDER BY id DESC LIMIT ".$array["topic_limit"], array(), $PHPince_logon["login"]);
				} else {
					$query = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_news ORDER BY id DESC", array(), $PHPince_logon["login"]);
				}
			}
			if($query->rowCount()>0){
				$autor = array();
				$autor_Q = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_acc", array(), $PHPince_logon["login"]);
				while ($autor_QV = $autor_Q->fetch()) {
					$autor[$autor_QV["id"]] = $autor_QV["account"];
				}
				$cat = array();
				$cat_Q = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_ncat", array(), $PHPince_logon["login"]);
				while ($cat_QV = $cat_Q->fetch()) {
					$cat[$cat_QV["id"]] = $cat_QV["cat"];
				}
				while ($fetch = $query->fetch()) {
					if($fetch["ncat"]=="0"){
						$category = $PHPINCE_LANG[1511];
					} else {
						$category = $cat[$fetch["ncat"]];
					}
					echo bl_replace(array("{PHPINCE_ID}","{PHPINCE_TITLE}","{PHPINCE_TEXT}","{PHPINCE_AUTOR}","{PHPINCE_DATE}","{PHPINCE_DATE_D}","{PHPINCE_DATE_M}","{PHPINCE_DATE_Y}","{PHPINCE_TIME}","{PHPINCE_TIME_H}","{PHPINCE_TIME_M}","{PHPINCE_CAT}"),array($fetch["id"],$fetch["title"],$fetch["content"],$autor[$fetch["autor"]],date("j.n.Y",$fetch["created"]),date("j",$fetch["created"]),date("n",$fetch["created"]),date("Y",$fetch["created"]),bl_date_get($fetch["created"], "g:i a", "G:i", $PHPINCE_system),bl_date_get($fetch["created"], "g", "G", $PHPINCE_system),bl_date_get($fetch["created"], "i a", "i", $PHPINCE_system),$category),$style1);
				}
			} else {
				echo $style4;
			}
	}
}
function bl_index(){
	if((empty($_GET["phpince_temp"]))&&(empty($_GET["topic_cat"]))){
		return(true);
	} else {
		return(false);
	}
}
function bl_getsystemplugin($name){
	return "phpince-panel/phpince-data/core/func/".$name.".phpince.php";
}
function bl_checkban($connect){
	$query = bl_query("SELECT * FROM ".$connect["prefix"]."phpince_ban WHERE ip = ?", array($_SERVER['REMOTE_ADDR']), $connect["login"]);
	if($query->rowCount()==1){
		$fetch = $query->fetch();
		if(($fetch["bantime"] > bl_date())||($fetch["perma"]==1)){
			$active = 1;
		} else {
			$active = 0;
		}
		return(array(
			"active" => $active,
			"time" => $fetch["bantime"],
			"created" => $fetch["created"],
			"perma" => $fetch["perma"],
			"autor" => $fetch["autor"],
			"msg" => $fetch["msg"],
			"type" => $fetch["bantype"]
		));
	} else {
		return(array(
			"active" => 0
		));
	}
}
function bl_mysqlsize($connect){
	$query = bl_query("SHOW TABLE STATUS", array(), $connect["login"]);
	$count = 0;
	while ($fetch = $query->fetch()) {
		if(preg_match("/".$connect["prefix"]."/i", $fetch["Name"])){
			$count += $fetch["Data_length"] + $fetch["Index_length"];
		}
	}
	return(bl_filesize($count));
}
function bl_getperms($PHPINCE_user, $connect){
	$query = bl_query("SELECT * FROM ".$connect["prefix"]."phpince_perms WHERE userlevel <= ?", array($PHPINCE_user["userlevel"]), $connect["login"]);
	while ($fetch = $query->fetch()) {
		$array[$fetch["perms"]] = 1;
	}
	return($array);
}
function bl_getrankname($rank, $lang){
	switch($rank){
		case 0: return($lang[400]); break;
		case 1: return($lang[401]); break;
		case 2: return($lang[402]); break;
		case 3: return($lang[403]); break;
		case 4: return($lang[404]); break;
		case 5: return($lang[405]); break;
		case 6: return($lang[406]); break;
		case 7: return($lang[407]); break;
		case 8: return($lang[408]); break;
		case 9: return($lang[409]); break;
		case 10: return($lang[410]); break;
	}
}
function bl_logincheck($connect){
	if((!empty($_COOKIE["phpinceacc"]))&&(!empty($_COOKIE["phpincehash"]))&&(!preg_match("/[^0-9]/", $_COOKIE["phpinceacc"]))&&(!preg_match("/[^a-zA-Z0-9]/", $_COOKIE["phpincehash"]))){
		$query = bl_query("SELECT * FROM ".$connect["prefix"]."phpince_hash WHERE account = ? AND hash = ?", array($_COOKIE["phpinceacc"], $_COOKIE["phpincehash"]), $connect["login"]);
		if($query->rowCount()==1){
			return(true);
		} else {
			return(false);
		}
	} else {
		return(false);
	}
}
function bl_charset($input, $print = false){
	$array = array(
		'UTF-8 (Unicode)' => 'utf-8',
		'ISO-8859-1 (Western)' => 'iso-8859-1',
		'ISO-8859-2 (Central European)' => 'iso-8859-2',
		'ISO-8859-3 (Southern European)' => 'iso-8859-3',
		'ISO-8859-4 (Baltic)' => 'iso-8859-4',
		'ISO-8859-5 (Cyrillic)' => 'iso-8859-5',
		'ISO-8859-6 (Arabic)' => 'iso-8859-6',
		'ISO-8859-7 (Greek)' => 'iso-8859-7',
		'ISO-8859-8 (Hebrew)' => 'iso-8859-8',
		'ISO-8859-9 (Turkish)' => 'iso-8859-9',
		'ISO-8859-10 (Turkish)' => 'iso-8859-10',
		'ISO-8859-11 (Thai)' => 'iso-8859-11',
		'ISO-8859-13 (Baltic + Polish)' => 'iso-8859-13',
		'ISO-8859-14 (Celtic)' => 'iso-8859-14',
		'ISO-8859-15 (Western)' => 'iso-8859-15',
		'ISO-8859-16 (Central European)' => 'iso-8859-16',
		'Windows-1250 (Central European)' => 'cp1250',
		'Windows-1251 (Cyrillic)' => 'cp1251',
		'Windows-1252 (Western)' => 'cp1252',
		'Windows-1253 (Greek)' => 'cp1253',
		'Windows-1254 (Turkish)' => 'cp1254',
		'Windows-1255 (Hebrew)' => 'cp1255',
		'Windows-1256 (Arabic)' => 'cp1256',
		'Windows-1257 (baltic)' => 'cp1257',
		'Windows-1258 (Vietnamese)' => 'cp1258'
	);
	if($print==true){
		return($array);
	} else {
		return($array[$input]);
	}
}
function bl_query($query, $array, $connect){
	$query = $connect->prepare($query);
	/*for ($i = 0; $i < count($array); $i++) {
		$query->bindParam(($i+1), $aray[$i]);
	}*/
	$i = 1;
	foreach($array as $value){
		$query->bindParam($i, $value);
		$i++;
	}
	$query->execute($array);
	return($query);
}
function bl_replace($who_array, $replacement_array, $data_content){
	return(str_replace($who_array, $replacement_array, $data_content));
}
function bl_fread($filename){
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	return($contents);
	fclose($handle);
}
function bl_slay($value){
	$patterns = array('/\'/','/\"/');
	$replacements = array("&rsquo;","&quot;");
	return(stripslashes(preg_replace($patterns, $replacements, $value)));
}
function bl_get_templates(){
	$array = array();
	$open = @opendir("phpince-panel/phpince-style") or die("Error");
	while ($read = readdir($open)) {
		if($read != '.' && $read != '..'){
			if(file_exists("phpince-panel/phpince-style/".$read."/template.phpince.php")){
				$array[] = $read;
			}
		}
	}
	return($array);
	closedir($open);
}
function bl_redirect($url, $time = 0, $extra = false){
	if($time==0){
		echo "<script type=\"text/javascript\">";
		echo "window.location = \"".$url."\"";
		echo "</script>";
	} else {
		if($extra){
		echo "<script type=\"text/javascript\">
var curTime = ".time().";
var endTime = ".time()." + ".($time-1).";
function tick(){
var secs = endTime - curTime;
	if(secs<0){
		window.location = \"".$url."\"
	} else {
		document.getElementById(\"phpince_ticker_data\").innerHTML = secs + \" s\";
	
	}
++curTime;
}
setInterval(tick,1000); tick();
</script>";
			echo "<span id=\"phpince_ticker\">".$extra[13]." <span id=\"phpince_ticker_data\">".$time." s</span></span>";
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"".$time.";url=".$url."\" /> ";
		}
	}
}
function bl_reload($time = 0){
	echo "<meta http-equiv=\"refresh\" content=\"".$time."\">";
}
function bl_filesize($bytes, $precision = 2){  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}
function bl_getpr(){
	if(ini_get('allow_url_fopen')){
		class bl_PR {
			public function bl_get_google_pagerank($url) {
				$query="http://toolbarqueries.google.com/tbr?client=navclient-auto&ch=".$this->bl_CheckHash($this->bl_HashURL($url)). "&features=Rank&q=info:".$url."&num=100&filter=0";
				$data=file_get_contents($query);
				$pos = strpos($data, "Rank_");
				if($pos === false){} else{
					$pagerank = substr($data, $pos + 9);
					return $pagerank;
				}
			}
			public function bl_StrToNum($Str, $Check, $Magic){
				$Int32Unit = 4294967296; // 2^32
				$length = strlen($Str);
				for ($i = 0; $i < $length; $i++) {
					$Check *= $Magic;
					if ($Check >= $Int32Unit) {
						$Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
						$Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
					}
					$Check += ord($Str{$i});
				}
				return $Check;
			}
			public function bl_HashURL($String){
				$Check1 = $this->bl_StrToNum($String, 0x1505, 0x21);
				$Check2 = $this->bl_StrToNum($String, 0, 0x1003F);
				$Check1 >>= 2;
				$Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
				$Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
				$Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);
				$T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
				$T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );
				return ($T1 | $T2);
			}
			public function bl_CheckHash($Hashnum){
				$CheckByte = 0;
				$Flag = 0;
				$HashStr = sprintf('%u', $Hashnum) ;
				$length = strlen($HashStr);
				for ($i = $length - 1; $i >= 0; $i --) {
					$Re = $HashStr{$i};
					if (1 === ($Flag % 2)) {
						$Re += $Re;
						$Re = (int)($Re / 10) + ($Re % 10);
					}
					$CheckByte += $Re;
					$Flag ++;
				}
				$CheckByte %= 10;
				if (0 !== $CheckByte) {
					$CheckByte = 10 - $CheckByte;
					if (1 === ($Flag % 2) ) {
						if (1 === ($CheckByte % 2)) {
							$CheckByte += 9;
						}
						$CheckByte >>= 1;
					}
				}
				return '7'.$CheckByte.$HashStr;
			}
		}
		$url = "http://".preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']);
		$pr = new bl_PR();
		$rank = $pr->bl_get_google_pagerank($url);
		if($rank){
			return $rank."/ 10";
		} else {
			return "0 / 10";
		}
	} else {
		return "?? / 10";
	}
}
function bl_date(){
	return(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
}
function bl_date_get($unix, $type12, $type24, $PHPINCE_system){
	switch($PHPINCE_system["timeformat"]){
		case 12:
			return(date($type12, $unix));
		break;
		case 24:
			return(date($type24, $unix));
		break;
	}
}
function bl_statics_gous($PHPINCE_analytics, $mktime){
	$number = 0;
	for ($i = 0; $i < count($PHPINCE_analytics); $i++) {
		if(($PHPINCE_analytics[$i]["time"]>=$mktime)&&($PHPINCE_analytics[$i]["bot"]=="0")){
			$number++;
		}
	}
	return($number);
}
function bl_statics_gsys($type, $PHPINCE_analytics){
	$PHPINCE_analytics_stats = array();
	for ($i = 0; $i < count($PHPINCE_analytics); $i++) {
		if($PHPINCE_analytics[$i]["bot"]=="0"){
			$PHPINCE_analytics_stats[] = $PHPINCE_analytics[$i][$type];
			if($PHPINCE_analytics[$i]["time"]>=mktime('00','00','01',date('m'),date('d'),date('Y'))){
				$PHPINCE_analytics_stats_now[] = $PHPINCE_analytics[$i][$type];
			}
		}
	}
	$PHPINCE_analytics_stats_print["name"] = array_keys(array_count_values($PHPINCE_analytics_stats));
	$PHPINCE_analytics_stats_print["count"] = array_values(array_count_values($PHPINCE_analytics_stats));
	$PHPINCE_analytics_stats_print["count_now"] = array_values(array_count_values($PHPINCE_analytics_stats_now));
	$PHPINCE_analytics_stats_print["count_now_all"] = array_sum($PHPINCE_analytics_stats_print["count_now"]);
	$PHPINCE_analytics_stats_print["count_all"] = array_sum($PHPINCE_analytics_stats_print["count"]);
	return($PHPINCE_analytics_stats_print);
}
function bl_statics_gbot($PHPINCE_analytics){
	$PHPINCE_analytics_stats = array();
	for ($i = 0; $i < count($PHPINCE_analytics); $i++) {
		if($PHPINCE_analytics[$i]["bot"]=="1"){
			$PHPINCE_analytics_stats[] = $PHPINCE_analytics[$i]["bot_name"];
			if($PHPINCE_analytics[$i]["time"]>=mktime('00','00','01',date('m'),date('d'),date('Y'))){
				$PHPINCE_analytics_stats_now[] = $PHPINCE_analytics[$i]["bot_name"];
			}
		}
	}
	$PHPINCE_analytics_stats_print["name"] = array_keys(array_count_values($PHPINCE_analytics_stats));
	$PHPINCE_analytics_stats_print["count"] = array_values(array_count_values($PHPINCE_analytics_stats));
	$PHPINCE_analytics_stats_print["count_now"] = array_values(array_count_values($PHPINCE_analytics_stats_now));
	$PHPINCE_analytics_stats_print["count_now_all"] = array_sum($PHPINCE_analytics_stats_print["count_now"]);
	$PHPINCE_analytics_stats_print["count_all"] = array_sum($PHPINCE_analytics_stats_print["count"]);
	return($PHPINCE_analytics_stats_print);
}
function bl_statics_gbot_count($type, $PHPINCE_analytics){
	$PHPINCE_analytics_stats = array();
 	for ($i = 0; $i < count($PHPINCE_analytics); $i++) {
		if($PHPINCE_analytics[$i]["bot"]==$type){
			$PHPINCE_analytics_stats[] = $PHPINCE_analytics[$i]["bot"];
 		}
 	}
	return(count($PHPINCE_analytics_stats));
}
function bl_randtext($number){
	$characters = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
	$printed = $characters[rand(0,count($characters))].$characters[rand(0,count($characters))].$characters[rand(0,count($characters))].$characters[rand(0,count($characters))].$characters[rand(0,count($characters))];
	return(substr(sha1($printed), 0, $number));
}
function bl_mail($subject,$message,$to,$from){
	$domain = preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']);
	$headers = "Content-type: text/html; charset=utf-8" . "\r\n" . "From: noreply@".$domain."" . "\r\n" . "Reply-To: noreply@".$domain."" . "\r\n" . "X-Mailer: Bladrion Sender";
	mail($to, $subject, $message, $headers);
}
function bl_dir_size($path){
    $total_size = 0;
    $files = scandir($path);
    foreach($files as $t) {
        if (is_dir(rtrim($path, '/') . '/' . $t)) {
            if ($t<>"." && $t<>"..") {
                $size = bl_dir_size(rtrim($path, '/') . '/' . $t);
                $total_size += $size;
            }
        } else {
            $size = filesize(rtrim($path, '/') . '/' . $t);
            $total_size += $size;
        }   
    }
    return $total_size;
}
function bl_dir_files($dir){
    $counter = 0;
    if ($handle = opendir($dir)) {
      while (false !== ($file = readdir($handle))) {
		  if($file != '..'){
          	$counter++;
		  }
      }
      closedir($handle);
    }
    $counter -= 1;
    return $counter;
}
function bl_file_prefix($file_name, $switcher){
	$length_of_filename = strlen($file_name);
	$last_char = substr($file_name, $length_of_filename - 1, 1);
	for($i_parse_name = 0; $i_parse_name < $length_of_filename; $i_parse_name++){
		$last_char = substr($file_name, $length_of_filename - $i_parse_name + 2, 1);
		if($last_char == "."){
			$filename_suffix = substr($file_name, $length_of_filename - $i_parse_name + 2, $i_parse_name);
			$filename_prefix = substr($file_name, 0, $length_of_filename - strlen($filename_suffix));
			$i_parse_name = $length_of_filename;
		}
	}   
	switch($switcher){
		case "prefix":
			return($filename_prefix);
		break;
		case "suffix":
			return($filename_suffix);
		break;
	}
}
function bl_filecut($file){
if (strlen($file) > 20){
	$vartypesf = strrchr($file,".");
	$vartypesf_len = strlen($vartypesf);
	$word_l_w = substr($file,0,13);
	$word_r_w = substr($file,-13);
	$word_r_a = substr($word_r_w,0,-$vartypesf_len);
	return $word_l_w."...".$word_r_a.$vartypesf;
	} else {
	return $file;
	}
}
function bl_sysversion($PHPINCE_system, $let = false){
	if(ini_get('allow_url_fopen')){
		$open = fopen("http://phpince.com/server/admin/phpince_version.txt", "rb");
		$get = stream_get_contents($open);
		if($let==true){
			return($get);
		} else {
			if(str_replace(".", "", $PHPINCE_system["system"]["SYSTEM"])==str_replace(".", "", $get)){
				return(true);
			} else {
				return(false);
			}
		}
		fclose($open);
	} else {
		return(true);
	}
}
function bl_run_editor($PHPINCE_system, $PHPINCE_LANG){
	if(empty($PHPINCE_LANG[29])){
		$PHPINCE_LANG[29] = "en";
	}
	switch($PHPINCE_system["editor"]){
		case "tinymce":
			echo "<script src=\"/phpince-panel/phpince-data/editor/tinymce/tinymce.min.js\"></script>
<script type=\"text/javascript\">
tinymce.init({
	language : \"".$PHPINCE_LANG[29]."\",
    selector: \"textarea\",
    theme: \"modern\",
    plugins: [
        \"advlist autolink lists link image charmap print preview hr anchor pagebreak\",
        \"searchreplace wordcount visualblocks visualchars code fullscreen\",
        \"insertdatetime media nonbreaking save table contextmenu directionality\",
        \"template paste textcolor\"
    ],
    toolbar1: \"styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | media link image\",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
});
</script>";
		break;
		case "ckeditor":
			echo "<script src=\"/phpince-panel/phpince-data/editor/ckeditor/ckeditor.js\"></script>";
			echo "<script>CKEDITOR.replace( 'editor', {language: '".$PHPINCE_LANG[29]."'});</script>";
		break;
	}
}
function bl_cleanString($in,$offset=null){
	$out = trim($in);
	if (!empty($out)){
		$entity_start = strpos($out,'&',$offset);
		if ($entity_start === false){
			return $out;   
		} else {
			$entity_end = strpos($out,';',$entity_start);
			if ($entity_end === false){
				 return $out;
			} else if ($entity_end > $entity_start+7){
				 $out = bl_cleanString($out,$entity_start+1);
			} else {
				 $clean = substr($out,0,$entity_start);
				 $subst = substr($out,$entity_start+1,1);
				 $clean .= ($subst != "#") ? $subst : "_";
				 $clean .= substr($out,$entity_end+1);
				 $out = bl_cleanString($clean,$entity_start+1);
			}
		}
	}
	return $out;
}
function bl_mobile(){
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4))){
		return(true);
	} else {
		return(false);
	}
}
?>