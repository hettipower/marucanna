<?php 
/* Template Name: Check Eligibility Page */

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

<section class="section eligibility_wrap">
    <div class="container">
        
        <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">

            <input type="hidden" name="action" value="mc_eligibility_checker">

            <h5>Contact Details</h5>

            <div class="mb-3">
                <label for="fname" class="form-label">Full Name</label>
                <input type="text" name="fname" class="form-control" id="fname">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>

            <div class="mb-3">
                <label for="contact_no" class="form-label">Phone</label>
                <input type="tel" name="contact_no" class="form-control" id="contact_no">
            </div>

            <h5>Eligibility Check</h5>

            <div class="form-item mb-3">
                <p>Do you require medicinal cannabis for chronic pain?</p>
                <div class="form-yesno">
                    <input type="checkbox" value="1" name="eligibility_q1" checked id="eligibility_q1">
                    <label for="eligibility_q1"></label>
                </div>
            </div>

            <div class="form-item mb-3">
                <p>Is the medical condition you intend to use the Medicinal cannabis for affect your quality of life?</p>
                <div class="form-yesno">
                    <input type="checkbox" value="1" name="eligibility_q2" id="eligibility_q2">
                    <label for="eligibility_q2"></label>
                </div>
            </div>

            <div class="form-item mb-3">
                <p>Have you seen any other health care professional for regarding your medical condition?</p>
                <div class="form-yesno">
                    <input type="checkbox" value="1" name="eligibility_q3" id="eligibility_q3">
                    <label for="eligibility_q3"></label>
                </div>
            </div>

            <div class="form-item mb-3">
                <p>Have you used medicinal cannabis before ?</p>
                <div class="form-yesno">
                    <input type="checkbox" value="1" name="eligibility_q4" id="eligibility_q4">
                    <label for="eligibility_q4"></label>
                </div>
            </div>

            <div class="form-item mb-3">
                <p>Do you or have you used any cannabis products for recreational use?</p>
                <div class="form-yesno">
                    <input type="checkbox" value="1" name="eligibility_q5" id="eligibility_q5">
                    <label for="eligibility_q5"></label>
                </div>
            </div>

            <div class="col-12">
                <button class="btn style_4" type="submit">Submit</button>
            </div>


        </form>
    
    </div>
</section>

<?php get_footer(); ?>