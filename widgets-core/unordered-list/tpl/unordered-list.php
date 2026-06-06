<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php echo wp_kses( $content, array(
		'ol' => array(
			'class' => true,
		),
		'ul' => array(
			'class' => true,
		),
		'li' => array(
			'class' => true,
		),
		'span' => array(
			'class' => true,
		),
		'strong' => array(
			'class' => true,
		),
		'em' => array(
			'class' => true,
		)
	) ); ?>
</div>