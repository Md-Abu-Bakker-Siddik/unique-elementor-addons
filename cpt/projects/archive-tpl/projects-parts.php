<section>
  <div class="<?php echo esc_attr( $container_type ); ?>">
  	<div class="main-content-area">
			<?php
				unique_addons_get_project_layout();
			?>
			<div class="pagination-wrapper">
				<?php
					unique_addons_get_pagination();
				?>
			</div>
		</div>
  </div>
</section>