<?php
bl_query("ALTER TABLE `".$PHPince_logon["prefix"]."phpince_system` ADD `set_dnscloudflare` INT(1) NOT NULL DEFAULT '0' AFTER `set_stopspam`;", array(), $PHPince_logon["login"]);
bl_query("INSERT INTO `".$PHPince_logon["prefix"]."phpince_perms` (`perms` ,`userlevel`) VALUES ('styleeditor', '10');", array(), $PHPince_logon["login"]);
?>