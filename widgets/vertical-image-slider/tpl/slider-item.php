<?php
/**
 * Slider Item Template
 */
if (!isset($slider_item)) {
	return;
}

// Get image
$image_id = isset($slider_item['image']['id']) ? $slider_item['image']['id'] : '';
$image_url = isset($slider_item['image']['url']) ? $slider_item['image']['url'] : '';
$image_size = !empty($slider_item['image_size']) ? $slider_item['image_size'] : (isset($featured_image_size) ? $featured_image_size : 'medium_large');

if ($image_id) {
	$image_html = wp_get_attachment_image($image_id, $image_size, false, array('class' => 'img-fluid'));
} else {
	$image_html = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($slider_item['title']) . '" class="img-fluid">';
}

// Get link
$link_url = '';
$link_array = array();

if (!empty($slider_item['link']['url'])) {
	$link_array = $slider_item['link'];
	$link_url = $slider_item['link']['url'];
}

?>
<div class="tm-vertical-image-slider-item">
	<div class="slider-image">
		<?php if (!empty($link_url)) : ?>
			<a href="<?php echo esc_url($link_url); ?>"<?php unique_addons_print_link_target_attrs( $link_array ); ?>>
				<?php unique_addons_print_template_html( $image_html ); ?>
			</a>
		<?php else : ?>
			<?php unique_addons_print_template_html( $image_html ); ?>
		<?php endif; ?>
	</div>

	<?php if (isset($show_title) && $show_title === 'yes' && !empty($slider_item['title'])) : ?>
		<div class="slider-title-wrapper">
			<h3 class="slider-title"><?php echo esc_html($slider_item['title']); ?></h3>
		</div>
	<?php endif; ?>
</div>


