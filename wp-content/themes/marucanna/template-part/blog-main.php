<?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>
<div class="blog_item mb-5">
    <div class="blog-img">
        <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php echo $thumb_url[0]; ?>" class="rounded img-fluid" alt="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>" title="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>">
        <?php endif; ?>
    </div>
    <div class="blog_content">
        <div class="date"><?php echo get_the_date('Y'); ?> <?php echo get_the_date('F'); ?> <?php echo get_the_date('j'); ?></div>
        <h3><?php the_title(); ?></h3>
        <?php my_excerpt(17); ?>
        <div class="btn_wrap">
            <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
        </div>
    </div>
</div>