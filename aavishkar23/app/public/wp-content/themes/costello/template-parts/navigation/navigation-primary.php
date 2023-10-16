<?php

/**
 * Primary Menu Template
 *
 * @package Costello
 */

?>
<div id="site-header-menu" class="site-header-menu">

	<div id="primary-menu-wrapper" class="menu-wrapper">
		<div class="menu-toggle-wrapper">
			<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<?php echo costello_get_svg(array('icon' => 'bars'));
				echo costello_get_svg(array('icon' => 'close')); ?>
				<span class="menu-label"><?php echo esc_html_e('Menu', 'costello'); ?></span></button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">
			<button id="close-button" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<?php echo costello_get_svg(array('icon' => 'close-new')); ?>
				<span class="menu-label screen-reader-text"><?php echo esc_html_e('Close', 'costello'); ?></span>
			</button>

			<?php if (has_nav_menu('menu-1')) : ?>

				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'costello'); ?>">
					<?php
					wp_nav_menu(
						array(
							'container'      => '',
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu nav-menu',
						)
					);
					?>

				<?php else : ?>

					<nav id="site-navigation" class="main-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'costello'); ?>">
						<?php wp_page_menu(
							array(
								'menu_class' => 'primary-menu-container',
								'before'     => '<ul id="menu-primary-items" class="menu nav-menu">',
								'after'      => '</ul>',
							)
						); ?>

					<?php endif; ?>

					</nav><!-- .main-navigation -->

					<div class="mobile-social-search">
						
						<?php if (has_nav_menu('social-menu')) : ?>
							<div id="header-menu-social" class="menu-social"><?php get_template_part('template-parts/navigation/navigation', 'social'); ?></div>
						<?php endif; ?>

					</div><!-- .mobile-social-search -->
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->
</div><!-- .site-header-menu -->
