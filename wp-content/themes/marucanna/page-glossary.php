<?php 
/* Template Name: Glossary Page */

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

<section class="section glossary_wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 into_text">
                <?php the_field( 'intro_text' ); ?>
            </div>
            <div class="col-12 glossary_table_wrap">
                <table class="table">
                    <?php if ( have_rows( 'glossary_table' ) ) : while ( have_rows( 'glossary_table' ) ) : the_row(); ?>
                        <tr>
                            <th><?php the_sub_field( 'title' ); ?></th>
                            <td><?php the_sub_field( 'content' ); ?></td>
                        </tr>
                    <?php endwhile; endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>