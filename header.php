<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ecom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'ecom'); ?></a>

		<div class="announcement-bar pt-2 pb-2 ">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<ul class="announcement-bar__list">
							<li>
								<i class="bi bi-telephone rounded-circle"></i>
								<a href="tel:+91-123-456565">+91-123-456565</a>
							</li>
							<li>
								<i class="bi bi-envelope rounded-circle"></i>
								<a href="mail:hello@ecom.local">hello@ecom.local</a>
							</li>
						</ul>
					</div>
					<div class="col-md-8 d-flex justify-content-end">
						<ul class="announcement-bar__list">
							<li>
								<i class="bi bi-truck rounded-circle"></i>
								Free Shipping
							</li>
							<li>
								<i class="bi bi-clock-history rounded-circle"></i>
								30 DAY MONEYBACK GUARANTEE
							</li>
							<li>
								<i class="bi bi-person rounded-circle"></i>
								24/7 CUSTOMER SUPPORT
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if (is_front_page() && is_home()) :
				?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				else :
				?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				$ecom_description = get_bloginfo('description', 'display');
				if ($ecom_description || is_customize_preview()) :
				?>
					<p class="site-description">
						<?php echo $ecom_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
					</p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'ecom'); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->