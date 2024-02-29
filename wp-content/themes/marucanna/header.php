<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|',true,'right');?><?php bloginfo('name');?></title>

	<link href="//www.google-analytics.com" rel="dns-prefetch">
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
	<?php if ( get_field( 'additional_scripts' ) ) { ?>
	
	<?php the_field( 'additional_scripts' ); ?>
	
	<?php } ?>

	<?php wp_head(); ?>

</head>
<?php
$source_type = get_field( 'source_type' );
$source_class = '';
if( $source_type != 'none' && isset($source_type) ) {
	$source_class = 'page-has-related-articles';
}
?>
<body <?php body_class($source_class); ?>>

<header>
	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo home_url(); ?>">
				<?php
					$site_logo = get_field('site_logo' , 'option');
					if( $site_logo ): 
				?>
					<img src="<?php echo $site_logo['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				<?php endif; ?>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenuWrap" aria-controls="mainMenuWrap" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mainMenuWrap">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'items_wrap'      => '<ul class="navbar-nav">%3$s</ul>',
						'walker'       => new MC_Header_Menu_Walker(),
					));
				?>
				<a href="<?php echo home_url('check-eligibility'); ?>" class="btn style_1">CHECK ELIGIBILITY</a>
				<?php 
					if (is_user_logged_in()): 
						$user = wp_get_current_user();
    					$allowed_roles = array( 'patient', 'administrator' );
						if ( array_intersect( $allowed_roles, $user->roles ) ) :
				?>
					<a href="<?php echo home_url('patient-dashboard'); ?>" class="btn style_2">REPEAT ORDER</a>
					<?php endif; ?>
				<?php else: ?>
					<a href="<?php echo home_url('login'); ?>" class="btn style_2">REPEAT ORDER</a>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>

<div class="page_container">