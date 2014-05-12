<?php if( !empty( $data ) ): ?>
    <?php 
        $data['items'] = \Ip\Menu\Helper::getMenuItems( $data['menu']['name'] );
        echo ipView('view/menu.php', array( 'data' => $data, 'depth' => 1 ))->render(); 
    ?>
<?php endif; ?>