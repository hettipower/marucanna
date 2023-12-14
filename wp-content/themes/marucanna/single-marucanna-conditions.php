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

        <div class="single_content clearfix">
            <div id="single_sidebar" class="col-md-5 col-sm-12 float-md-end sidebar_wrap">
			    <?php 
                    $sidebar_image = get_field( 'sidebar_image' );
                    if ( $sidebar_image ) { 
                ?>
                    <div class="img_wrap">
                    <?php echo wp_get_attachment_image( $sidebar_image, 'siderbar-thumb' ); ?>
                    </div>
				<?php } ?>
				<?php if ( have_rows( 'sidebar_content_box_rep' ) ) : while ( have_rows( 'sidebar_content_box_rep' ) ) : the_row(); ?>
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
				<?php endwhile; endif; ?>
            </div>

            
            <?php 
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content(); 
                endwhile; endif; 
            ?>

            <div class="btn_wrap">
                <a href="#" class="btn style_4">CHECK ELIGIBILITY</a>
            </div>

        </div>

        <div class="btn_wrap">
            <a href="#" class="btn btn_link show_single_content">READ MORE</a>
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

    $('.show_single_content').on('click' , function(){

        $('.single_content').height('auto');
        $(this).parent().hide();

        return false;
    });

    var sidebarHeight = $('#single_sidebar').outerHeight(true);
    var containerHeight = sidebarHeight + 120;
    var windowWidth = $(window).width();

    if( windowWidth > 767 ) {
        $('.single_content').height(containerHeight);
    } else {
        $('.single_content').height(containerHeight + 400);
    }
    

});
</script>
<?php get_footer(); ?>