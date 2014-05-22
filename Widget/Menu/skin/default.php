<?php if( !empty( $data ) ): ?>
    <?php 
        $data['items'] = \Ip\Menu\Helper::getMenuItems( $data['menu']['name'] );
        echo ipView('view/menu.php', array( 'data' => $data, 'depth' => 1 ))->render(); 
    ?>
<?php elseif( ipIsManagementState() ): ?>
    <div style="text-align: center; border: 1px solid #CDCDCD;">
        <span style="color: #D1D1D1;"><small><?php echo __( 'On this page menu widget is hidden', 'AsdMenuWidget' ); ?></small></span>
    </div>
<?php endif; ?>