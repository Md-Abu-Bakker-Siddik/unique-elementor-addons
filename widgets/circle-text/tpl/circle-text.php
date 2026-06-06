
<div class="tm-circle-text animate-2">
		<div class="icon">
			<?php
			// Get the center content type (default to 'icon' for backward compatibility)
			$center_content_type = isset($center_content_type) ? $center_content_type : 'icon';

			// Display content based on selected type
			switch ($center_content_type) {
				case 'text':
					// Display inner text
					if( isset($inner_text) && !empty($inner_text) ) {
						echo '<span class="inner-text">' . esc_html($inner_text) . '</span>';
					}
					break;

			case 'video':
				// Display video popup link
				if( isset($popup_video_url) && !empty($popup_video_url) ) {
					echo '<a data-lightbox="iframe" href="' . esc_url($popup_video_url) . '" class="video-popup-link lightgallery-trigger">';
					echo '<i class="fas fa-play"></i>';
					echo '</a>';
				}
				break;

				case 'image':
					// Display thumbnail image
					if( isset($thumb_image) && !empty($thumb_image['id']) ) {
						$image = wp_get_attachment_image_src( $thumb_image['id'], 'full');
						echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr__('Image', 'unique-elementor-addons') . '">';
					}
					break;

				case 'icon':
				default:
					// Display icon
					if( isset($icon['value']) && !empty($icon['value']) ) {
						echo '<i class="' . esc_attr($icon['value']) . '"></i>';
					}
					break;
			}
			?>
		</div>
		<span>
			<svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<path id="circlePath"
						d="M100,100 m-80,0 a80,80 0 1,1 160,0 a80,80 0 1,1 -160,0" />
				</defs>
				<text letter-spacing="6" text-anchor="middle">
					<textPath href="#circlePath" startOffset="50%">
						<?php echo esc_html( $circle_text_title ?? '' ); ?>
					</textPath>
				</text>
			</svg>
		</span>
</div>

