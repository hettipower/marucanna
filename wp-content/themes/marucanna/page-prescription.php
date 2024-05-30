<?php 
/* Template Name: Prescription Page */

get_header(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'hm_sec1_header_image' ) ) { ?>background-image: url(<?php the_field( 'hm_sec1_header_image' ); ?>);<?php } else { ?>background-image: url(<?php echo get_template_directory_uri(); ?>/img/home/header.webp); <?php } ?>">
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

<section class="section text-block-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h3><?php echo do_shortcode(get_field('prs_sec1_title')); ?></h3>
            <div class="description">
                <?php the_field( 'prs_sec1_content' ); ?>
            </div>
        </div>
    </div>
</section>

<section class="section conditions-list-section">
    <div class="container">
        <div class="title_wrap">
            <h3><?php echo do_shortcode(get_field('prs_sec1_title_2')); ?></h3>
        </div>
        <div class="condition_list_wrap">
            <?php the_field( 'prs_sec1_content_2' ); ?>

        </div>
    </div>
</section>

<section class="section text-block-section">
    <div class="container">
        <div class="title_wrap">
            <h3><?php echo do_shortcode(get_field('prs_sec2_title')); ?></h3>
            <div class="description">
               <?php the_field( 'prs_sec2_content' ); ?>

                
            </div>
        </div>
    </div>
</section>

<?php
while( have_rows('prs_sec2_content_boxes_rep') ): the_row();

    if( get_row_index() % 2 == 0 ){
    ?>
    
    <section class="section image_text_block style_2">
    <div class="container">
        <div class="row">
		<?php 
		$image = get_sub_field('image');
		
		if ( $image ) { 
			// Image variables.
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];		
			
			
			?>
								  
            <div class="col-md-4 col-sm-12 image_wrapper">
				<img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>" title="<?php echo esc_attr($title); ?>"/>
            </div>
            <?php } ?>
			
            <div class="col-md-8 col-sm-12 content_wrapper">
                <h3><?php the_sub_field( 'title' ); ?></h3>
                <?php the_sub_field( 'content' ); ?>
            </div>
        </div>
    </div>
</section>
    
    <?php
     } else{
  ?>   
  <section class="section image_text_block style_1">
    <div class="container">
        <div class="row">
		<?php
         $image = get_sub_field('image');
		
		
		
		if ( $image ) {
			
		// Image variables.
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];	
			
			
			?>
			
			
            <div class="col-md-4 col-sm-12 image_wrapper">
				<img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>" title="<?php echo esc_attr($title); ?>"/>
            </div>
            <?php } ?>
			
            <div class="col-md-8 col-sm-12 content_wrapper">
                 <h3><?php the_sub_field( 'title' ); ?></h3>
                <?php the_sub_field( 'content' ); ?>
            </div>
        </div>
    </div>
</section>
  
   <?php
     } endwhile;
  ?>   
  
  
    
<section class="section faq-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2><?php the_field( 'faq_title' ); ?></h2>
        </div>

        <div class="faqs row g-3">
			<?php if ( have_rows( 'faq_rep' ) ) : ?>
	<?php while ( have_rows( 'faq_rep' ) ) : the_row(); ?>
            <div class="faq-item">
                <h3><?php the_sub_field( 'question' ); ?></h3>
                <div class="content"><?php the_sub_field( 'answer' ); ?> </div>
            </div>
<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
          

        
        </div>

    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>