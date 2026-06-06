<div class="vertical-bg-img-list <?php echo esc_attr($column_class); ?>">
<?php
		$last_class = '';
		$count = 1;
		
		foreach ($slides as $slide) 
		{
			$last_class = '';
			if($count%$count_slides == 0)
			{
				$last_class = 'last-item';
			}
?>
		<div class="each-vertical-column <?php echo esc_attr($last_class); ?>">
			<div class="vertical-column-wrapper">
				<div class="content">
					<div class="content-top">
						<<?php echo esc_attr( $subtitle_tag );?> class="sub-title"><?php echo esc_html($slide['slide_subtitle']); ?></<?php echo esc_attr( $subtitle_tag );?>>
						<<?php echo esc_attr( $title_tag );?> class="title"><?php echo esc_html($slide['slide_title']); ?></<?php echo esc_attr( $title_tag );?>>
					</div>
					<div class="content-bottom">
						<div class="desc"><?php echo esc_html($slide['slide_description']); ?></div>
						<?php
							if(!empty($slide['slide_link']['url']))
							{
						?>
						<a
							<?php unique_addons_print_link_target_attrs( $slide['slide_link'] ); ?>
							href="<?php echo esc_url($slide['slide_link']['url']); ?>"
							class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
							<?php echo esc_html($slide['slide_link_title']); ?>
						</a>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-img <?php if($count == 1) { ?>hover<?php } ?>">
			<div class="bg-overlay"></div>
			<img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="" />
		</div>
<?php
			$count++;
		}
?>
</div>