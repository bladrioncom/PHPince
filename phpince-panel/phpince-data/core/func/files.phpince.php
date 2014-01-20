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
if($PHPINCE_perms["files"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/file_40.png\">&nbsp;".$PHPINCE_LANG[800]."</h1>";
	if(!empty($_FILES["files"]["name"][0])){
		for ($i = 0; $i < count($_FILES["files"]["name"]); $i++) {
			if(file_exists("phpince-panel/phpince-upload/".$_FILES["files"]["name"][$i])){
				unlink("phpince-panel/phpince-upload/".$_FILES["files"]["name"][$i]);
				move_uploaded_file($_FILES["files"]["tmp_name"][$i], "phpince-panel/phpince-upload/".$_FILES["files"]["name"][$i]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_808} <a target=\"_blank\" href=\"/file/".$_FILES["files"]["name"][$i]."\">".bl_filecut($_FILES["files"]["name"][$i])."</a>"), $PHPince_logon["login"]);
			} else {
				move_uploaded_file($_FILES["files"]["tmp_name"][$i], "phpince-panel/phpince-upload/".$_FILES["files"]["name"][$i]);
				bl_query("INSERT INTO ".$PHPince_logon["prefix"]."phpince_log (account, ip, adate, action, msg) VALUES (?, ?, ?, ?, ?)", array($PHPINCE_user["id"], $_SERVER['REMOTE_ADDR'], bl_date(), "{SYSTEM}", "{TRANSLATE_806} <a target=\"_blank\" href=\"/file/".$_FILES["files"]["name"][$i]."\">".bl_filecut($_FILES["files"]["name"][$i])."</a>"), $PHPince_logon["login"]);
			}
		}
		echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[804]."</div>";
	}
    echo "</div><div id=\"notitle\" >";
	echo "<form class=\"fileupload\" method=\"post\" enctype=\"multipart/form-data\">
                    	<h4>".$PHPINCE_LANG[801]." <span id=\"loading\"></span></h4>
                        <div id=\"fileupload\"><input type=\"file\" name=\"files[]\" multiple></div>
                        <input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">
                    </form>";
	echo "<p>&nbsp;</p><table class=\"styled\">
			  <tr>
				  <th>".$PHPINCE_LANG[802]."</th>
				  <th style=\"text-align:right;\">".$PHPINCE_LANG[803]."</th>
				  <th></th>
			  </tr>";
	if(bl_dir_files("phpince-panel/phpince-upload")==1){
		echo "<tr><td colspan=\"3\">".$PHPINCE_LANG[805]."</td></tr>";
	} else {
		$PHPINCE_filesystem_check = @opendir("phpince-panel/phpince-upload") or die("Error");
		$i = 1;
		while ($PHPINCE_filesystem_checking = readdir($PHPINCE_filesystem_check)) {
			if($PHPINCE_filesystem_checking != '.' && $PHPINCE_filesystem_checking != '..' && $PHPINCE_filesystem_checking != '.htaccess'){
				$PHPINCE_filesystem_checking_suf = end(explode(".", strtolower($PHPINCE_filesystem_checking)));
				echo "<tr id=\"".$i."\">
				  <td style=\"width:auto;\">";
				if(($PHPINCE_filesystem_checking_suf=="gif")||($PHPINCE_filesystem_checking_suf=="png")||($PHPINCE_filesystem_checking_suf=="jpg")||($PHPINCE_filesystem_checking_suf=="jpeg")||($PHPINCE_filesystem_checking_suf=="bmp")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/img.png\" alt=\"Image\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="pdf")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/pdf.png\" alt=\"PDF\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="doc")||($PHPINCE_filesystem_checking_suf=="docx")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/word.png\" alt=\"Microsoft - Word\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="xls")||($PHPINCE_filesystem_checking_suf=="xlsx")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/excel.png\" alt=\"Microsoft - Excel\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="swf")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/swf.png\" alt=\"Flash\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="htm")||($PHPINCE_filesystem_checking_suf=="html")||($PHPINCE_filesystem_checking_suf=="xml")||($PHPINCE_filesystem_checking_suf=="txt")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/html.png\" alt=\"Document\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="indd")||($PHPINCE_filesystem_checking_suf=="indt")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/id.png\" alt=\"Adobe - InDesign\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="ai")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/ai.png\" alt=\"Adobe - Illustator\" />&nbsp;";
				} else if(($PHPINCE_filesystem_checking_suf=="psd")){
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/psd.png\" alt=\"Adobe - Photoshop\" />&nbsp;";
				} else {
					echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/none.png\" alt=\"Unknown\" />&nbsp;";
				}
				 echo "<a href=\"/file/".$PHPINCE_filesystem_checking."\" target=\"_blank\">".$PHPINCE_filesystem_checking."</a>";
				if(($PHPINCE_filesystem_checking_suf=="gif")||($PHPINCE_filesystem_checking_suf=="png")||($PHPINCE_filesystem_checking_suf=="jpg")||($PHPINCE_filesystem_checking_suf=="jpeg")){
					echo "&nbsp;<span style=\"font-size:12px;\">(<a class=\"slider\" href=\"/file/".$PHPINCE_filesystem_checking."\">".$PHPINCE_LANG[809]."</a>)</span>";
				}
				echo "</td>
				  <td style=\"width:auto;text-align:right;\">".bl_filesize(filesize("phpince-panel/phpince-upload/".$PHPINCE_filesystem_checking))."</td>
				  <td style=\"width:20px;\"><a onClick=\"return confirm('".$PHPINCE_LANG[30]."')\" id=\"a".$i."\" class=\"action cancel\" href=\"javascript: bl_runaction('".$i."','".$PHPINCE_filesystem_checking."', 'filedelete')\"></a></td>
			  </tr>";
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
} else {
	bl_redirect("/panel");
}
?>