<?php 
/* Template Name: Home Page */

get_header(); ?>

<section class="section mc-title-section" style="<?php if ( get_field( 'hm_sec1_header_image' ) ) { ?>background-image: url(<?php the_field( 'hm_sec1_header_image' ); ?>);<?php } else { ?>background-image: url(<?php echo get_template_directory_uri(); ?>/img/home/header.webp); <?php } ?> ">
    <div class="container">
        <h1><?php the_field( 'hm_sec1_title' ); ?></h1>
        <a href="<?php the_field( 'hm_sec1_button_link' ); ?>" class="btn style_1"><?php the_field( 'hm_sec1_button_text' ); ?></a>
    </div>
</section>

<section class="section mc-image-text-block">
    <div class="container">
        <div class="row">
		
            <div class="col-md-6 col-sm-12 image_wrapper">
			<?php if ( get_field( 'hm_sec2_bg_image' ) ) { ?>
                <img src="<?php the_field( 'hm_sec2_bg_image' ); ?>"/>
				<?php } else {  ?>
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/about-image.webp"/>
				<?php } ?>
            </div>
			
            <div class="col-md-6 col-sm-12 content_wrapper">
                <h2><?php echo do_shortcode(get_field('hm_sec2_title')); ?></h2>
				<?php the_field( 'hm_sec2_content' ); ?>

                <div class="btn-wrapper">
                    <a href="<?php the_field( 'hm_sec2_button1_link' ); ?>" class="btn style_3"><?php the_field( 'hm_sec2_button1_text' ); ?></a>
                    <a href="<?php the_field( 'hm_sec2_button2_link' ); ?>" class="btn style_4"><?php the_field( 'hm_sec2_button2_text' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section how-it-works">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 content_wrap">
                <h2><?php echo do_shortcode(get_field('hm_sec3_title')); ?></h2>
                <div class="steps_wrap">
                    <div class="row">
					<?php

// check if the repeater field has rows of data
if( have_rows('steps_rep') ):
$i=0;
 	// loop through the rows of data
    while ( have_rows('steps_rep') ) : the_row(); $i++;
?>
                        <div class="col-md-6 col-sm-12 step">
                            <div class="num">STEP 0<?php echo $i; ?></div>
                            <h3><?php the_sub_field( 'title' ); ?></h3>
                           <?php the_sub_field( 'content' ); ?>
                        </div>
						
<?php

    endwhile;

else :

    // no rows found

endif;

?>						
						
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 image_wrap">
                <div class="image">
				<?php if ( get_field( 'hm_sec3_bg_image' ) ) { ?>
                    <img src="<?php the_field( 'hm_sec3_bg_image' ); ?>"/>
					<?php } else {?>
					 <img src="<?php echo get_template_directory_uri(); ?>/img/home/how-it-work.webp"/>
					 <?php } ?>
                </div>
                <a href="<?php the_field( 'hm_sec3_button1_link' ); ?>" class="btn style_4"><?php the_field( 'hm_sec3_button1_text' ); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="section treating-section">
    <div class="container">
        <div class="title-wrap text-center">
            <h2><?php the_field( 'hm_sec4_title' ); ?></h2>
			<?php the_field( 'hm_sec4_content' ); ?>
            
        </div>
        <ul class="nav nav-pills mb-5" id="treating-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-cancer-tab" data-bs-toggle="pill" data-bs-target="#pills-cancer" type="button" role="tab" aria-controls="pills-cancer" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/cancer.webp" alt="">
                    <span>Cancer</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-pain-tab" data-bs-toggle="pill" data-bs-target="#pills-pain" type="button" role="tab" aria-controls="pills-pain" aria-selected="true">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/pain.webp" alt="">
                    <span>Chronic pain</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-chrons-tab" data-bs-toggle="pill" data-bs-target="#pills-chrons" type="button" role="tab" aria-controls="pills-chrons" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/chrons.webp" alt="">
                    <span>Crohns</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-headache-tab" data-bs-toggle="pill" data-bs-target="#pills-headache" type="button" role="tab" aria-controls="pills-headache" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/headache.webp" alt="">
                    <span>Headaches</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-Palliative-care-tab" data-bs-toggle="pill" data-bs-target="#pills-Palliative-care" type="button" role="tab" aria-controls="pills-Palliative-care" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/Palliative-care.webp" alt="">
                    <span>Palliative care</span>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="treating-tapContent">
            <div class="tab-pane fade show active" id="pills-pain" role="tabpanel" aria-labelledby="pills-pain-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 item">Arthritis</div>
                            <div class="col-md-6 item">Endometriosis</div>
                            <div class="col-md-6 item">Back pain and Sciatica</div>
                            <div class="col-md-6 item">Fibromyalgia</div>
                            <div class="col-md-6 item">Chronic Pain</div>
                            <div class="col-md-6 item">Migraines</div>
                            <div class="col-md-6 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 item">Musculoskeletal pain</div>
                            <div class="col-md-6 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-cancer" role="tabpanel" aria-labelledby="pills-cancer-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-chrons" role="tabpanel" aria-labelledby="pills-chrons-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-headache" role="tabpanel" aria-labelledby="pills-headache-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-Palliative-care" role="tabpanel" aria-labelledby="pills-Palliative-care-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section why-select" style="<?php if ( get_field( 'hm_sec5_bg_image' ) ) { ?>background-image: url(<?php the_field( 'hm_sec5_bg_image' ); ?>);<?php } else { ?> background-image: url(<?php echo get_template_directory_uri(); ?>/img/home/why-select-bg.webp);<?php } ?>">
    <div class="container">
        <div class="title-wrap text-center">
            <h2><?php the_field( 'hm_sec5_title' ); ?></h2>
			<?php the_field( 'hm_sec5_content' ); ?>
            
        </div>

        <div class="row cards_wrap">
		<?php if ( have_rows( 'hm_sec5_content_boxes_rep' ) ) : ?>
	<?php while ( have_rows( 'hm_sec5_content_boxes_rep' ) ) : the_row(); ?>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
					<?php if ( get_sub_field( 'icon' ) ) { ?>
                        <div class="image">
                            <img src="<?php the_sub_field( 'icon' ); ?>"/>
                        </div>
						<?php } ?>
                        <h4><?php the_sub_field( 'title' ); ?></h4>
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

<section class="section reviews-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 content_wrap">
                <h2><?php echo do_shortcode(get_field('hm_sec6_title')); ?></h2>
                <?php the_field( 'hm_sec6_content' ); ?>
                <div class="btn_wrap">
                    <a href="<?php the_field( 'hm_sec6_button_link' ); ?>" class="btn style_4"><?php the_field( 'hm_sec6_button_text' ); ?></a>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 reviews">
			<?php 
	$args = array( 'post_type' => 'marucanna-reviews', 'posts_per_page' => '1','meta_key' => 'meta-checkbox','meta_value' => 'yes');
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	
?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'reviews-thumb', true);
?>
                <div class="card">
                    <div class="card-body">
                        <div class="quote"><?php the_content(); ?></div>
                        <div class="author">
						<?php if ( has_post_thumbnail() ) {?>
                            <div class="image">
                                <img src="<?php echo $thumb_url[0]; ?>"/>
                            </div>
							<?php
 }
?>
                            <div class="detail">
                                <span class="name"><?php the_title(); ?></span>
                                <span class="type"><?php the_field( 'designation' ); ?></span>
                            </div>
                            <div class="star">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/home/img2.png"/>
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php
endwhile;
wp_reset_query();

?>

				
            </div>
        </div>
    </div>
</section>

<section class="section our-team-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2><?php echo do_shortcode(get_field('hm_sec7_title')); ?></h2>
			 <?php the_field( 'hm_sec7_content' ); ?>
           
        </div>
        <div class="team_slider">
		<?php 
	$args = array( 'post_type' => 'marucanna-doctors', 'posts_per_page' => '-1');
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	
?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'doc-home-thumb', true);
?>

<?php if( get_field('show_on_home_page') == 'Yes' ): ?>
		<div class="item">
		<?php if ( has_post_thumbnail() ) {?>
                <div class="image">
                    <img src="<?php echo $thumb_url[0]; ?>"/>
                </div>
		<?php } ?>
                <div class="name"><?php the_title(); ?></div>
                <div class="position"><?php the_field( 'specialization' ); ?></div>
            </div>
			<?php endif; ?>
							<?php
endwhile;
wp_reset_query();

?>
        </div>
        <div class="btn_wrap text-center">
            <a href="<?php the_field( 'hm_sec7_button_link' ); ?>" class="btn style_4"><?php the_field( 'hm_sec7_button_text' ); ?></a>
        </div>
    </div>
</section>

<section class="section cta-section text-center">
    <div class="container">
        <h2><?php the_field( 'hm_sec8_title' ); ?></h2>
       <?php the_field( 'hm_sec8_content' ); ?>


        <div class="btn-wrap">
            <a href="<?php the_field( 'hm_sec8_button_link' ); ?>" class="btn style_1"><?php the_field( 'hm_sec8_button_text' ); ?></a>
        </div>
    </div>
</section>

<section class="section blog-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2><?php echo do_shortcode(get_field('hm_sec9_title')); ?></h2>
            <?php the_field( 'hm_sec9_content' ); ?>

        </div>
        <div class="row blog-items">
		<?php 
	$args = array( 'post_type' => 'post', 'posts_per_page' => '3');
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	
?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'blog-home-thumb', true);
?>
            <div class="col-md-4 col-sm-12">
                <div class="card">
				<?php if ( has_post_thumbnail() ) {?>
                    <img src="<?php echo $thumb_url[0]; ?>" class="card-img-top" alt="<?php the_title(); ?>"/>
				<?php } ?>
                    <div class="card-body mc-blog-text">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <div class="date"><?php echo get_the_date('Y'); ?>.<?php echo get_the_date('m'); ?>.<?php echo get_the_date('j'); ?></div>
						<?php my_excerpt(17); ?>
                        
                    </div>
                    <a href="<?php the_permalink(); ?>" class="overlay"></a>
                </div>
            </div>
			
	<?php
endwhile;
wp_reset_query();

?>			
			
         
        </div>

        <div class="btn_wrap text-center">
            <a href="<?php the_field( 'hm_sec9_button_link' ); ?>" class="btn style_4"><?php the_field( 'hm_sec9_button_text' ); ?></a>
        </div>
    </div>
</section>

<section class="section our-partners">
    <div class="container">
        <div class="title_wrap text-center">
            <h2><?php echo do_shortcode(get_field('hm_sec10_title')); ?></h2>
            <?php the_field( 'hm_sec10_content' ); ?>

        </div>
        <div class="partners_logo">
		<?php $logos_images = get_field( 'logos' ); ?>
<?php if ( $logos_images ) :  ?>
	<?php foreach ( $logos_images as $logos_image ): ?>
            <img src="<?php echo $logos_image['url']; ?>"/>
           <?php endforeach; ?>
<?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>