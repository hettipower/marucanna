<?php 
/* Template Name: Home Page */

get_header(); ?>

<section class="section mc-title-section" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/home/header.webp)">
    <div class="container">
        <h1>MARUCANNA<br/> Medical cannabis<br/> treatments</h1>
        <a href="#" class="btn style_1">CHECK ELIGIBILITY</a>
    </div>
</section>

<section class="section mc-image-text-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 image_wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/img/home/about-image.webp" alt="">
            </div>
            <div class="col-md-6 col-sm-12 content_wrapper">
                <h2>Leading medical <span>cannabis treatment</span> clinic</h2>
                <p>We are proud to be an established medical cannabis clinic in the UK. You will receive top-notch care from skilled clinicians who are knowledgeable in the most recent medical cannabis and manage a large medical cannabis patient registry. Clinical data support the use of medical cannabis for a wide spectrum of diseases for which we see patients. Not everyone will be a good fit for medical cannabis. To guarantee that patients are receiving the best care possible, whether or not that care includes medical cannabis, we, as professionals in the field, make use of the most recent research and recommendations.</p>

                <div class="btn-wrapper">
                    <a href="#" class="btn style_3">READ MORE</a>
                    <a href="#" class="btn style_4">BOOK AN APPOINTMENT</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section how-it-works">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 content_wrap">
                <h2>How it <span>works</span></h2>
                <div class="steps_wrap">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 step">
                            <div class="num">STEP 01</div>
                            <h3>Eligibility check</h3>
                            <p>By responding to a brief questionnaire and sharing your appropriate medical information, you can determine your eligibility.</p>
                        </div>
                        <div class="col-md-6 col-sm-12 step">
                            <div class="num">STEP 02</div>
                            <h3>Book a consultation</h3>
                            <p>If you are qualified, we will provide you a link so you can schedule and pay for your appointment with a specialised doctor.</p>
                        </div>
                        <div class="col-md-6 col-sm-12 step">
                            <div class="num">STEP 03</div>
                            <h3>Initial consultation</h3>
                            <p>You will be given clear instructions on the day of your consultation on how to get online help from one of our medical specialists.</p>
                        </div>
                        <div class="col-md-6 col-sm-12 step">
                            <div class="num">STEP 04</div>
                            <h3>Start your treatment</h3>
                            <p>Once the doctor has provided your medical cannabis prescription, you can schedule delivery to your home.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 image_wrap">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/how-it-work.webp" alt="">
                </div>
                <a href="#" class="btn style_4">Check <br/>Eligibility</a>
            </div>
        </div>
    </div>
</section>

<section class="section treating-section">
    <div class="container">
        <div class="title-wrap text-center">
            <h2>Treating pain with medicinal cannabis</h2>
            <p>Not everyone will be a good fit for medical cannabis prescriptions. To guarantee that patients are receiving the best care possible, whether or not that care includes medical cannabis, we, as professionals in the field, make use of the most recent research and recommendations.</p>
        </div>
        <ul class="nav nav-pills mb-5" id="treating-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-cancer-tab" data-bs-toggle="pill" data-bs-target="#pills-cancer" type="button" role="tab" aria-controls="pills-cancer" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/cancer.webp" alt="">
                    <span>Cancer</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-pain-tab" data-bs-toggle="pill" data-bs-target="#pills-pain" type="button" role="tab" aria-controls="pills-pain" aria-selected="true">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/pain.webp" alt="">
                    <span>Chronic pain</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-chrons-tab" data-bs-toggle="pill" data-bs-target="#pills-chrons" type="button" role="tab" aria-controls="pills-chrons" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/chrons.webp" alt="">
                    <span>Crohns</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-headache-tab" data-bs-toggle="pill" data-bs-target="#pills-headache" type="button" role="tab" aria-controls="pills-headache" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/headache.webp" alt="">
                    <span>Headaches</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-Palliative-care-tab" data-bs-toggle="pill" data-bs-target="#pills-Palliative-care" type="button" role="tab" aria-controls="pills-Palliative-care" aria-selected="false">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/Palliative-care.webp" alt="">
                    <span>Palliative care</span>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="treating-tapContent">
            <div class="tab-pane fade show active" id="pills-pain" role="tabpanel" aria-labelledby="pills-pain-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-cancer" role="tabpanel" aria-labelledby="pills-cancer-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-chrons" role="tabpanel" aria-labelledby="pills-chrons-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-headache" role="tabpanel" aria-labelledby="pills-headache-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-Palliative-care" role="tabpanel" aria-labelledby="pills-Palliative-care-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 col-sm-12 image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home/chronic-pain.webp" alt="">
                    </div>
                    <div class="col-md-8 col-sm-12 content-wrap">
                        <h3>Chronic <span>Pain</span></h3>
                        <p>Chronic pain is the most common reason for which medical cannabis is given in the UK, with over 7 million people estimated to be affected. We can offer consultations with medical specialists regarding a wide range of qualifying pain conditions. To learn more, click on any of the categories below.</p>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 item">Arthritis</div>
                            <div class="col-md-6 col-sm-12 item">Endometriosis</div>
                            <div class="col-md-6 col-sm-12 item">Back pain and Sciatica</div>
                            <div class="col-md-6 col-sm-12 item">Fibromyalgia</div>
                            <div class="col-md-6 col-sm-12 item">Chronic Pain</div>
                            <div class="col-md-6 col-sm-12 item">Migraines</div>
                            <div class="col-md-6 col-sm-12 item">Chronic regional pain syndrome</div>
                            <div class="col-md-6 col-sm-12 item">Musculoskeletal pain</div>
                            <div class="col-md-6 col-sm-12 item">Ehlers Danlos syndromes</div>
                            <div class="col-md-6 col-sm-12 item">Neuropathic pain</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section why-select" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/home/why-select-bg.webp)">
    <div class="container">
        <div class="title-wrap text-center">
            <h2>Why select Marucanna</h2>
            <p>We pair up qualified patients with medical professionals that specialise in their illness, so you get top-notch support. In order to track the advancement of your care over time, you will have frequent check-ins with your specialised physician or clinic, as our highly qualified team has vast experience prescribing cannabis-based medications in the UK.</p>
        </div>

        <div class="row cards_wrap">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/home/experince-doctos.webp" alt="">
                        </div>
                        <h4>Experienced doctors</h4>
                        <p>We care for patients with a wide range of diseases and diagnoses while collaborating with skilled doctors from a variety of professions. All clinicians employ customised, disease- specific clinical and prescription guidelines that are generated using patient data, and they are all highly qualified and experienced in prescribing medicinal cannabis.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/home/100_.webp" alt="">
                        </div>
                        <h4>100% Confidentiality</h4>
                        <p>All information is handled transparently, equitably, and in accordance with the law. Your information is kept completely private and is never disclosed to any parties without your consent or knowledge. It is our responsibility to prove that we have complied with the six GDPR guidelines for handling personal data.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/home/patient-support.webp" alt="">
                        </div>
                        <h4>Dedicated patient support</h4>
                        <p>We see a lot of patients with different conditions. Some people feel alone, while others battle a terrible condition. Each and every one of our patients should be able to assist and benefit from one another. We provide standard exams with a doctor who specialises in medical cannabis and are readily available to support you every step of the way.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section reviews-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 content_wrap">
                <h2>What our <span>patients</span> say about us</h2>
                <p>See why our patients are happy to see their Marucanna medical cannabis doctor and why we are recommended throughout the UK.</p>
                <div class="btn_wrap">
                    <a href="#" class="btn style_4">VIEW ALL REVIEWS</a>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 reviews">
                <div class="card">
                    <div class="card-body">
                        <div class="quote">"I have nothing but the highest regard for the folks at Marucanna. They are incredibly kind, professional, kind, and quick to answer any questions. Really, you're lucky if the phone rings more than twice before someone answers. Every interaction has been easy and enjoyable thanks to them. It is evident from the quality of care they give patients that this is more than just a job for them and their team. Go with Marucanna if you need a referral; you're doing the proper thing there."</div>
                        <div class="author">
                            <div class="image">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/home/review-thumb.webp" alt="">
                            </div>
                            <div class="detail">
                                <span class="name">James Jonas</span>
                                <span class="type">Patient</span>
                            </div>
                            <div class="star">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/home/img2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section our-team-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2>Our <span>experienced</span> doctors</h2>
            <p>Our highly qualified team has significant experience prescribing cannabis-based medicines in the UK. We can track the success of your care over time with regular check-ins with your specialised medical cannabis doctor.</p>
        </div>
        <div class="team_slider">
            <div class="item">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/doctor1.webp" alt="">
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/doctor2.webp" alt="">
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/doctor3.webp" alt="">
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/doctor4.webp" alt="">
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/doctor1.webp" alt="">
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/doctor3.webp" alt="">
                </div>
                <div class="name">Dr Jimmy Larsen</div>
                <div class="position">Cardiologist</div>
            </div>
        </div>
        <div class="btn_wrap text-center">
            <a href="#" class="btn style_4">VIEW ALL DOCTORS</a>
        </div>
    </div>
</section>

<section class="section cta-section text-center">
    <div class="container">
        <h2>Improve your life with <br/>medical cannabis</h2>
        <p>New studies show that more and more patients receiving treatment with medical cannabis<br/> have had their quality of life improve significantly..</p>

        <div class="btn-wrap">
            <a href="#" class="btn style_1">BOOK AN APPOINTMENT</a>
        </div>
    </div>
</section>

<section class="section blog-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2><span>Updates</span> from MARUCANNA</h2>
            <p>Read about the most recent advancements in clinical research, patient stories, and medical cannabis news from Marucanna.</p>
        </div>
        <div class="row blog-items">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/blog.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">What are the new trends in cannabis treatments</h5>
                        <div class="date">2023.10.23</div>
                        <p class="card-text">Aenean volutpat, sem sit amet ullamcoer gravida, molestie risus enim nulla. Pellentesqu velit faucibus kodale dolor rhoncu.</p>
                    </div>
                    <a href="#" class="overlay"></a>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/blog2.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">What are the new trends in cannabis treatments</h5>
                        <div class="date">2023.10.23</div>
                        <p class="card-text">Aenean volutpat, sem sit amet ullamcoer gravida, molestie risus enim nulla. Pellentesqu velit faucibus kodale dolor rhoncu.</p>
                    </div>
                    <a href="#" class="overlay"></a>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/home/blog3.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">What are the new trends in cannabis treatments</h5>
                        <div class="date">2023.10.23</div>
                        <p class="card-text">Aenean volutpat, sem sit amet ullamcoer gravida, molestie risus enim nulla. Pellentesqu velit faucibus kodale dolor rhoncu.</p>
                    </div>
                    <a href="#" class="overlay"></a>
                </div>
            </div>
        </div>

        <div class="btn_wrap text-center">
            <a href="#" class="btn style_4">VIEW ALL BLOGS</a>
        </div>
    </div>
</section>

<section class="section our-partners">
    <div class="container">
        <div class="title_wrap text-center">
            <h2>Our <span>trusted</span> partners</h2>
            <p>We are happy to have creative collaborations to improve the way patients receive prescriptions for medical cannabis.</p>
        </div>
        <div class="partners_logo">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/yardly.webp" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/logo.webp" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/can.webp" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/mccs.webp" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/CIS.webp" alt="">
        </div>
    </div>
</section>

<?php get_footer(); ?>