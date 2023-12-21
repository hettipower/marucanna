<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
	
	<?php if ( get_field( 'page_title' ) ) { ?>
	<h1><?php the_field( 'page_title' ); ?></h1>
	<?php } else { ?>
        <h1><?php the_title(); ?></h1>
		<?php }  ?>
    </div>
</section>

<section class="section breadcrumb_wrap">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
		    <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section blog_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 order-md-2 blog_content">
                <div class="blog-img">
                    <img src="<?php bloginfo( 'template_url' ); ?>/img/header.jpg" class="rounded img-fluid" alt="...">
                </div>
                <div class="blog_content">
                    <div class="date">2023 Desember 10</div>
                    <h3>Blog Title</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tristique nec leo eget aliquet. Maecenas eu orci ipsum. Ut fermentum nunc erat, vitae ornare lectus placerat at. Vivamus eu nunc purus. Sed nec mollis lorem. Proin quis malesuada quam. Fusce sed mi eu odio vestibulum suscipit. Nullam rutrum porttitor ultrices. Nulla venenatis dui accumsan urna efficitur iaculis. Nunc sit amet ligula iaculis, facilisis nibh nec, consequat mi. Nullam vestibulum non elit eu congue. Pellentesque rhoncus eget purus vitae egestas. Fusce venenatis quam eget libero sodales eleifend. Suspendisse bibendum dignissim velit, a aliquet odio bibendum vitae. Suspendisse vehicula rutrum tortor, eget accumsan quam vehicula id. </p>

                    <p>Donec nulla erat, imperdiet vel nibh at, scelerisque accumsan libero. Suspendisse a mi et justo suscipit porttitor vel non metus. Nunc et dictum nibh, quis elementum augue. Sed aliquam eu ligula ac vulputate. Sed pretium nisl ac porta maximus. Duis id magna urna. Nunc porttitor id quam quis dictum. Suspendisse imperdiet malesuada ipsum in sollicitudin. Phasellus eleifend, tellus id dignissim pharetra, lacus ante hendrerit justo, nec feugiat diam eros ultrices massa. Sed sed tristique felis, in gravida nisi. Cras mauris dolor, pharetra ac facilisis vel, fermentum eu arcu. Phasellus ac tellus purus. Sed sed felis eget ipsum pharetra commodo. Praesent quis risus dolor. Nunc ac feugiat risus, sit amet mollis ante. </p>

                    <p>Sed rutrum est at imperdiet viverra. Proin mattis nunc non quam aliquam imperdiet. Nullam fringilla feugiat ultrices. Praesent leo sapien, dictum sit amet tristique vitae, porttitor vel mi. Vivamus gravida diam quam, ac tempor felis lobortis eget. Curabitur sit amet gravida turpis. Duis ullamcorper arcu nulla, ut ultrices est porttitor a. Integer dapibus et purus at viverra. Proin vel dolor tempor, rhoncus mi vitae, iaculis libero. Morbi fermentum lacus eget auctor tempor. Sed at ultrices nisi. Praesent non eros eu risus dapibus consectetur sit amet nec mauris. Cras lorem ante, tincidunt id gravida vitae, malesuada vel ex. </p>
                </div>
            </div>
            
            <?php get_template_part( 'template-part/blog', 'sidebar' ); ?>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>