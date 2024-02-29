<?php
$source_type = get_field( 'source_type' );
$select_category = get_field( 'select_category' );
$select_blogs = get_field( 'select_blogs' );
?>
<?php if( $source_type != 'none' && isset($source_type) ): ?>
<section class="section blog-section">
    <div class="container">
        
        <h3>Related <span>Articles</span></h3>

        <div class="row blog-items">
            <?php if( $source_type == 'manual' && $select_blogs ): ?>
                <?php
                    $blog_query = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => '3',
                        'post__in' => $select_blogs
                    ));
                    if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
                ?>
                    <?php //get_template_part( 'template-part/blog', 'item' , array('classes' => 'col-md-4 col-sm-12') ); ?>
			<?php get_template_part( 'template-part/blog', 'item'); ?>
	            <?php endwhile; wp_reset_postdata(); endif; ?>
            <?php elseif( $source_type == 'category' && $select_category ): ?>
                <?php
                    $blog_query = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => '4',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $select_category->slug,
                            ),
                        ),
                    ));
                    if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
                ?>
                    <?php //get_template_part( 'template-part/blog', 'item' , array('classes' => 'col-md-4 col-sm-12') ); ?>
			 <?php get_template_part( 'template-part/blog', 'item'); ?>
	            <?php endwhile; wp_reset_postdata(); endif; ?>
            <?php endif; ?>
        </div>

    </div>
</section>
<?php endif; ?>