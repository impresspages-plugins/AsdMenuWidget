<?php

namespace Plugin\AsdMenuWidget\Widget\Menu;


class Model
{
    public static function getMenusList()
    {
        if( ipGetOption('AsdMenuWidget.multilanguage') == 'Yes' ) {
            $multilanguage = null;
        } else {
            $languageCode = ipContent()->getCurrentLanguage()->code;
            $multilanguage = "`languageCode` = '$languageCode' AND";
        }
        
        $table = ipTable('page');
        $sql = "SELECT `title`, `alias`, `languageCode`, `parentId`, `id` FROM $table WHERE $multilanguage `isVisible` = 1 AND `isDeleted` = 0 ORDER BY `languageCode` ASC, `title` ASC";
        $results = ipDb()->fetchAll( $sql );
        foreach( $results as $result ) {
            $allPages[$result['parentId']][$result['id']] = $result;
        }

        $returnData = makeMenu( 0, $allPages, 0, $multilanguage );
        
        return $returnData;
    }
}

function makeMenu( $target, $allPages, $level, $multilanguage ) {
    $return = array();
    if( !empty( $allPages[$target] ) ) {
        foreach( $allPages[$target] as $id => $page ) {
            if( !empty( $allPages[$id] ) ) {
                $title =  str_repeat( "__", $level) . $page['title'];
                if( empty( $multilanguage ) ) {
                    $title  = "{$page['languageCode']}: {$title}";
                }
                if( empty( $page['alias'] ) ) {
                    $return[] = array( false, $title . ' (w/o Alias)' );
                } else {
                    $return[] = array( $page['alias'], $title );
                }
                $return = array_merge( $return, makeMenu( $id, $allPages, $level+1, $multilanguage ) );
            }
        }
    }
    return $return;
}
