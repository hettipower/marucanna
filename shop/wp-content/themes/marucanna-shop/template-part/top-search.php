<div class="search_wrap <?php echo $args['classes'];	?>">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <input type="hidden" value="product" name="post_type" id="post_type" />
        <div class="input-group">
            <input class="form-control" type="search" placeholder="<?php echo esc_attr_x( 'Search for products', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for products', 'label' ) ?>" />
            <span class="input-group-text">
                <input type="submit" class="search-submit btn" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
            </span>
        </div>
    </form>
</div>