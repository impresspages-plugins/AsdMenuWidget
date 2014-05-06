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
        $sql = "SELECT `title`, `alias`, `languageCode` FROM $table WHERE `parentId` = 0 ORDER BY `languageCode` ASC, `title` ASC";
        $results = ipDb()->fetchAll( $sql );
        foreach( $results as $result ) {
            $returnData[] = array( $result['alias'], $result['languageCode'] . ' - ' . $result['title'] );
        }
        return $returnData;
    }
}
