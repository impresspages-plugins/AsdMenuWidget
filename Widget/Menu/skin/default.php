<?php if( !empty( $data ) ): ?>
    <?php $offers = \Ip\Menu\Helper::getMenuItems( $data['menu']['name'] ); ?>
    <ul class="<?php echo $data['menu']['class']; ?>">
        <?php $i = 1; if( !empty( $offers ) ): ?>
            <?php foreach( $offers as $offer ): ?>
                <li <?php echo $offer->isCurrent() ? 'class="'.$data['menu']['active'].'"' : null; ?>>
                    <a href="<?php echo $offer->getUrl(); ?>">
                        <?php if( isset( $data['icon']['enable'] ) ): ?>
                           <span class="icon-place"><?php echo ipSlot( 'image', array( 'id' => 'menu-item-image-' . $data['menu']['name'] . '-' . $i++, 'pageId' => 10, 'height' => $data['icon']['height'], 'width' => $data['icon']['width'], 'default' => "http://dummyimage.com/{$data['icon']['width']}x{$data['icon']['height']}/f5f5f5/888" ) ); ?></span>
                        <?php endif; ?>
                        <?php echo $offer->getTitle(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif;?>
    </ul>
<?php endif; ?>