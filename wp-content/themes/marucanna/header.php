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
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pain Relief</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Pain relief</a></li>
							<li><a class="dropdown-item" href="#">Check eligibility</a></li>
							<li><a class="dropdown-item" href="#">Prescriptions</a></li>
							<li><a class="dropdown-item" href="#">Pain relief</a></li>
							<li><a class="dropdown-item" href="#">Check eligibility</a></li>
							<li><a class="dropdown-item" href="#">Prescriptions</a></li>
							<li><a class="dropdown-item" href="#">Pain relief</a></li>
							<li><a class="dropdown-item" href="#">Check eligibility</a></li>
							<li><a class="dropdown-item" href="#">Prescriptions</a></li>
							<li><a class="dropdown-item" href="#">Pain relief</a></li>
							<li><a class="dropdown-item" href="#">Check eligibility</a></li>
							<li><a class="dropdown-item" href="#">Prescriptions</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">PRESCRIPTIONS</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Drop Down 1</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 2</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 3</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 4</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 5</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 6</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Pricing</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Drop Down 1</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 2</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 3</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 4</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 5</a></li>
							<li><a class="dropdown-item" href="#">Drop Down 6</a></li>
						</ul>
					</li>
				</ul>
				<a href="#" class="btn style_1">CHECK ELIGIBILITY</a>
				<a href="#" class="btn style_2">REPEAT ORDER</a>
			</div>
		</div>
	</nav>
</header>

<div class="page_container">