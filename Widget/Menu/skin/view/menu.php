<?php if( !empty( $data ) ): ?>
    <ul class="<?php echo $data['menu']['class']; ?>">
        <?php $i = 0; if( !empty( $data['items'] ) ): $items = $data['items']; ?>
            <?php foreach( $items as $item ): $i++; ?>
                <li <?php echo $item->isCurrent() ? 'class="'.$data['menu']['active'].'"' : null; ?>>
                    <a href="<?php echo $item->getUrl(); ?>">
                        <?php if( !empty( $data['icon']['enable'] ) ): ?>
                            <?php 
                                if( ipIsManagementState() ) {
                                    $defaultImage = "http://dummyimage.com/{$data['icon']['width']}x{$data['icon']['height']}/f5f5f5/888";
                                } elseif( !empty( $data['icon']['empty'] ) ) {
                                    $defaultImage = ipFileUrl( 'Plugin/AsdMenuWidget/Widget/Menu/assets/empty.png' );
                                } else {
                                    $defaultImage = '';
                                }
                            ?>
                            <span class="icon-place"><?php echo ipSlot( 'image', array( 'id' => "asd-menu-item-image-{$data['menu']['name']}-{$depth}-{$i}", 'pageId' => $data['menu']['pageId'], 'height' => $data['icon']['height'], 'width' => $data['icon']['width'], 'default' => $defaultImage ) ); ?></span>
                            <?php if( !empty( $data['icon']['text'] ) ): ?>
                                <?php echo $item->getTitle(); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo $item->getTitle(); ?>
                        <?php endif; ?>
                    </a>
                    <?php $data['menu']['class'] = $data['menu']['parent']; $data['items'] = $item->getChildren(); if( !empty( $data['items'] ) && ( empty( $data['menu']['depth'] ) || $depth < $data['menu']['depth'] ) ): ?>
                        <?php echo ipView( 'menu.php', array( 'data' => $data, 'depth' => $depth+1 ) )->render(); ?>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
<?php endif; ?>