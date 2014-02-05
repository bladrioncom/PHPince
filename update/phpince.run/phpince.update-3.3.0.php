<?php
bl_query("ALTER TABLE `".$PHPince_logon["prefix"]."phpince_news` ADD `min_content` TEXT NOT NULL AFTER `content`;", array(), $PHPince_logon["login"]);
?>