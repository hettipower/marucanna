<?php 
/* Template Name: Partners Page */

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

<section class="section breadcrumb_wrap bg_gray">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
		    <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section partners_wrapper bg_gray">
    <div class="container">
        <div class="title-wrap text-center">
           
			<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>   
<?php the_content(); ?>
<?php endwhile; ?>
<?php endif; ?>
        </div>

        <div class="row partners">
			<?php if ( have_rows( 'pt_sec1_content_boxes_rep' ) ) : ?>
	<?php while ( have_rows( 'pt_sec1_content_boxes_rep' ) ) : the_row(); ?>
            <div class="col-md-4 col-12 icon-box">
                <div class="icon-box-inner">
					<?php $icon = get_sub_field( 'icon' ); ?>
		<?php if ( $icon ) { ?>
                    <div class="icon">
                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" title="<?php echo $icon['alt']; ?>"/>
                    </div>
					<?php } ?>
                    <div class="content">
                        <h3><?php the_sub_field( 'title' ); ?></h3>
                        <?php the_sub_field( 'content' ); ?>
                    </div>
                </div>
            </div>
			<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
            
           
        </div>
        
    </div>
</section>

<section class="section eligibility_wrap partnership_wrap">
    <div class="container">

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3><?php the_field( 'pt_form_box_title' ); ?></h3>
					<?php the_field( 'pt_form_box_content' ); ?>
                   
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper"><?php echo do_shortcode('[gravityform id="3" title="false"]'); ?></div>
        </div>
    
    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>