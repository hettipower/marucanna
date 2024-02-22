<?php 
/* Template Name: Compare Page */

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

<section class="section compare_table_wrap">
    <div class="container">
        <div class="table_container">
            <table>
                <thead class="table_grid">
                    <tr class="table_grid">
                        <th></th>
                        <th class="logo">
                            <?php
                                $site_logo = get_field('site_logo' , 'option');
                                if( $site_logo ): 
                            ?>
                                <img src="<?php echo $site_logo['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                            <?php endif; ?>
                        </th>
                        <th class="odd">Medical <br/>Cannabis Clinics</th>
                        <th class="even">NHS Pain <br/>Clinic</th>
                        <th class="odd">Private Pain <br/>Clinics</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table_row-mobile table_grid tr_odd">
                        <td>
                            <p>Comprehensive pain management assessment</p>
                        </td>
                    </tr>
                    <tr class="tr_odd table_grid">
                        <td class="table_left_thead">
                            <p>Comprehensive pain management assessment</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_even">
                        <td>
                            <p>Access multi-disciplinary team of physios, psychologists and other services</p>
                        </td>
                    </tr>
                    <tr class="tr_even table_grid">
                        <td class="table_left_thead">
                            <p>Access multi-disciplinary team of physios, psychologists and other services</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">Some</td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_odd">
                        <td>
                            <p>Medical cannabis treatment plans available</p>
                        </td>
                    </tr>
                    <tr class="tr_odd table_grid">
                        <td class="table_left_thead">
                            <p>Medical cannabis treatment plans available</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_even">
                        <td>
                            <p>Fully online</p>
                        </td>
                    </tr>
                    <tr class="tr_even table_grid">
                        <td class="table_left_thead">
                            <p>Fully online</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">Some</td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_odd">
                        <td>
                            <p>Access to pain management programmes</p>
                        </td>
                    </tr>
                    <tr class="tr_odd table_grid">
                        <td class="table_left_thead">
                            <p>Access to pain management programmes</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_even">
                        <td>
                            <p>Minimal wait times</p>
                        </td>
                    </tr>
                    <tr class="tr_even table_grid">
                        <td class="table_left_thead">
                            <p>Minimal wait times</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/close.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_odd">
                        <td>
                            <p>Injection/invasive treatments for certain pain conditions</p>
                        </td>
                    </tr>
                    <tr class="tr_odd table_grid">
                        <td class="table_left_thead">
                            <p>Injection/invasive treatments for certain pain conditions</p>
                        </td>
                        <td class="table_leva">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                        <td class="table_other">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/tick.webp" alt="">
                        </td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_even">
                        <td>
                            <p>Focus on</p>
                        </td>
                    </tr>
                    <tr class="tr_even table_grid">
                        <td class="table_left_thead">
                            <p>Focus on</p>
                        </td>
                        <td class="table_leva">Pain</td>
                        <td class="table_other">Access to <br/>medical cannabis</td>
                        <td class="table_other">Pain</td>
                        <td class="table_other">Pain</td>
                    </tr>
                    <tr class="table_row-mobile table_grid tr_odd">
                        <td>
                            <h5>Typical cost for initial consultation</h5>
                        </td>
                    </tr>
                    <tr class="tr_odd table_grid">
                        <td class="table_left_thead">
                            <h5>Typical cost for initial consultation</h5>
                        </td>
                        <td class="table_leva">
                            <h3>£99</h3>
                        </td>
                        <td class="table_other">
                            <h3>£50-150</h3>
                        </td>
                        <td class="table_other">
                            <h3>Free</h3>
                        </td>
                        <td class="table_other">
                            <h3>£100-400</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="section faq-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2>Frequently asked questions about chronic pain</h2>
        </div>

        <div class="faqs row g-3">
			            <div class="faq-item">
                <h3>What is chronic pain ?</h3>
                <div class="content"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa</p>
            </div>
            </div>
            <div class="faq-item">
                <h3>How does medical cannibas help with chronic pain?</h3>
                <div class="content"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa</p>
            </div>
            </div>
            <div class="faq-item">
                <h3>How do i start treatments ?</h3>
                <div class="content"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa</p>
            </div>
            </div>
           

           
        </div>

    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>