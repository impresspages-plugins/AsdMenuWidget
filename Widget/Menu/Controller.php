<?php

/**
 * Widget controller
 */

namespace Plugin\AsdMenuWidget\Widget\Menu;

class Controller extends \Ip\WidgetController
{
    public function getTitle() {
        return __('Menu', 'AsdMenuWidget', false);
    }

    public function generateHtml( $revisionId, $widgetId, $data, $skin )
    {
        $revision = \Ip\Internal\Revision::getRevision( $revisionId );
        $page = ipContent()->getPage( $revision['pageId'] );
        ipContent()->_setCurrentPage( $page );
        if( empty( $data['serialized'] ) ) {
            $data['serialized'] = '';
        } else {
            parse_str( $data['serialized'], $data );
            $data['currentLink'] = $revisionId;
        }
        return parent::generateHtml( $revisionId, $widgetId, $data, $skin );
    }

    public function adminHtmlSnippet()
    {
        $form = new \Ip\Form();

        $results = Model::getTopMenusList();
        
        $form->addField(new \Ip\Form\Field\Select(
            array(
                'name' => 'data[menu][name]',
                'label' => __( 'Menu name', 'AsdMenuWidget' ),
                'values' => $results
            )
        ));
        
        $form->addFieldset(new \Ip\Form\Fieldset(__( 'Options', 'AsdMenuWidget' )));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][class]',
                'label' => __( 'Class name', 'AsdMenuWidget' ),
                'value' => 'menu'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][parent]',
                'label' => __( 'Parent class name', 'AsdMenuWidget' ),
                'value' => 'parent'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][active]',
                'label' => __( 'Active class name', 'AsdMenuWidget' ),
                'value' => 'active'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][depth]',
                'label' => __( 'Depth', 'AsdMenuWidget' ),
                'value' => '0',
                'note' => __( '0 - show all menu levels', 'AsdMenuWidget' ),
            )
        ));
        
        $form->addFieldset(new \Ip\Form\Fieldset('Icon options'));
        $form->addField(new \Ip\Form\Field\Checkbox(
            array(
                'name' => 'data[icon][enable]',
                'label' => __( 'Enable icons', 'AsdMenuWidget' ),
            )
        ));
        $form->addField(new \Ip\Form\Field\Checkbox(
            array(
                'name' => 'data[icon][empty]',
                'label' => __( 'Show empty image', 'AsdMenuWidget' ),
                'note' => __( 'If no image chosen, show transparent image.', 'AsdMenuWidget' ),
            )
        ));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[icon][width]',
                'label' => __( 'Icon width', 'AsdMenuWidget' ),
                'value' => '50'
            )
        ));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[icon][height]',
                'label' => __( 'Icon height', 'AsdMenuWidget' ),
                'value' => '50'
            )
        ));
        
        return ipView('snippet/edit.php', array( 'form' => $form ))->render();
    }
}
