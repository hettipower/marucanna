<?php 
/* Template Name: Team Page */

get_header(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
	
	<?php if ( get_field( 'page_title' ) ) { ?>
	<h1><?php the_field( 'page_title' ); ?></h1>
	<?php } else { ?>
		<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>   
        <h1><?php the_title(); ?></h1>
		<?php endwhile; ?>
<?php endif; ?>
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

<section class="section team_wrapper">
    <div class="container">
        <div class="title_wrap text-center">
            	<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>   
        <h1><?php the_content(); ?></h1>
		<?php endwhile; ?>
<?php endif; ?>
            
        </div>
        <?php if ( have_rows( 'team_fc' ) ): ?>
	<?php while ( have_rows( 'team_fc' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'profiles_lo' ) : ?>
        <div class="grid team_wrap">
            
            <h4 class="g-col-12 title text-center"><?php the_sub_field( 'heading' ); ?></h4>
            <?php $post_objects = get_sub_field( 'profiles' ); ?>
			<?php if ( $post_objects ): ?>
				<?php foreach ( $post_objects as $post ):  ?>
				<?php setup_postdata( $post ); ?>
				<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'doc-home-thumb', true);
?>
            <div class="item g-col-md-4 g-col-6">
                <?php if ( has_post_thumbnail() ) {?>
                <div class="image">
                    <img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>" title="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>"/>
                </div>
                	<?php } ?>
                <div class="name"><?php the_title(); ?></div>
                <div class="position"><?php the_field( 'specialization' ); ?></div>
                <a href="<?php the_permalink(); ?>" class="overlay"></a>
            </div>
            <?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

           

           
            
        </div>
        <?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>

       
        
    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>