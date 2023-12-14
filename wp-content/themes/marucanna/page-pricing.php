<?php 
/* Template Name: Pricing Page */

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

<section class="section text-block-section">
    <div class="container">
        <div class="description">
            <p>Patients obtaining private medical cannabis therapy are responsible for covering the cost of both consultations and medicinal cannabis prescriptions. Medication may be gradually raised at the beginning of treatment while the best product and dosage are determined. After the initial consultation, patients usually need to wait a month to schedule a follow-up appointment to talk about how well they are managing their cannabis medication. After your doctor is satisfied that your cannabis treatment is stabilising, you might not need to see them for three months.</p>
        </div>
    </div>
</section>

<section class="section mc-image-text-block">
    <div class="container">
        <div class="row">
		
            <div class="col-md-6 col-sm-12 image_wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/img/pricing.webp"/>
            </div>
			
            <div class="col-md-6 col-sm-12 content_wrapper">
                <h2>MARUCANNA clinic <span>promises</span></h2>
                
                <div class="numbered_list">
                    <div class="item">
                        <span class="number">01</span>
                        <div class="text">to verify your eligibility before collecting any fees.</div>
                    </div>
                    <div class="item">
                        <span class="number">02</span>
                        <div class="text">to listen, learn and understand your health needs.</div>
                    </div>
                    <div class="item">
                        <span class="number">03</span>
                        <div class="text">to create you a personalised treatment plan.</div>
                    </div>
                    <div class="item">
                        <span class="number">04</span>
                        <div class="text">to use patient feedback to improve our service.</div>
                    </div>
                    <div class="item">
                        <span class="number">05</span>
                        <div class="text">to create a caring, compassionate and respectful environment for our patients. </div>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <a href="#" class="btn style_4">BOOK NOW</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section pricing_section_wrap">
    <div class="container">
        <div class="title_wrap text-center">
            <h3>Medical <span>cannabis</span> cost</h3>
            <div class="description">
                <p>As medical cannabis is a customised medicine, prices can differ greatly depending on the kind of cannabis and how much is prescribed. You can determine which items are a good fit for you by talking about the cost with your doctor and sharing your financial situation with them. Initially, people receiving medicinal cannabis treatment are typically prescribed a modest dosage. Gradually increasing the dose is done until the symptoms subside. By going "low and slow," adverse consequences are less likely to occur.</p>
            </div>
        </div>

        <div class="row g-3 pricing">

            <div class=" col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Initial Consultation</h4>
                        <h5 class="subtitle">Specialist</h5>
                        <div class="price_wrap">
                            <a href="#" class="btn style_5">BOOK NOW</a>
                            <div class="price">£110</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Microalbuminuria</li>
                            <li class="list-group-item">Direct Bilirubin</li>
                            <li class="list-group-item">Indirect Bilirubin</li>
                            <li class="list-group-item">Total Bilirubin</li>
                            <li class="list-group-item">Clearance Creatinine</li>
                            <li class="list-group-item">Microalbuminuria</li>
                        </ul>
                        <div class="btn_wrap text-center mt-4">
                            <a href="#" class="btn style_2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">First Follow Up</h4>
                        <h5 class="subtitle">Specialist</h5>
                        <div class="price_wrap">
                            <a href="#" class="btn style_5">BOOK NOW</a>
                            <div class="price">£50</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Microalbuminuria</li>
                            <li class="list-group-item">Direct Bilirubin</li>
                            <li class="list-group-item">Indirect Bilirubin</li>
                            <li class="list-group-item">Total Bilirubin</li>
                            <li class="list-group-item">Clearance Creatinine</li>
                            <li class="list-group-item">Microalbuminuria</li>
                        </ul>
                        <div class="btn_wrap text-center mt-4">
                            <a href="#" class="btn style_2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Initial Consultation</h4>
                        <h5 class="subtitle">Specialist</h5>
                        <div class="price_wrap">
                            <a href="#" class="btn style_5">BOOK NOW</a>
                            <div class="price">£110</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Microalbuminuria</li>
                            <li class="list-group-item">Direct Bilirubin</li>
                            <li class="list-group-item">Indirect Bilirubin</li>
                            <li class="list-group-item">Total Bilirubin</li>
                            <li class="list-group-item">Clearance Creatinine</li>
                            <li class="list-group-item">Microalbuminuria</li>
                        </ul>
                        <div class="btn_wrap text-center mt-4">
                            <a href="#" class="btn style_2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Initial Consultation</h4>
                        <h5 class="subtitle">Specialist</h5>
                        <div class="price_wrap">
                            <a href="#" class="btn style_5">BOOK NOW</a>
                            <div class="price">£110</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Microalbuminuria</li>
                            <li class="list-group-item">Direct Bilirubin</li>
                            <li class="list-group-item">Indirect Bilirubin</li>
                            <li class="list-group-item">Total Bilirubin</li>
                            <li class="list-group-item">Clearance Creatinine</li>
                        </ul>
                        <div class="btn_wrap text-center mt-4">
                            <a href="#" class="btn style_2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="section timeline_wrap">
    <div class="container">
        <div class="title_wrap text-center">
            <h3>Appointment <span>timeline</span></h3>
        </div>
        <div class="timeline">
            <img src="<?php bloginfo( 'template_url' ); ?>/img/pricing-timeline.webp" class="img-fluid" alt="">
        </div>
        <div class="btn_wrap mt-3 text-center">
            <a href="#" class="btn style_4">REPEAT ORDER</a>
        </div>
    </div>
</section>

<section class="section text-block-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h3>Multiple forms of <span>medicinal</span> cannabis</h3>
            <div class="description">
                <p>Products made from cannabis come in a variety of forms and dosages, such as oils, pills, and vaporizer-ready dry flowers. In order to guarantee that medical cannabis is suitable for each patient, a specialised expert must prescribe it in the UK following a thorough consultation. It's crucial to remember that some CBD products are marketed as therapeutic cannabis in order to increase sales. We specialise in the flower form of medical cannabis.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>