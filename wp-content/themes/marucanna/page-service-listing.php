<?php 
/* Template Name: Service Listing Page */

get_header(); ?>

<section class="section mc-title-section style_1" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</section>

<section class="section breadcrumb_wrap">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>
    </div>
</section>

<section class="section condition-listing-block">
    <div class="container">
        <div class="search_wrap">
            <div class="input-group">
                <input type="text" class="form-control" id="search_condition" placeholder="Search Condition">
                <span class="input-group-text">
                    <button type="submit" class="btn" id="search_condition_submit">Search</button>
                </span>
            </div>
        </div>

        <div class="text">
            <p>Many diseases can cause pain, and medicinal cannabis can help reduce that agony. Pain from injuries, migraines, and other chronic pains are a few types of pain that cannabis can help with. Strong opioid medicines like codeine are frequently thought to be less effective at relieving pain than medical cannabis</p>
        </div>

        <div class="condition_listing_wrap">
            <div class="condition_listing">
                <div class="row">

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition1.webp" alt="">
                            <h4>Cancer Pain</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition2.webp" alt="">
                            <h4>Chronic Pain</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition3.webp" alt="">
                            <h4>Crohns</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition4.webp" alt="">
                            <h4>Headaches</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition5.webp" alt="">
                            <h4>Inflammatory Arthritis</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition6.webp" alt="">
                            <h4>Migraine</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition7.webp" alt="">
                            <h4>Palliative Care</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition8.webp" alt="">
                            <h4>Neuropathic Pain</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="condition">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition9.webp" alt="">
                            <h4>Musculoskeletal pain</h4>
                            <a href="#" class="overlay"></a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pagination_wrap">
                <nav>
                    <ul class="pagination">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</section>

<section class="section pain-symptoms-wrap">
    <div class="container">
        <div class="title_wrap">
            <h3>Pain symptoms</h3>
        </div>
        
        <div class="row g-2 symptoms">

            <div class="col-md-4 col-sm-12">
                <div class="symptom">Fatigue</div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="symptom">Joint pain</div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="symptom">Sleeping problems</div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="symptom">Constant pain</div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="symptom">Lack of relief from over-the-counter painkillers</div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="symptom">Burning sensations</div>
            </div>

            
        </div>

    </div>
</section>

<section class="section text-block-section text-center">
    <div class="container">
        <div class="title_wrap">
            <h3>Find out how medicinal cannabis can effectively relieve pain.</h3>
        </div>
        <div class="description">
            <p>Even if medications are recommended to patients, they often discover that they do not effectively relieve their pain. These medications have the potential to be very potent analgesics with extensive adverse effects. Patients may look into alternative options if even these are unable to help them control their discomfort. Phytocannabinoids, a class of lipophilic chemicals that interact with the body's endocannabinoid system (ECS), are one way that medicinal cannabis can be used to control pain. The body's peripheral and central nervous systems communicate with each other through the endocannabinoid system. Put succinctly, this indicates the enormous medicinal potential of phytocannabinoids.</p>
        </div>
    </div>
</section>

<section class="section pain-management">
    <div class="container">
        <div class="title_wrap text-center">
            <h3>Lifestyle <span>pain</span> management </h3>
        </div>
        
        <div class="row g-3 management_wrap">

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">01</span>
                    <div class="content">
                        <h4>MARUCANNA introduction</h4>
                        <div class="description">Improve your knowledge of suffering and discover how to make attainable, meaningful objectives for yourself. </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">02</span>
                    <div class="content">
                        <h4>Coping with Pain </h4>
                        <div class="description">Learn how to live well with pain by communicating your needs effectively and creating a supportive network around you. </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">03</span>
                    <div class="content">
                        <h4>Movement techniques </h4>
                        <div class="description">Discover techniques for gaining movement confidence and improving activities required throughout the day.</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">04</span>
                    <div class="content">
                        <h4>Medication for pain </h4>
                        <div class="description">Learn about different drugs and how to collaborate with your healthcare team to discover the best strategy for you. </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">05</span>
                    <div class="content">
                        <h4>Activity management </h4>
                        <div class="description">Learn how to manage your time so you can get back to doing what you love. Every bit helps when it comes to pain relief.</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">06</span>
                    <div class="content">
                        <h4>Pain flare-ups </h4>
                        <div class="description">Get advice on pain flare-ups and how to deal with them in challenging situations when you need support.</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">07</span>
                    <div class="content">
                        <h4>Sleep better </h4>
                        <div class="description">Learn about the difficulties of sleeping properly when living with pain and how to enhance your sleep.</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">08</span>
                    <div class="content">
                        <h4>Coping with pain</h4>
                        <div class="description">Learn more about tools and assistance for pain management in various parts of daily life to improve your lifestyle.</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">09</span>
                    <div class="content">
                        <h4>Experience advice </h4>
                        <div class="description">Get guidance and resources provided by our doctors, who will support you throughout the treatment.</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="management">
                    <span class="number">10</span>
                    <div class="content">
                        <h4>Completion plan</h4>
                        <div class="description">Take some time to enjoy your accomplishments, reflect on what you've learned, and plan your future moves.</div>
                    </div>
                </div>
            </div>

            <div class="col-12 btn-wrap text-center mt-5">
                <a href="#" class="btn style_4">CHECK ELIGIBILITY</a>
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
                <div class="content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa </div>
            </div>

            <div class="faq-item">
                <h3>How does medical cannibas help with chronic pain?</h3>
                <div class="content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa </div>
            </div>

            <div class="faq-item">
                <h3>How do i start treatments ?</h3>
                <div class="content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa </div>
            </div>
        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($) {

    $('#search_condition_submit').on('click' , function(){

        var search_condition = $('#search_condition').val();

        send_request(search_condition, 0, true);

        return false;
    });
    
    function send_request(condition_name = "", offset = 0, overrwite = true) {

        if (condition_name === undefined) {
            condition_name = '';
        }

        if (offset === undefined) {
            offset = '';
        }

        if (overrwite === undefined) {
            overrwite = true;
        }

        var json_url = '<?php echo api_url(); ?>conditions';

        jQuery.getJSON(json_url, {
            name: condition_name,
            offset: offset,
        })
        .done(function(json) {

            if (json['code'] == 'error') {
                jQuery('.condition_listing').html('<p>Something Went Wrong! Please Reload The Page.</p>');
            } else {

                if (json['data'] != '') {
                    if (overrwite) {
                        jQuery('.condition_listing').html(json['data']);
                    } else {
                        jQuery('.condition_listing').append(json['data']);
                    }
                }

            }
        })
        .always(function() {
        });

    }

});
</script>
<?php get_footer(); ?>