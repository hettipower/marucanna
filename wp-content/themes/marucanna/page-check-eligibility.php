<?php 
/* Template Name: Check Eligibility Page */

get_header(); 

$status = isset($_GET['status']) ? $_GET['status'] : false;
$mgs = isset($_GET['mgs']) ? $_GET['mgs'] : false;

?>

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

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3>Check Eligibility</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis erat eget ligula porta ornare. Fusce nec odio non eros tincidunt lobortis. Sed vitae congue urna.</p>
                    <p>Integer id turpis nec nibh lobortis pellentesque. Aliquam luctus porta lorem a bibendum. Vestibulum mollis, lacus sit amet tincidunt ullamcorper, turpis metus eleifend quam, sit amet condimentum orci ligula non orci.</p>
                </div>
            </div>

            <form class="col-12 col-md-7 form-wrapper needs-validation" action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post" novalidate>

                <?php if( $mgs ): ?>
                    <?php if( $status == '0' ): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $mgs; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif( $status == '2' ): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo $mgs; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <input type="hidden" name="action" value="mc_eligibility_checker">

                <div class="row">

                    <div class="mb-3">
                        <label for="fname" class="form-label">Full Name <span class="req">*</span></label>
                        <input type="text" name="fname" class="form-control" id="fname" required>
                        <div class="invalid-feedback">This field is required.</div>
                    </div>

                    <div class="mb-3 col-12 col-md-6">
                        <label for="email" class="form-label">Email Address <span class="req">*</span></label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">This field is required.</div>
                    </div>
                    
                    <div class="mb-3 col-12 col-md-6">
                        <label for="contact_no" class="form-label">Phone <span class="req">*</span></label>
                        <input type="tel" name="contact_no" class="form-control" id="contact_no" required>
                        <div class="invalid-feedback">This field is required.</div>
                    </div>

                </div>

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
                    <button class="btn style_4" type="submit">Check Eligibility</button>
                </div>


            </form>
        </div>
        
    
    </div>
</section>

<script>
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php get_footer(); ?>