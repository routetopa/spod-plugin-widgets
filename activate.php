<?php

/*$cmpService = BOL_ComponentAdminService::getInstance();
$widget = $cmpService->addWidget('BASE_CMP_CustomHtmlWidget', true);
$cmpService->addWidgetToPlace($widget, BOL_ComponentAdminService::PLACE_INDEX);*/

$cmpService = BOL_ComponentAdminService::getInstance();

$widget = $cmpService->addWidget('SPODWIDGETS_CMP_Helpwidget', true);
$cmpService->addWidgetToPlace($widget, BOL_ComponentAdminService::PLACE_INDEX);
//$widgetService->addWidgetToPosition($widgetPlace, BOL_ComponentService::SECTION_LEFT, 0); // Choose a special position on the page to add the widget. the third parameter of this function is the widget's position in a certain section. If you want to add the widget to the very bottom, you should set -1.



$widget = $cmpService->addWidget('SPODWIDGETS_CMP_Activitiesdataletswidget', true);
$cmpService->addWidgetToPlace($widget, BOL_ComponentAdminService::PLACE_INDEX);


$widget = $cmpService->addWidget('SPODWIDGETS_CMP_Activitiesroomswidget', true);
$cmpService->addWidgetToPlace($widget, BOL_ComponentAdminService::PLACE_INDEX);

$widget = $cmpService->addWidget('SPODWIDGETS_CMP_Tweetswidget', true);
$cmpService->addWidgetToPlace($widget, BOL_ComponentAdminService::PLACE_INDEX);


