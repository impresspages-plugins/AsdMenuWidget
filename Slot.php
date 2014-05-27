<?php
namespace Plugin\AsdMenuWidget;
 
class Slot {
    public static function image($params)
    {
        $options = array();
        $defaultValue = '';
        $cssClass = '';
        if (empty($params['id'])) {
            throw new \Ip\Exception("Ip.image slot requires parameter 'id'");
        }
        $key = $params['id'];

        if (isset($params['default'])) {
            $defaultValue = $params['default'];
        }

        if (isset($params['width'])) {
            $options['width'] = $params['width'];
        }
        if (isset($params['height'])) {
            $options['height'] = $params['height'];
        }
        
        if (isset($params['pageId'])) {
            $options['pageId'] = $params['pageId'];
        }
        
        if (isset($params['class'])) {
            $cssClass = $params['class'];
        }
        
        if (isset($params['alt'])) {
            $options['attributes']['alt'] = $params['alt'];
        }
        
        if (isset($params['title'])) {
            $options['attributes']['title'] = $params['title'];
        }

        $inlineManagementService = new \Ip\Internal\InlineManagement\Service();
        return $inlineManagementService->generateManagedImage($key, $defaultValue, $options, $cssClass);
    }
}
