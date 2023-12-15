<?php 
/* Template Name: Prescription Page */

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
        <div class="title_wrap text-center">
            <h3>Requirements for a medical cannabis <span>prescription</span></h3>
            <div class="description">
                <p>If you believe medicinal cannabis might help you manage your symptoms, the first step is to determine your eligibility for a prescription. Contact Marucanna for information on your eligibility for medicinal cannabis in the United Kingdom.</p>
                <p>Many well-known ailments may benefit from the use of medicinal cannabis. If you've tried various techniques for controlling your pain or other symptoms of your disease and haven't found relief, it's conceivable that obtaining a prescription for medical cannabis in the UK will help.</p>
            </div>
        </div>
    </div>
</section>

<section class="section conditions-list-section">
    <div class="container">
        <div class="title_wrap">
            <h3>Conditions we treat</h3>
        </div>
        <div class="condition_list_wrap">
            <ul>
                <li>Chronic Pain</li>
                <li>Cluster</li>
                <li>Complex Regional Pain Syndrome</li>
                <li>Crohns</li>
                <li>Cancer Pain</li>
                <li>Chronic Pain</li>
                <li>Fibromyalgia</li>
                <li>Headache</li>
                <li>Inflammatory Arthritis</li>
                <li>Migraine</li>
                <li>Neuropathic Pain</li>
                <li>Palliative Care</li>
                <li>Trigeminal Neuralgia</li>
                <li>Ulcerative Colitis</li>
                <li>Bladder Pain</li>
                <li>Acute Pain</li>
                <li>Back Pain and Sciatica</li>
                <li>Ehlers-Danlos Syndrome</li>
                <li>Chronic Regional Pain Syndrom</li>
                <li>Compressed or Pinched Nerves</li>
                <li>Endometriosis</li>
                <li>Herniated Disc</li>
                <li>Musculoskeletal Pain</li>
                <li>Somatic Pain</li>
                <li>Visceral Pain</li>
            </ul>
        </div>
    </div>
</section>

<section class="section text-block-section">
    <div class="container">
        <div class="title_wrap">
            <h3>Get medical cannabis with a <span>prescription</span></h3>
            <div class="description">
                <p>We can offer your medicine if you have a medical cannabis prescription from a professional physician in the UK. Follow the steps below to learn how to obtain medicinal cannabis from us.</p>
            </div>
        </div>
    </div>
</section>

<section class="section image_text_block style_1">
    <div class="container">
        <div class="row">
		
            <div class="col-md-4 col-sm-12 image_wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/img/prescription-image-1.webp"/>
            </div>
			
            <div class="col-md-8 col-sm-12 content_wrapper">
                <h3>1. Please send us your prescription</h3>
                <p>Request that your clinic or pharmacy provide us with a physical copy of your prescription.</p>
                <p>If not, please send us a physical copy of your prescription by postal mail. Please do not send a photocopy or scan, as we are required by law to have the original in order to provide your prescription.</p>
                <p>Your prescription will include a date, and you must obtain your medication within 28 days of that date.</p>
                <p>If your prescription runs out, you must obtain a new one from your specialised prescriber clinic. Give them a call to let them know, and they'll do the rest.</p>
            </div>
        </div>
    </div>
</section>

<section class="section image_text_block style_2">
    <div class="container">
        <div class="row">
		
            <div class="col-md-4 col-sm-12 image_wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/img/prescription-image-2.webp"/>
            </div>
			
            <div class="col-md-8 col-sm-12 content_wrapper">
                <h3>2. Purchase your prescription</h3>
                <p>We will email you a link to pay for your medication after we get a physical copy of your prescription. Using the link, you may pay with a credit card online using PayPal.</p>
            </div>
        </div>
    </div>
</section>

<section class="section image_text_block style_1">
    <div class="container">
        <div class="row">
		
            <div class="col-md-4 col-sm-12 image_wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/img/prescription-image-3.webp"/>
            </div>
			
            <div class="col-md-8 col-sm-12 content_wrapper">
                <h3>3. We will bring your medicine to you</h3>
                <p>Our courier will schedule a delivery date for your medicine. They will offer you a tracking number so you can see when it will arrive. If you are not going to be there, you can modify the day of your delivery with the courier. If your courier calls and you are not at home, they will leave you a card. We utilise a courier service for delivery to you and have discovered that downloading their app is the best method to handle your item. Please contact us for further information. Your prescription must be signed for on the day of delivery so that we know you got it.</p>
            </div>
        </div>
    </div>
</section>

<section class="section image_text_block style_2">
    <div class="container">
        <div class="row">
		
            <div class="col-md-4 col-sm-12 image_wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/img/prescription-image-4.webp"/>
            </div>
			
            <div class="col-md-8 col-sm-12 content_wrapper">
                <h3>4. Schedule a repeat prescription appointment on your calendar</h3>
                <p>After receiving your medicine, make a note in your notebook or on a calendar to get your next prescription. We recommend scheduling this appointment 10 days before you run out of medicine.</p>
                <p>Check with your clinic to see if you need to schedule a follow-up visit with your specialised prescriber to acquire a new prescription or if you may request one from them.</p>
            </div>
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

<?php get_footer(); ?>