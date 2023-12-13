<?php 
/* Template Name: Service Listing Page */

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

<section class="section condition-listing-block">
    <div class="container">
        <div class="search_wrap">
            <div class="input-group">
                <input type="text" class="form-control" id="search_condition" placeholder="Search Condition">
                <span class="input-group-text">
                    <button type="submit" class="btn" id="search_condition_submit">Search</button>
                </span>
            </div>
        </div>

        <div class="text">
		<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>   
<?php the_content(); ?>
<?php endwhile; ?>
<?php endif; ?>
           
        </div>

        <div class="condition_listing_wrap">
            <div class="condition_listing">
                <div class="row">
<?php $additional_loop = new WP_Query("post_type=marucanna-conditions&paged=$paged"); ?>
		
		
<?php while ($additional_loop->have_posts()) : $additional_loop->the_post(); ?>

<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'full', false);
?>	
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
						<?php if ( has_post_thumbnail() ) {?>
                            <img src="<?php echo $thumb_url[0]; ?>" alt="<?php the_title(); ?> "/>
							<?php } ?>
                            <h4><?php the_title(); ?></h4>
                            <a href="<?php the_permalink(); ?>" class="overlay"></a>
                        </div>
                    </div>
					
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>				

                 


                </div>
            </div>

            <div class="pagination_wrap">
                <nav>
				 <?php  kriesi_pagination($additional_loop->max_num_pages);?>
                   
                </nav>
            </div>
        </div>

    </div>
</section>

<section class="section pain-symptoms-wrap">
    <div class="container">
        <div class="title_wrap">
            <h3><?php the_field( 'rf_sec1_title' ); ?></h3>
        </div>
        
        <div class="row g-2 symptoms">
<?php if ( have_rows( 'rf_sec1_content_boxes_rep' ) ) : ?>
	<?php while ( have_rows( 'rf_sec1_content_boxes_rep' ) ) : the_row(); ?>
            <div class="col-md-4 col-sm-12">
                <div class="symptom"><?php the_sub_field( 'title' ); ?></div>
            </div>
				<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>

            
        </div>

    </div>
</section>

<section class="section text-block-section text-center">
    <div class="container">
        <div class="title_wrap">
            <h3><?php the_field( 'rf_sec1_title2' ); ?></h3>
        </div>
        <div class="description">
		<?php the_field( 'rf_sec1_content2' ); ?>
           
        </div>
    </div>
</section>

<section class="section pain-management">
    <div class="container">
        <div class="title_wrap text-center">
            <h3><?php echo do_shortcode(get_field('rf_sec2_title')); ?></h3>
        </div>
        
        <div class="row g-3 management_wrap">
<?php if ( have_rows( 'rf_sec2_content_boxes_rep' ) ) : ?>
	<?php while ( have_rows( 'rf_sec2_content_boxes_rep' ) ) : the_row(); ?>
            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number"><?php the_sub_field( 'no' ); ?></span>
                    <div class="content">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <div class="description"><?php the_sub_field( 'content' ); ?></div>
                    </div>
                </div>
            </div>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
           


            <div class="col-12 btn-wrap text-center mt-5">
                <a href="<?php the_field( 'rf_sec2_button_link' ); ?>" class="btn style_4"><?php the_field( 'rf_sec2_button_text' ); ?></a>
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
                <div class="content"><?php the_sub_field( 'answer' ); ?></div>
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

    $('#search_condition_submit').on('click' , function(){

        var search_condition = $('#search_condition').val();

        send_request(search_condition, 0, true);

        return false;
    });
    
    function send_request(condition_name = "", offset = 0, overrwite = true) {

        if (condition_name === undefined) {
            condition_name = '';
        }

        if (offset === undefined) {
            offset = '';
        }

        if (overrwite === undefined) {
            overrwite = true;
        }

        var json_url = '<?php echo api_url(); ?>conditions';

        jQuery.getJSON(json_url, {
            name: condition_name,
            offset: offset,
        })
        .done(function(json) {

            if (json['code'] == 'error') {
                jQuery('.condition_listing').html('<p>Something Went Wrong! Please Reload The Page.</p>');
            } else {

                if (json['data'] != '') {
                    if (overrwite) {
                        jQuery('.condition_listing').html(json['data']);
                    } else {
                        jQuery('.condition_listing').append(json['data']);
                    }
                }

            }
        })
        .always(function() {
        });

    }

});
</script>
<?php get_footer(); ?>