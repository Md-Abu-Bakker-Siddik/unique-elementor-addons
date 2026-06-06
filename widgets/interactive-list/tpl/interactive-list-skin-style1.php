<!-- Feature Block -->
<?php $settings['settings'] = $settings;?>
<div class="tm-interactive-list <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<h2 class="list">
    <?php
    foreach ($list_items as $index => $item) :
        $tab_count = $index + 1;
        $class_item = 'each-item elementor-repeater-item-' . $item['_id'];
        $attachment = wp_get_attachment_image_src( $item['feature_image']['id'], $image_size );



        //link url
        $target = ( $item['link'] && $item['link']['is_external'] ) ? ' target="_blank"' : '';
        $url = ( $item['link'] && $item['link']['url'] ) ? $item['link']['url'] : '';

        ?>
    	<div class="<?php echo esc_attr( $class_item) ?>">
            <?php echo esc_html( $item['title'] ); ?>
            <a class="fancybox hover-img" href="<?php echo esc_url( $url ); ?>"><img src="<?php echo esc_url( $attachment[0] ); ?>" alt=""></a>
        </div>
    <?php endforeach; ?>
	</h2>
</div>


