<?php
/*---------------------------------------------------------------------+
| PHPince Website - Update script
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
if(empty($PHPINCE_VERSION["SYSTEM"])){ exit; }
$PHPINCE_filesystem_check = @opendir("update/".$entry."/update/phpince.run") or die("[Error]: phpince.run not found");
$PHPINCE_f_istalled = explode('.', $PHPINCE_VERSION["SYSTEM"]);
while ($PHPINCE_filesystem_checking = readdir($PHPINCE_filesystem_check)) {
	if($PHPINCE_filesystem_checking != '.' && $PHPINCE_filesystem_checking != '..' && $PHPINCE_filesystem_checking != '.htaccess'){
		$PHPINCE_filesystem_checking_name = preg_replace('/\.php/', '', $PHPINCE_filesystem_checking);
		$PHPINCE_filesystem_checking_name = preg_replace('/phpince.update-/', '', $PHPINCE_filesystem_checking_name);
		$PHPINCE_f_actual = explode('.', $PHPINCE_filesystem_checking_name);
		if($PHPINCE_f_actual[0].$PHPINCE_f_actual[1].".".$PHPINCE_f_actual[2]>$PHPINCE_f_istalled[0].$PHPINCE_f_istalled[1].".".$PHPINCE_f_istalled[2]){
			require("update/".$entry."/update/phpince.run/".$PHPINCE_filesystem_checking);
		}
	}
}
?>