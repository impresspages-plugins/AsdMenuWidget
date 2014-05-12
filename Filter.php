<?php

namespace Plugin\AsdMenuWidget;

class Filter {
    public static function ipWidgetManagementMenu($optionsMenu)
    {
        $optionsMenu[] = array(
            'title' => __( 'Settings', 'AsdMenuWidget', false ),
            'attributes' => array(
                'class' => '_edit ipsWidgetEdit',
            )
        );
        return $optionsMenu;
    }
}