<a
<?php <?php unique_addons_print_link_target_attrs( $link ); ?>
href="<?php echo esc_url( $url );?>" class="tm-app-btn">
	<span class="title"><?php echo esc_html( $title );?></span>
	<div class="icon">
		<?php if( isset($icon[ 'value' ]) && !empty( $icon[ 'value' ] ) ){ ?>
			<i class="<?php echo esc_attr( $icon[ 'value' ] );  ?>"></i>
		<?php } ?>
	</div>
</a>