<?php

namespace Plugin\AsdMenuWidget\Widget\Menu;

class Controller extends \Ip\WidgetController
{
    public function getTitle() {
        return __('Menu', 'AsdMenuWidget', false);
    }

    public function generateHtml( $revisionId, $widgetId, $data, $skin )
    {
        if( empty( $data['serialized'] ) ) {
            $data['serialized'] = '';
        } else {
            parse_str( $data['serialized'], $data );
            $data['currentLink'] = $revisionId;
        }

        if( isset( $data['data']['menu']['visibility'] ) ) {
            if( $data['data']['menu']['visibility'] == 0 ) {
                return parent::generateHtml( $revisionId, $widgetId, $data, $skin );
            } else {
                if( !empty( $revisionId ) ) {
                        $revision = \Ip\Internal\Revision::getRevision( $revisionId );
                        $pageId = $revision['pageId'];
                    } else {
                        $pageId = $data['data']['menu']['pageId'];
                    }
                if( $data['data']['menu']['visibility'] == 1 ) {
                    $parentId = Model::getParentId( $data['data']['menu']['name'] );
                    if( $parentId == $pageId ) {
                        return parent::generateHtml( $revisionId, $widgetId, $data, $skin );
                    } elseif( Model::checkIfChildren( array( $parentId ), $pageId ) ) {
                        return parent::generateHtml( $revisionId, $widgetId, $data, $skin );
                    }
                } elseif( $data['data']['menu']['visibility'] == 2 ) {
                    if( $data['data']['menu']['pageId'] == $pageId ) {
                        return parent::generateHtml( $revisionId, $widgetId, $data, $skin );
                    }
                }
            }
        }
        return parent::generateHtml( $revisionId, $widgetId, array(), $skin );
    }

    public function adminHtmlSnippet()
    {
        $form = new \Ip\Form();

        $results = Model::getMenusList();
        
        $form->addField(new \Ip\Form\Field\Select(
            array(
                'name' => 'data[menu][name]',
                'label' => __( 'Menu name', 'AsdMenuWidget' ),
                'values' => $results
            )
        ));
        
        $visibilityOptions = array(
            array( 0, __( 'All pages', 'AsdMenuWidget' ) ),
            array( 1, __( 'Parent page and its childrens', 'AsdMenuWidget' ) ),
            array( 2, __( 'Current page only', 'AsdMenuWidget' ) ),
        );
        
        $form->addField(new \Ip\Form\Field\Select(
            array(
                'name' => 'data[menu][visibility]',
                'label' => __( 'Visibility', 'AsdMenuWidget' ),
                'values' => $visibilityOptions
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Hidden(
            array(
                'name' => 'data[menu][pageId]',
                'value' => ipContent()->getCurrentPage()->getId()
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
                'note' => __( 'empty or 0 value shows all menu levels', 'AsdMenuWidget' ),
            )
        ));
        $yesNo = array(
            array( 0, __( 'No', 'AsdMenuWidget' ) ),
            array( 1, __( 'Parent page and its childrens', 'AsdMenuWidget' ) ),
            array( 2, __( 'Current page only', 'AsdMenuWidget' ) ),
        );
        
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
