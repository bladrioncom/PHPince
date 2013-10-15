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
if($PHPINCE_perms["styleeditor"]){
	switch($_GET["subf"]){
		case "": break;
		default:
			bl_redirect("/panel/".$_GET["func"]);
	}
	$PHPINCE_filename = $_GET["file"];
	$PHPINCE_opendir = $_GET["open"];
	if(empty($PHPINCE_opendir)){
		$PHPINCE_directory = "phpince-panel/phpince-style";
	} else {
		if(!preg_match("/\.\.\//i", $PHPINCE_opendir)){
			$PHPINCE_directory = "phpince-panel/phpince-style/".$PHPINCE_opendir;
		} else {
			$PHPINCE_directory = "phpince-panel/phpince-style";
		}
	}
	$PHPince_explode_url = explode('/', $PHPINCE_opendir);
	if(is_file($PHPINCE_directory."/".$PHPINCE_filename) && file_exists($PHPINCE_directory."/".$PHPINCE_filename) && !preg_match("/\.\.\//i", $PHPINCE_filename)){
		echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/style_editor_40.png\">&nbsp;".$PHPINCE_LANG[1900];
		if(!empty($PHPINCE_opendir)&&(!empty($PHPince_explode_url[1]))){
			echo " &raquo; <a href=\"/panel/styleeditor?open=".str_replace("/".$PHPince_explode_url[count($PHPince_explode_url)-1], '', $PHPINCE_opendir)."\">".$PHPINCE_LANG[1901]."</a>";
		}
		echo "</h1>";
		if(!empty($_POST["editor"])){
			$PHPINCE_edit = fopen($PHPINCE_directory."/".$PHPINCE_filename, "w");
			fwrite($PHPINCE_edit, $_POST["editor"]);
			fclose($PHPINCE_edit);
			echo "<div class=\"warn ok\"><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/warn_ok.png\">".$PHPINCE_LANG[1902]."</div>";
		}
    	echo "</div><div id=\"notitle\">";
		$PHPINCE_handle = fopen($PHPINCE_directory."/".$PHPINCE_filename, "r");
		$PHPINCE_contents = fread($PHPINCE_handle, filesize($PHPINCE_directory."/".$PHPINCE_filename));
		echo "<form method=\"post\" action=\"\"><textarea name=\"editor\" id=\"editor\">".$PHPINCE_contents."</textarea>
		<input type=\"submit\" value=\"".$PHPINCE_LANG[9]."\">
		</form>";
		echo "<script>
		  var editor = CodeMirror.fromTextArea(document.getElementById(\"editor\"), {
			lineNumbers: true,
			mode: \"text/html\",
			autoCloseTags: true,
			viewportMargin: Infinity,
		  });
		</script>";
		fclose($PHPINCE_handle);
		echo "</div>";
	} else {
		echo "<div id=\"title\">
          <h1><img src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/icon/style_editor_40.png\">&nbsp;".$PHPINCE_LANG[1900];
		if(!empty($PHPINCE_opendir)&&(!empty($PHPince_explode_url[1]))){
			echo " &raquo; <a href=\"/panel/styleeditor?open=".str_replace("/".$PHPince_explode_url[count($PHPince_explode_url)-1], '', $PHPINCE_opendir)."\">".$PHPINCE_LANG[1901]."</a>";
		}
		echo "</h1>";
    	echo "</div><div id=\"notitle\">";
		echo "<table class=\"styled\">
			  <tr>
				  <th>".$PHPINCE_LANG[802]."</th>
				  <th style=\"text-align:right;\">".$PHPINCE_LANG[803]."</th>
			  </tr>";
		$PHPINCE_filesystem_check = @opendir($PHPINCE_directory);
		while ($PHPINCE_filesystem_checking = readdir($PHPINCE_filesystem_check)) {
			if($PHPINCE_filesystem_checking != '.' && $PHPINCE_filesystem_checking != '..'){
				$PHPINCE_filesystem_checking_suf = end(explode(".", strtolower($PHPINCE_filesystem_checking)));
				echo "<tr>
					  <td style=\"width:auto;\">";
					if(is_file($PHPINCE_directory."/".$PHPINCE_filesystem_checking)){
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
						if(($PHPINCE_filesystem_checking_suf=="php")||($PHPINCE_filesystem_checking_suf=="css")||($PHPINCE_filesystem_checking_suf=="js")){
							echo "<a href=\"/panel/styleeditor?open=".$PHPINCE_opendir."&file=".$PHPINCE_filesystem_checking."\">".$PHPINCE_filesystem_checking."</a>";
						} else {
							echo "<a target=\"_blank\" href=\"/".$PHPINCE_directory."/".$PHPINCE_filesystem_checking."\">".$PHPINCE_filesystem_checking."</a>";
							if(($PHPINCE_filesystem_checking_suf=="gif")||($PHPINCE_filesystem_checking_suf=="png")||($PHPINCE_filesystem_checking_suf=="jpg")||($PHPINCE_filesystem_checking_suf=="jpeg")){
								echo "&nbsp;<span style=\"font-size:12px;\">(<a class=\"slider\" href=\"/".$PHPINCE_directory."/".$PHPINCE_filesystem_checking."\">".$PHPINCE_LANG[809]."</a>)</span>";
							}
						}
					} else {
						echo "<img style=\"margin-bottom:-3px;\" src=\"/phpince-panel/phpince-data/core/tems/phpince-dashboard/filetp/folder.png\" alt=\"Folder\" />&nbsp;";
						echo "<a href=\"/panel/styleeditor?open=".$PHPINCE_opendir."/".$PHPINCE_filesystem_checking."\">".$PHPINCE_filesystem_checking."</a>";
					}
					echo "</td>
					  <td style=\"width:auto;text-align:right;\">";
					if(is_file($PHPINCE_directory."/".$PHPINCE_filesystem_checking)){
						echo bl_filesize(filesize($PHPINCE_directory."/".$PHPINCE_filesystem_checking));
					}
					echo "</td></tr>";
			}
		}
		echo "<tr>
				  <th></th>
				  <th></th>
			  </tr>
		  </table>";
		echo "</div>";
	}
} else {
	bl_redirect("/panel");
}
?>