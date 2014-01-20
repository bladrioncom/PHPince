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
if($PHPINCE_perms["apps"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/app_40.png\">&nbsp;".$PHPINCE_LANG[1600]."</h1>";
    echo "</div><div id=\"notitle\">";
	echo "<table class=\"styled\">
			  <tr>
				  <th>".$PHPINCE_LANG[1601]."</th>
				  <th style=\"text-align:right;\">".$PHPINCE_LANG[803]."</th>
				  <th></th>
			  </tr>";
	if(bl_dir_files("phpince-panel/phpince-include")==1){
		echo "<tr><td colspan=\"3\">".$PHPINCE_LANG[805]."</td></tr>";
	} else {
		$PHPINCE_pew = bl_query("SELECT * FROM ".$PHPince_logon["prefix"]."phpince_app", array(), $PHPince_logon["login"]);
		$PHPINCE_installed_apps = array();
		while($PHPINCE_pewf = $PHPINCE_pew->fetch()){
			$PHPINCE_installed_apps[$PHPINCE_pewf["id"]] = $PHPINCE_pewf["datafiles"];
			$PHPINCE_installed_apps[$PHPINCE_pewf["datafiles"]] = $PHPINCE_pewf["id"];
		}
		$PHPINCE_filesystem_check = @opendir("phpince-panel/phpince-include") or die("Error");
		$i = 1;
		while ($PHPINCE_filesystem_checking = readdir($PHPINCE_filesystem_check)) {
			if($PHPINCE_filesystem_checking != '.' && $PHPINCE_filesystem_checking != '..' && is_dir("phpince-panel/phpince-include/".$PHPINCE_filesystem_checking)){
				if(in_array($PHPINCE_filesystem_checking, $PHPINCE_installed_apps)){
					echo "<tr id=\"".$i."\">
					  <td style=\"width:auto;\"><a target=\"_blank\" href=\"/app/".$PHPINCE_installed_apps[$PHPINCE_filesystem_checking]."\">".$PHPINCE_filesystem_checking."&nbsp;<img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/elink.png\"></a></td>
					  <td style=\"width:auto;text-align:right;\">".bl_filesize(bl_dir_size("phpince-panel/phpince-include/".$PHPINCE_filesystem_checking))."</td>
					  <td style=\"width:20px;\"><a id=\"a".$i."\" class=\"action cancel\" href=\"javascript: bl_appinstaller('".$i."','".$PHPINCE_installed_apps[$PHPINCE_filesystem_checking]."', 'appuninstall')\"></a></td>
				  </tr>";
				} else {
					echo "<tr id=\"".$i."\">
					  <td style=\"width:auto;\">".$PHPINCE_filesystem_checking."</td>
					  <td style=\"width:auto;text-align:right;\">".bl_filesize(bl_dir_size("phpince-panel/phpince-include/".$PHPINCE_filesystem_checking))."</td>
					  <td style=\"width:20px;\"><a id=\"a".$i."\" class=\"action add\" href=\"javascript: bl_appinstaller('".$i."','".$PHPINCE_filesystem_checking."', 'appinstall')\"></a></td>
				  </tr>";
				}
			  $i++;
			}
		}
	}
	echo "<tr>
				  <th></th>
				  <th></th>
				  <th></th>
			  </tr>
		  </table>";
	echo "</div>";
	echo "</div>";
} else {
	bl_redirect("/panel");
}
?>