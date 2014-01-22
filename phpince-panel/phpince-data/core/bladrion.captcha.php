<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2014 Dominik Hulla
| Web: http://phpince.org
| Author: Dominik Hulla / dh@bladrion.com
| Developer: Bladrion Technologies (http://bladrion.com)
+----------------------------------------------------------------------+
| Version: 1.2
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
function BLADRION_captcha(){$check_ok = array(rand(0,9),rand(0,9),rand(0,9),rand(0,9),rand(0,9));$my_img = imagecreatetruecolor(74, 25);$background = imagecolorallocate($my_img, 0, 0, 0);$text_no = imagecolorallocate($my_img, 1, 0, 0);$text_ok = imagecolorallocate($my_img, 16, 170, 221);$dash = imagecolorallocate($my_img, 130, 207, 255);imagecolortransparent($my_img, $background);imagechar($my_img, 4, 5, rand(1,7), $check_ok[0], $text_ok);imagechar($my_img, 4, 13, rand(1,7), rand(0,9), $text_no);imageline($my_img, 0, rand(5,20), 74, rand(5,20), $dash);imagechar($my_img, 4, 21, rand(1,7), rand(0,9), $text_no);imagechar($my_img, 4, 29, rand(1,7), $check_ok[1], $text_ok);imagechar($my_img, 4, 37, rand(1,7), $check_ok[2], $text_ok);imagechar($my_img, 4, 45, rand(1,7), rand(0,9), $text_no);imagechar($my_img, 4, 53, rand(1,7), $check_ok[3], $text_ok);imageline($my_img, 0, rand(5,20), 74, rand(5,20), $dash);imagechar($my_img, 4, 61, rand(1,7), $check_ok[4], $text_ok);header("Content-type: image/png");imagepng($my_img);imagecolordeallocate($text_ok);imagecolordeallocate($text_no);imagecolordeallocate($dash);imagedestroy($my_img);if(empty($_COOKIE["bladrioncapcha"])){$bladrioncapcha = sha1($check_ok[0].$check_ok[1].$check_ok[2].$check_ok[3].$check_ok[4]);setcookie("bladrioncapcha", $bladrioncapcha, time()+3600, "/");} else {setcookie("bladrioncapcha", "", time()-3600, "/");$bladrioncapcha = sha1($check_ok[0].$check_ok[1].$check_ok[2].$check_ok[3].$check_ok[4]);setcookie("bladrioncapcha", $bladrioncapcha, time()+3600, "/");}}BLADRION_captcha();
?>