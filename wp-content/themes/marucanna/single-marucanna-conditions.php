<?php get_header(); ?>

<section class="section mc-title-section style_1" style=" <?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">PAIN RELIEF</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>
    </div>
</section>

<section class="section single-content-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 content_wrap">
			<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>  
  
<?php the_content(); ?>
<?php endwhile; ?>
<?php endif; ?>
			
			
			
               

            </div>
            <div class="col-md-5 col-sm-12 sidebar_wrap">
			<?php $sidebar_image = get_field( 'sidebar_image' ); ?>
			<?php if ( $sidebar_image ) { ?>
                <div class="img_wrap">
                   <?php echo wp_get_attachment_image( $sidebar_image, 'siderbar-thumb' ); ?>
                </div>
				<?php } ?>
				<?php if ( have_rows( 'sidebar_content_box_rep' ) ) : ?>
	<?php while ( have_rows( 'sidebar_content_box_rep' ) ) : the_row(); ?>
                <div class="box_content text-center">
                    <h3><?php the_sub_field( 'title' ); ?></h3>
                    <div class="description">
					<?php the_sub_field( 'content' ); ?>
                       
                    </div>
					<?php if ( get_sub_field( 'button_text') ) : ?>
                    <div class="btn_wrap">
                        <a href="<?php the_sub_field( 'button_link' ); ?>" class="btn style_1"><?php the_sub_field( 'button_text' ); ?></a>
                    </div>
					
<?php endif; ?>
                </div>
				<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="section text-block-section">
    <div class="container">
        <div class="title_wrap">
            <h3>How to manage persistent discomfort</h3>
        </div>
        <div class="description">
            <p><small>Medications for treating persistent discomfort</small></p>
            <p>Chronic pain can be treated with a wide range of drugs, including those bought over-the-counter from a pharmacy. Pharmacies in the UK provide what are known as "over-the-counter" medicines; supermarkets offer these as well. Below are a few examples of these:</p>
        </div>
        <div class="btn_wrap">
            <a data-bs-toggle="collapse" href="#conditionDetails" role="button" aria-expanded="false" aria-controls="conditionDetails" class="btn btn_link condition_details">READ MORE</a>
        </div>

        <div class="collapse collapse_detail" id="conditionDetails">
            <div class="content">
                <h3>Sed consectetur sollicitudin velit vitae consequat</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu suscipit felis. Etiam et orci ut lectus elementum interdum. Suspendisse turpis tellus, vulputate id placerat at, mattis ac diam. </p>

                <p>onec mauris nisi, porttitor vitae arcu quis, lobortis efficitur magna. Etiam sapien erat, rhoncus eget vehicula sed, vulputate vel diam. Nullam eu tellus eros. Sed suscipit tempus elit, a varius quam aliquet et. Nulla commodo sem leo, ut tristique neque pretium vitae.</p>

                <p>Pellentesque id lacinia quam, viverra varius turpis. Morbi molestie elementum euismod. Etiam lacinia vulputate diam, a tempus quam egestas in. Maecenas bibendum vel libero et eleifend. Praesent egestas ullamcorper arcu id laoreet. Vestibulum ut luctus quam, a iaculis odio. Cras augue dui, faucibus sit amet ante et, porta commodo elit. Praesent id lacus ullamcorper, condimentum elit quis, venenatis tellus. </p>
            </div>
            <div class="btn_wrap">
                <a href="#" class="btn style_4">CHECK ELIGIBILITY</a>
            </div>
        </div>

    </div>
</section>

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

<script>
jQuery(document).ready(function($) {

    $('.condition_details').on('click' , function(){
        $(this).parent().hide();
    })

});
</script>
<?php get_footer(); ?>