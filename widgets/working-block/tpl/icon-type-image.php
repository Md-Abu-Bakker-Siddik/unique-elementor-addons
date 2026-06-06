<?php
$image      = wp_get_attachment_image_src( $working_block_image['id'], $working_block_image_size );
$image_alt  = get_post_meta( $working_block_image['id'], '_wp_attachment_image_alt', true );
$image_hover = ! empty( $working_block_image_hover['id'] )
	? wp_get_attachment_image_src( $working_block_image_hover['id'], $working_block_image_size )
	: false;

if ( empty( $image[0] ) ) {
	return;
}

$width  = ! empty( $image[1] ) ? (int) $image[1] : 52;
$height = ! empty( $image[2] ) ? (int) $image[2] : 52;
$style  = '--wb-icon-url: url("' . esc_url( $image[0] ) . '");width:' . $width . 'px;height:' . $height . 'px;';
?>
<span
	class="working-block-icon-mask working-block-icon-mask-default"
	style="<?php echo esc_attr( $style ); ?>"
	role="img"
	aria-label="<?php echo esc_attr( $image_alt ); ?>"
></span>
<?php if ( ! empty( $image_hover[0] ) ) : ?>
<span
	class="working-block-icon-mask working-block-icon-mask-hover"
	style="<?php echo esc_attr( '--wb-icon-url: url("' . esc_url( $image_hover[0] ) . '");width:' . $width . 'px;height:' . $height . 'px;' ); ?>"
	role="img"
	aria-hidden="true"
></span>
<?php endif; ?>
