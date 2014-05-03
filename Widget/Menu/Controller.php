<?php

/**
 * Widget controller
 */

namespace Plugin\CpThemeWidgets\Widget\Menu;

class Controller extends \Ip\WidgetController
{
    public function getTitle() {
        return __('Menu', 'CpThemeWidgets', false);
    }

    public function generateHtml( $revisionId, $widgetId, $data, $skin )
    {
        //reikia užsetinti dabartinį peig'ą, nes inline image nuo to priklauso. Kai pergeneruojamas widget'o preview, ipimage ieško current page.
        /*
        $revision = \Ip\Internal\Revision::getRevision( $revisionId );
        $page = ipContent()->getPage( $revision['pageId'] );
        ipContent()->_setCurrentPage( $page );
        */
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
        /*
        $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);
        $field = new \Ip\Form\Field\Url(
            array(
                'name' => 'redirectUrl',
                'label' => __('Redirect', 'Ip-admin', FALSE),
                'value' => ''
            ));
        $form->addField($field);
        */
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
                'label' => 'Class',
                'value' => 'menu'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][parent]',
                'label' => 'Parent class',
                'value' => 'parent'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][active]',
                'label' => 'Active class',
                'value' => 'active'
            )
        ));
        
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[menu][depth]',
                'label' => 'Depth',
                'value' => '0'
            )
        ));
        
        $form->addFieldset(new \Ip\Form\Fieldset('Link icons'));
        $form->addField(new \Ip\Form\Field\Checkbox(
            array(
                'name' => 'data[icon][enable]',
                'label' => 'Enable link icons',
            )
        ));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[icon][width]',
                'label' => 'Width',
                'value' => '24'
            )
        ));
        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'data[icon][height]',
                'label' => 'Height',
                'value' => '24'
            )
        ));
        
        return ipView('snippet/edit.php', array( 'form' => $form ))->render();
    }
}
