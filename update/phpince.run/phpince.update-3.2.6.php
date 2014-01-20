<?php
bl_query("ALTER TABLE `".$PHPince_logon["prefix"]."phpince_system` ADD `login_redirect` TEXT NOT NULL DEFAULT '';", array(), $PHPince_logon["login"]);
?>