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

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header>
	
</header>

<div class="page_container">