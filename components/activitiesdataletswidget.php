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
 * Custom HTML widget
 *
 * @author Sergey Kambalin <greyexpert@gmail.com>
 * @package ow_system_plugins.base.components
 * @since 1.0
 */

class SPODWIDGETS_CMP_Activitiesdataletswidget extends BASE_CLASS_Widget
{
    private $content = false;
    private $nl2br = false;

    public function __construct( BASE_CLASS_WidgetParameter $paramObject )
    {
        parent::__construct();
        $this->assign('components_url', SPODPR_COMPONENTS_URL);
        OW::getDocument()->addStyleSheet(OW::getPluginManager()->getPlugin('spodwidgets')->getStaticCssUrl() . 'widgetstyle.css');


        $params = $paramObject->customParamList;

        if ( !empty($params['content']) )
        {
            $this->content = $paramObject->customizeMode && !empty($_GET['disable-js']) ? UTIL_HtmlTag::stripJs($params['content']) : $params['content'];
        }

    }

    public static function getStandardSettingValueList()
    {
        return array(
            //self::SETTING_TITLE => OW::getLanguage()->text('base', 'custom_html_widget_default_title')
            //self::SETTING_TITLE => 'Meet the datalet!'
            self::SETTING_TITLE => OW::getLanguage()->text('spodwidgets', 'activitiesdatalets_title')
        );
    }

    public static function getAccess()
    {
        return self::ACCESS_ALL;
    }

    public function onBeforeRender()
    {
        $this->getLatestDatalets(1);
    }



    function getLatestDatalets($count = 0) {

        $dbo = OW::getDbo();
        $params = null;
        $paramsStr = "";

        $query = "SELECT ow_ode_datalet.component, ow_ode_datalet.params, ow_ode_datalet.fields, ow_ode_datalet.data
                  FROM ow_ode_datalet join ow_ode_datalet_post on ow_ode_datalet.id = ow_ode_datalet_post.dataletId
                  WHERE ow_ode_datalet.component != 'preview-datalet'
                  ORDER BY ow_ode_datalet.id desc
                  LIMIT ".$count.";";

        $row = $dbo->queryForRow($query);

        $params = json_decode($row['params']);
        foreach ($params as $key => $value)
            $paramsStr .= $key. "='" . $value . "' ";

        $data = [
            'component' => $row["component"],
            'data' => $row["data"],
            'params' => json_decode($row["params"], true),
            'fields' => str_replace("'","&#39;", $row["fields"]),
            'parameters' => $paramsStr
        ];

        $this->assign('latestDatalet', $data);
        $content = $this;
        $this->assign('content', $content);
    }
}