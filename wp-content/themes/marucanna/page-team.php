<?php 
/* Template Name: Team Page */

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

<section class="section team_wrapper">
    <div class="container">
        <div class="title_wrap text-center">
            <h3>Meet the Doctors and staff behind <span>MARUCANNA</span></h3>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,</p>
        </div>
        <div class="grid team_wrap">
            <h4 class="g-col-12 title text-center">Specialists</h4>
            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>

            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>

            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>
        </div>

        <div class="grid team_wrap">
            <h4 class="g-col-12 title text-center">Clininc Team</h4>
            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>

            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>

            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>

            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>

            <div class="item g-col-md-4 g-col-6">
                <div class="image">
                    <img src="http://localhost/marucanna/wp-content/uploads/doctor2.webp"/>
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
                <a href="#" class="overlay"></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>