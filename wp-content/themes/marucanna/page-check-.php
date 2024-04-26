<?php 
/* Template Name: Check Eligibility Page */

get_header(); 

$status = isset($_GET['status']) ? $_GET['status'] : false;
$mgs = isset($_GET['mgs']) ? $_GET['mgs'] : false;
$fname = isset($_GET['fname']) ? $_GET['fname'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$contact = isset($_GET['contact']) ? $_GET['contact'] : '';

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
                    <?php the_field( 'stage_1_content' ); ?>
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

                <div class="section-title text-center">
                    <h3>Stage 01</h3>
                    <p>Check your eligibility for an appointment.</p>
                </div>

                <input type="hidden" name="action" value="mc_eligibility_checker">

                <div class="row">

                    <div class="mb-3">
                        <label for="fname" class="form-label">Full Name <span class="req">*</span></label>
                        <input type="text" name="fname" class="form-control" id="fname" required value="<?php echo $fname; ?>">
                        <div class="invalid-feedback">This field is required.</div>
                    </div>

                    <div class="mb-3 col-12 col-md-6">
                        <label for="email" class="form-label">Email Address <span class="req">*</span></label>
                        <input type="email" name="email" class="form-control" id="email" required value="<?php echo $email; ?>">
                        <div class="invalid-feedback">This field is required.</div>
                    </div>
                    
                    <div class="mb-3 col-12 col-md-6">
                        <label for="contact_no" class="form-label">Phone <span class="req">*</span></label>
                        <input type="tel" name="contact_no" class="form-control" id="contact_no" required value="<?php echo $contact; ?>">
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
                    <p>Is the medical condition you intend to use the Medicinal cannabis for affecting your quality of life?</p>
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

<?php if( !$status ) : ?>
<div class="modal fade" id="noticeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body eligibility-modal">
                <p>As part of our commitment to delivering comprehensive healthcare services, we may need to share your medical data with other healthcare professionals involved in your care. This sharing of information ensures that you receive the best possible treatment and coordinated support.</p>
                <p>Additionally, we will obtain your medical history and and share treatment outcomes with your General Practitioner (GP). This collaboration allows us to maintain continuity of care and keep your GP informed about your health status and treatment progress.</p>
                <p>Please be assured that your privacy and confidentiality are of utmost importance to us. Your data will only be shared on a need-to-know basis and in compliance with relevant privacy regulations.</p>
                <p>By continuing to receive care from our healthcare team, you consent to the sharing of your medical information as described above</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn style_2" data-bs-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));
    noticeModal.show();
});
</script>
<?php endif; ?>

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
})();
jQuery(document).ready(function($) {
    $('#contact_no').keypress(function(event) {
      var charCode = event.which;

      // Allow only numeric values (0-9)
      if (charCode < 48 || charCode > 57) {
        event.preventDefault();
      }
    });
});
</script>

<?php get_footer(); ?>