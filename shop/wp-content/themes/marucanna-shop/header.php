<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|',true,'right');?><?php bloginfo('name');?></title>

	<link href="//www.google-analytics.com" rel="dns-prefetch">
	
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favs/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favs/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favs/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favs/site.webmanifest">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favs/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#0c8e35">
	<meta name="theme-color" content="#ffffff">


	<link href="<?php echo get_template_directory_uri(); ?>/img/favs/favicon.png" rel="shortcut icon">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php if (!defined('WPSEO_VERSION')) { ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php } ?>

	<script>
		FontAwesomeConfig = {
			searchPseudoElements: true
		};
		window.FontAwesomeConfig = {
			autoReplaceSvg: false
		}
	</script>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header>
	<div class="logo_wrap d-none d-lg-block">
		<div class="container">
			<a class="navbar-brand" href="<?php echo home_url(); ?>">
				<?php
					$site_logo = get_field('site_logo' , 'option');
					if( $site_logo ): 
				?>
					<img src="<?php echo $site_logo['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				<?php endif; ?>
			</a>
		</div>
	</div>
	<div class="top_navbar">
		<div class="container"><?php the_field( 'top_bar_content', 'option' ); ?></div>
	</div>
	<div class="middle_navbar">
		<div class="container">

			<div class="logo_shadow">
				<div class="logo_wrap d-block d-md-block d-lg-none">
					<a class="navbar-brand" href="<?php echo home_url(); ?>">
						<?php
							$site_logo = get_field('site_logo' , 'option');
							if( $site_logo ): 
						?>
							<img src="<?php echo $site_logo['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
						<?php endif; ?>
					</a>
				</div>
			</div>

			<?php get_template_part( 'template-part/top', 'search' ); ?>

			<div class="right_nav">
				<?php get_template_part( 'template-part/secondary', 'menu' ); ?>
			</div>
		</div>
	</div>

	<nav class="bottom_navbar navbar navbar-expand-lg">
		<div class="container">

			<?php get_template_part( 'template-part/top', 'search' ); ?>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mainNavbar">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'items_wrap'      => '<ul class="navbar-nav">%3$s</ul>',
						'walker'       => new MC_Header_Menu_Walker(),
					));
				?>
			</div>

		</div>
	</nav>

</header>

<div class="page_container">