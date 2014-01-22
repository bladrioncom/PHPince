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
if($PHPINCE_perms["script"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/script_40.png\">&nbsp;".$PHPINCE_LANG[1000]."</h1>";
    echo "</div><div id=\"notitle\">";
	echo "<table class=\"styled\">
			  <tr>
				  <th>".$PHPINCE_LANG[1001]."</th>
				  <th style=\"text-align:right;\">".$PHPINCE_LANG[803]."</th>
				  <th></th>
			  </tr>";
	if(bl_dir_files("phpince-panel/phpince-script")==1){
		echo "<tr><td colspan=\"3\">".$PHPINCE_LANG[805]."</td></tr>";
	} else {
		$PHPINCE_filesystem_check = @opendir("phpince-panel/phpince-script") or die("Error");
		$i = 1;
		while ($PHPINCE_filesystem_checking = readdir($PHPINCE_filesystem_check)) {
			if($PHPINCE_filesystem_checking != '.' && $PHPINCE_filesystem_checking != '..' && is_dir("phpince-panel/phpince-script/".$PHPINCE_filesystem_checking) && file_exists("phpince-panel/phpince-script/".$PHPINCE_filesystem_checking."/info.phpince.php") && file_exists("phpince-panel/phpince-script/".$PHPINCE_filesystem_checking."/script.phpince.php")){
				require "phpince-panel/phpince-script/".$PHPINCE_filesystem_checking."/info.phpince.php";
				echo "<tr id=\"".$i."\">
				  <td style=\"width:auto;\"><p>&nbsp;</p><b>".$PHPINCE_SCRIPT_INFO["name"]." v".$PHPINCE_SCRIPT_INFO["version"]."</b>";
				if(!empty($PHPINCE_SCRIPT_INFO["info"])){
					echo "<br>- ".$PHPINCE_SCRIPT_INFO["info"];
				} else {
					echo "<br>...";
				}
				echo "<p>&nbsp;</p></td>
				  <td style=\"width:auto;text-align:right;\">".bl_filesize((filesize("phpince-panel/phpince-script/".$PHPINCE_filesystem_checking."/script.phpince.php")+filesize("phpince-panel/phpince-script/".$PHPINCE_filesystem_checking."/info.phpince.php")))."</td>
				  <td style=\"width:20px;\"><a id=\"a".$i."\" class=\"action add\" href=\"javascript: bl_runscript(".$i.", '".$PHPINCE_filesystem_checking."');\"></a></td>
			  </tr>";
			  $i++;
			  $PHPINCE_SCRIPT_INFO = false;
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
} else {
	bl_redirect("/panel");
}
?>