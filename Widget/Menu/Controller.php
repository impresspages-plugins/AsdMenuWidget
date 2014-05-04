<?php

/**
 * Widget controller
 */

namespace Plugin\AsdMenuWidget\Widget\Menu;

class Controller extends \Ip\WidgetController
{
    public function getTitle() {
        return __('Menu with icons', 'AsdMenuWidget', false);
    }

    public function generateHtml( $revisionId, $widgetId, $data, $skin )
    {
        if( empty( $data['serialized'] ) ) {
                    $data['serialized'] = '';
		} else {
            parse_str( $data['serialized'], $data );
            $data['currentLink'] = $revisionId;
        }
        $data['testas'] = $revisionId;
        return parent::generateHtml( $revisionId, $widgetId, $data, $skin );
    }

    public function adminHtmlSnippet()
    {
        $form = new \Ip\Form();

        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][name]',
                'label' => 'Menu name',
            )
        ));
        
        $form->addFieldset(new \Ip\Form\Fieldset('Options'));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][class]',
                'label' => __( 'Class', 'AsdMenuWidget' ),
                'value' => 'menu'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][parent]',
                'label' => __( 'Parent class', 'AsdMenuWidget' ),
                'value' => 'parent'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][active]',
                'label' => __( 'Active class', 'AsdMenuWidget' ),
                'value' => 'active'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][depth]',
                'label' => __( 'Depth', 'AsdMenuWidget' ),
                'value' => '0'
            )
        ));
        
        $form->addFieldset(new \Ip\Form\Fieldset('Icons'));
        $form->addField(new \Ip\Form\Field\Checkbox(
            array(
                'name' => 'data[icon][enable]',
                'label' => __( 'Enable icons', 'AsdMenuWidget' ),
            )
        ));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[icon][width]',
                'label' => __( 'Icon width', 'AsdMenuWidget' ),
                'value' => '24'
            )
        ));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[icon][height]',
                'label' => __( 'Icon height', 'AsdMenuWidget' ),
                'value' => '24'
            )
        ));
        
        return ipView('snippet/edit.php', array( 'form' => $form ))->render();
    }
}
