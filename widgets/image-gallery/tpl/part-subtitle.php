<?php if( !empty( $subtitle ) ) : ?>
<div class="gallery-bottom-wrapper">
	<<?php echo esc_attr( $subtitle_tag );?> class="sub-title">
		<?php echo esc_html( $subtitle ); ?>
	</<?php echo esc_attr( $subtitle_tag );?>>
</div>
<?php endif; ?>