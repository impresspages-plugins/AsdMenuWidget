<?php

namespace Plugin\AsdMenuWidget;

class Filter {
    public static function ipWidgetManagementMenu($optionsMenu,$widgetRecord)
    {
        if( $widgetRecord['name'] == 'Menu' ) {
            $optionsMenu[] = array(
                'title' => __( 'Settings', 'AsdMenuWidget', false ),
                'attributes' => array(
                    'class' => '_edit ipsWidgetEdit',
                )
            );
        }
        return $optionsMenu;
    }
}