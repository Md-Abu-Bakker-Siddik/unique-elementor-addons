<div class="tm-interactive-tabs-content">
  <?php foreach ($list_items as $index => $item) : 
        $tab_count = $index + 1;
?>
        <div class="tab interactive-tabs-item-<?php echo esc_attr( $tab_count) ?>">
        <?php
            if ( $item['tabs_content_type'] == 'content' ) {
                echo wp_kses_post( do_shortcode( $item['tabs_content'] ) );
            } else if ( $item['tabs_content_type'] == 'template' ) {
                $id = $item['tabs_content_templates'];
                $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($id);
                echo wp_kses_post( $content );
            }
        ?>
        </div>
    <?php endforeach; ?>
</div>
