<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\AsdMenuWidget\Widget\Menu;


class Model
{
    public static function getTopMenusList()
    {
        $languageCode = ipContent()->getCurrentLanguage()->code;
        $table = ipTable('page');
        $sql = "SELECT `title`, `alias` FROM $table WHERE `parentId` = 0 AND `languageCode` = '{$languageCode}' ORDER BY `title` ASC";
        $results = ipDb()->fetchAll( $sql );
        foreach( $results as $result ) {
            $returnData[] = array( $result['alias'], $result['title'] );
        }
        return $returnData;
    }
}
