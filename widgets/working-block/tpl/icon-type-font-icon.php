<?php
if ( empty( $icon['value'] ) ) {
	return;
}

ob_start();
\Elementor\Icons_Manager::render_icon( $icon, array( 'aria-hidden' => 'true' ) );
$icon_html = ob_get_clean();

// Elementor renders uploaded SVG icons as <img> — convert to mask so hover color works.
if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $icon_html, $matches ) ) {
	$src    = $matches[1];
	$style  = '--wb-icon-url: url("' . esc_url( $src ) . '");';
	$width  = 52;
	$height = 52;

	if ( preg_match( '/\bwidth=["\'](\d+)["\']/i', $icon_html, $w_match ) ) {
		$width = (int) $w_match[1];
	}
	if ( preg_match( '/\bheight=["\'](\d+)["\']/i', $icon_html, $h_match ) ) {
		$height = (int) $h_match[1];
	}

	$style .= 'width:' . $width . 'px;height:' . $height . 'px;';

	printf(
		'<span class="working-block-icon-mask" style="%s" role="img" aria-hidden="true"></span>',
		esc_attr( $style )
	);
} else {
	echo $icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
