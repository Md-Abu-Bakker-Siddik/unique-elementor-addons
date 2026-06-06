<?php if (substr($slave_tab_content_id, 0, 1) !== '#') { $slave_tab_content_id = '#' . $slave_tab_content_id; } ?>
<div class="tm-interactive-tabs tabs-default <?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-tab-content-id="<?php echo esc_attr( $slave_tab_content_id ); ?>">
    <ul class="features-list tab-buttons">
    <?php
    foreach ($list_items as $index => $item) :
        $tab_count = $index + 1;
        $class_item = 'each-item elementor-repeater-item-' . $item['_id'];
        ?>
        <li class="tab-btn <?php if($item['activate'] === 'yes') { echo esc_attr( 'active-btn' ); }?> <?php echo esc_attr( $class_item) ?>" data-tab=".interactive-tabs-item-<?php echo esc_attr( $tab_count) ?>">
            <?php echo esc_html( $item['title'] ); ?> <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true', 'class' => 'icon' ] ); ?>
        </li>
    <?php endforeach; ?>
	</ul>
</div>
