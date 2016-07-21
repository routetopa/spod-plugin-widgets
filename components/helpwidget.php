<?php

/**
 * EXHIBIT A. Common Public Attribution License Version 1.0
 * The contents of this file are subject to the Common Public Attribution License Version 1.0 (the “License”);
 * you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.oxwall.org/license. The License is based on the Mozilla Public License Version 1.1
 * but Sections 14 and 15 have been added to cover use of software over a computer network and provide for
 * limited attribution for the Original Developer. In addition, Exhibit A has been modified to be consistent
 * with Exhibit B. Software distributed under the License is distributed on an “AS IS” basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for the specific language
 * governing rights and limitations under the License. The Original Code is Oxwall software.
 * The Initial Developer of the Original Code is Oxwall Foundation (http://www.oxwall.org/foundation).
 * All portions of the code written by Oxwall Foundation are Copyright (c) 2011. All Rights Reserved.

 * EXHIBIT B. Attribution Information
 * Attribution Copyright Notice: Copyright 2011 Oxwall Foundation. All rights reserved.
 * Attribution Phrase (not exceeding 10 words): Powered by Oxwall community software
 * Attribution URL: http://www.oxwall.org/
 * Graphic Image as provided in the Covered Code.
 * Display of Attribution Information is required in Larger Works which are defined in the CPAL as a work
 * which combines Covered Code or portions thereof with code not governed by the terms of the CPAL.
 */

/**
 *
 *
 * @author Kairat Bakitov <kainisoft@gmail.com>
 * @package ow_system_plugins.base.components
 * @since 1.7.2
 */
class SPODWIDGETS_CMP_Helpwidget extends BASE_CLASS_Widget
{
    CONST PATTERN = '/<li>.+{$key}.+<\/li>/i';


    public function __construct( BASE_CLASS_WidgetParameter $paramObject )
    {
        parent::__construct();

        $text = OW::getLanguage()->text('spodwidgets', 'help_links_contents');
        OW::getDocument()->addStyleSheet(OW::getPluginManager()->getPlugin('spodwidgets')->getStaticCssUrl() . 'widgetstyle.css');
        
        $this->assign('text', $text);
    }
    
    private function getLangLabel( $pattern, $text, $key )
    {
        preg_match($pattern, $text, $matches);
            
        if ( !empty($matches) )
        {
            preg_match('/<a[^>]*' . $key . '[^>]*>(.+)<\/a[^>]*>/i', $matches[0], $langLabel);

            if ( isset($langLabel[1]) )
            {
                return $langLabel[1];
            }
        }
        
        return NULL;
    }

    public static function getSettingList()
    {
        $settingList = array();

        $settingList['text'] = array(
            'presentation' => self::PRESENTATION_CUSTOM,
            'render' => 'SPODWIDGETS_CMP_Helpwidget::renderTextField',
            'value' => OW::getLanguage()->text('spodwidgets', 'help_links_contents')
        );
        return $settingList;
    }

    public static function getStandardSettingValueList()
    {
        return array(
            self::SETTING_ICON => self::ICON_HELP,
            self::SETTING_TITLE => OW::getLanguage()->text('spodwidgets', 'help_title')
        );
    }

    public static function getAccess()
    {
        return self::ACCESS_MEMBER;
    }

    public static function processSettingList( $settingList, $place, $isAdmin )
    {
        BOL_LanguageService::getInstance()->addOrUpdateValue(OW::getLanguage()->getCurrentId(), 'spodwidgets', 'help_links_contents', $settingList['text']);
        return $settingList;
    }

   public static function renderTextField( $widgetName, $name, $value )
    {

        $content = OW::getLanguage()->text('spodwidgets', 'help_links_contents');


       return '<textarea name="' . $name . '">' . $content . '</textarea><br />';
   }
}
