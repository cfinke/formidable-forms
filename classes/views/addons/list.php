<div class="frm_wrap" id="frm-addons-page">
	<?php
	FrmAppHelper::get_admin_header(
		array(
			'label' => __( 'Formidable Add-Ons', 'formidable' ),
		)
	);
	?>
	<div class="wrap">

	<?php include( FrmAppHelper::plugin_path() . '/classes/views/shared/errors.php' ); ?>

	<div id="the-list" class="frm-addons">
		<?php foreach ( $addons as $slug => $addon ) { ?>
			<div class="frm-card plugin-card-<?php echo esc_attr( $slug ); ?> frm-no-thumb frm-addon-<?php echo esc_attr( $addon['status']['type'] ); ?>">
				<div class="plugin-card-top">
					<?php if ( strtotime( $addon['released'] ) > strtotime( '-90 days' ) ) { ?>
						<div class="frm_ribbon">
							<span>New</span>
						</div>
					<?php } ?>
					<h2>
						<?php echo esc_html( $addon['title'] ); ?>
					</h2>
					<p>
						<?php echo esc_html( $addon['excerpt'] ); ?>
						<?php if ( isset( $addon['docs'] ) && ! empty( $addon['docs'] ) && $addon['installed'] ) { ?>
							<br/><a href="<?php echo esc_url( $addon['docs'] ); ?>" target="_blank" aria-label="<?php esc_attr_e( 'View Docs', 'formidable' ); ?>">
								<?php esc_html_e( 'View Docs', 'formidable' ); ?>
							</a>
						<?php } ?>
					</p>
					<?php
					$plan_required = FrmFormsHelper::get_plan_required( $addon );
					FrmFormsHelper::show_plan_required( $addon, $pricing . '&utm_content=' . $addon['slug'] );
					?>
				</div>
				<div class="plugin-card-bottom">
					<span class="addon-status">
						<?php
						printf(
							/* translators: %s: Status name */
							esc_html__( 'Status: %s', 'formidable' ),
							'<span class="addon-status-label">' . esc_html( $addon['status']['label'] ) . '</span>'
						);
						?>
					</span>
					<?php if ( $addon['status']['type'] === 'installed' ) { ?>
						<a rel="<?php echo esc_attr( $addon['plugin'] ); ?>" class="button button-primary frm-button-primary frm-activate-addon <?php echo esc_attr( empty( $addon['activate_url'] ) ? 'frm_hidden' : '' ); ?>">
							<?php esc_html_e( 'Activate', 'formidable' ); ?>
						</a>
					<?php } elseif ( isset( $addon['url'] ) && ! empty( $addon['url'] ) ) { ?>
						<a class="frm-install-addon button button-primary frm-button-primary" rel="<?php echo esc_attr( $addon['url'] ); ?>" aria-label="<?php esc_attr_e( 'Install', 'formidable' ); ?>">
							<?php esc_html_e( 'Install', 'formidable' ); ?>
						</a>
					<?php } elseif ( ! empty( $license_type ) && $license_type === strtolower( $plan_required ) ) { ?>
						<a class="install-now button button-secondary frm-button-secondary" href="<?php echo esc_url( FrmAppHelper::admin_upgrade_link( 'addons', 'account/licenses/' ) . '&utm_content=' . $addon['slug'] ); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Upgrade Now', 'formidable' ); ?>">
							<?php esc_html_e( 'Renew Now', 'formidable' ); ?>
						</a>
					<?php } else { ?>
						<a class="install-now button button-secondary frm-button-secondary" href="<?php echo esc_url( $pricing . '&utm_content=' . $addon['slug'] ); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Upgrade Now', 'formidable' ); ?>">
							<?php esc_html_e( 'Upgrade Now', 'formidable' ); ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</div>
