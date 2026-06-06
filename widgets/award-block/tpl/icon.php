

	<?php if( isset($icon[ 'value' ]) && !empty( $icon[ 'value' ] ) ){ ?>

	<a class="icon"
		<?php if( !empty( $url ) ): ?>
		<?php <?php unique_addons_print_link_target_attrs( $link ); ?>
		href="<?php echo esc_url( $url );?>"
		<?php endif ?>
	>
		<i class="<?php echo esc_attr( $icon[ 'value' ] );  ?>"></i>
	</a>

	<?php } ?>