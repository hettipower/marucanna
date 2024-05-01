<div class="col-md-4 col-sm-12 order-md-1 sidebar">

    <?php
        $recent_posts = new WP_Query(array(
            'post_type'      => 'post',  
            'posts_per_page' => 3, 
            'order'          => 'DESC',
        ));
        if ($recent_posts->have_posts()) :
    ?>
    <div class="sidebar_item recent_posts">
        <h3 class="title">Recent Posts</h3>
        <div class="list-group">
            <?php
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail', true);
            ?>
                <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action">
                    <div class="img">
                        <img src="<?php echo $thumb_url[0]; ?>" class="rounded img-fluid" alt="<?php the_title(); ?>">
                    </div>
                    <div class="content">
                        <h5><?php the_title(); ?></h5>
                        <span class="date"><?php echo get_the_date('Y'); ?> <?php echo get_the_date('F'); ?> <?php echo get_the_date('j'); ?></span>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php
        $categories = get_terms( array(
            'taxonomy'   => 'category',
            'hide_empty' => false,
        ) );
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ):
    ?>
    <div class="sidebar_item categories">
        <h3 class="title">Blog Categories</h3>
        <ul class="list-group list-group-flush">
            <?php 
                foreach ( $categories as $category ): 
                    if($category->slug == 'uncategorized') {
                        continue;
                    }
            ?>
            <li class="list-group-item">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo $category->name; ?> (<?php echo $category->count; ?>)</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    
    <?php
        $archives_content = wp_get_archives(array(
            'type'            => 'monthly',
            'show_post_count' => false,
            'format' => 'custom',
            'after' => '|',
            'echo' => false,
        ));
        $archives = explode('|', $archives_content);
        $archives = array_filter($archives, function($item) {
            return trim($item) !== '';
        });
        if ( ! empty( $archives ) ):
    ?>
    <div class="sidebar_item archives">
        <h3 class="title">All Archives</h3>
        <ul class="list-group list-group-flush">
            <?php foreach( $archives as $archive ): ?>
                <li class="list-group-item">
                    <?php echo $archive; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php get_search_form(); ?>

</div>