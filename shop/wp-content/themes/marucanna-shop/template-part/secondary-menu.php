<ul class="nav <?php echo $args['classes'];	?>">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo wc_get_page_permalink( 'myaccount' ) ?>">
            <i class="far fa-user"></i>
            <span>Account</span>
        </a>
    </li>
    <!-- <li class="nav-item">
        <?php //echo do_shortcode('[yith_wcwl_items_count]'); ?>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" id="sliding_cart" href="#">
            <i class="fas fa-shopping-cart"></i>
            <span>Cart</span>
            <span id="cart_count" class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </a>
    </li>
</ul>