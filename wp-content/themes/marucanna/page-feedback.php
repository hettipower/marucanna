<?php 
/* Template Name: Feedback Page */

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

<section class="section breadcrumb_wrap bg_gray">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
		    <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section feedback_wrapper bg_gray">
    <div class="container">
        
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="feedback-inner">
                    <div class="feedback-quote before-feedback">
                        <h4>Before Marucanna</h4>
                        <div class="quote">
                            <p>The pain I experienced on a daily basis was unbearable. Everything resulted in scar tissue.</p>
                            <p>Lewis was being prescribed up to 3,000 prescription pills each year, in addition to injections, to treat his back discomfort. During this time, he underwent 40 operations, injections, and nerve burns, the majority of which were on his spine.</p>
                        </div>
                    </div>
                    <div class="feedback-quote after-feedback">
                        <h4>After Marucanna</h4>
                        <div class="quote">
                            <p>I had my last prescription tablet on 09/04/22.</p>
                            <p>Lewis made other beneficial adjustments in his life, such as his 5-year meditation routine. "I don't see pain the same way. I perceive it as energy rather than an 'object'. Despite the discomfort, I know I have the courage to attempt new things. It feels freeing!"</p>
                        </div>
                    </div>
                    <div class="feedback-item">
                        <h3>Lewis</h3>
                        <p>He suffers from back discomfort and compartment syndrome.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="feedback-inner">
                    <div class="feedback-quote before-feedback">
                        <h4>Before Marucanna</h4>
                        <div class="quote">
                            <p>"I felt like no one cared about my suffering." It made me feel worthless. "All I wanted was a solution."</p>
                            <p>She had difficulty distinguishing between the adverse effects of her prescription medicine and the symptoms of her ailments at times. Emma spent the majority of the day and night napping. This, together with her medicines and decreased mobility, had an influence on her life and career.</p>
                        </div>
                    </div>
                    <div class="feedback-quote after-feedback">
                        <h4>After Marucanna</h4>
                        <div class="quote">
                            <p>"I honestly can't thank Marucanna enough; they have brought a miracle into my life; they've made a huge difference."</p>
                            <p>Her consultant has gradually reduced her prescription medication since entering the clinic. "I'm getting out more than I used to, and I'm starting to feel a little more capable." I'm also feeling a lot better on the inside, less inebriated and dizzy." She would have ranked her pain at 8/9 before joining Marucanna. It's now down to 5/6 since I joined.</p>
                        </div>
                    </div>
                    <div class="feedback-item">
                        <h3>Bernadette</h3>
                        <p>She lives with the symptoms of multiple sclerosis (MS), fibromyalgia, a functional neurological condition, and chronic tiredness (ME).</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="section eligibility_wrap partnership_wrap">
    <div class="container">

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3>Join our Partnership Scheme to deliver the future of Medical Cannabis</h3>
                    <p>LLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, </p>
                    <p>ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper"><?php echo do_shortcode('[gravityform id="3" title="false"]'); ?></div>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>