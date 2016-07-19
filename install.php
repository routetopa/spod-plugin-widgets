<?php

$path = OW::getPluginManager()->getPlugin('spodwidgets')->getRootDir() . 'langs.zip';
BOL_LanguageService::getInstance()->importPrefixFromZip($path, 'spodwidgets');

