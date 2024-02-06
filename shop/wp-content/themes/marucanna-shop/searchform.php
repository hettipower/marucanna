<div class="sidebar_item search_wrap">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <div class="input-group">
            <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" aria-label="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s">
            <span class="input-group-text">
                <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </span>
        </div>
    </form>
</div>