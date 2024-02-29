
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