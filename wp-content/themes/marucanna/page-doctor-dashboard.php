<?php 
/* Template Name: Doctor Dashboard */

get_header(); 

if (is_user_logged_in()):
    $user = wp_get_current_user();
    $allowed_roles = array( 'doctor', 'administrator' );
    if ( array_intersect( $allowed_roles, $user->roles ) ) :
        $patients = get_users( array(
            'role__in' => array( 'patient' )
        ));
        $form = (isset($_GET['form'])) ? $_GET['form'] : false;
        $status = (isset($_GET['status'])) ? $_GET['status'] : false;
        $need_followup_patients = get_need_follow_up_patients();
?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
        <?php if ( get_field( 'page_title' ) ) { ?>
            <h1><?php the_field( 'page_title' ); ?></h1>
        <?php } else { ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>   
                <h1><?php the_title(); ?></h1>
            <?php endwhile; endif; ?>
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

<section class="section dashboard_wrapper">
    <div class="container">

        <?php if( $form == 'note' && $status ): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Note added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if( $form == 'prescription' && $status ): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Prescription added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if( $form == 'mdt' && $status ): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                MDT added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php get_template_part( 'template-part/doctor', 'dashbord-nav' ); ?>
        
        <table id="patients_details" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th class="hide">NHS Number</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th style="width: 480px;">Actions</th>
                </tr>
            </thead>
            <?php if( $patients ): ?>
                <tbody> 
                    <?php 
                        foreach( $patients as $patient ): 

                            $is_valid_patient = check_valid_patinet($patient->ID);

                            if( !$is_valid_patient ) {
                                continue;
                            }

                            $patient_post_id = get_user_meta( $patient->ID, 'patient_info', true );
                            $name = get_field('name', $patient_post_id);
                            $phone = get_field('phone', $patient_post_id);
                            $consultant = get_user_meta( $patient->ID, 'consultant', true );
                            $mc_consultation_date = get_field('mc_consultation_date', $patient_post_id);
                            $meeting_date = get_field('meeting_date', $patient_post_id);
                            $follow_up_appointments = get_field('follow_up_appointments', $patient_post_id);
                            $prescription_date_1 = get_field('prescription_date_1', $patient_post_id);
                            $prescription_date_2 = get_field('prescription_date_2', $patient_post_id);
                            $prescription_date_3 = get_field('prescription_date_3', $patient_post_id);
                            $other_prescription_data = get_field('other_prescription_data', $patient_post_id);
                            $nhs_number = get_field('nhs_number', $patient_post_id);

                            $patient_url = get_author_posts_url($patient->ID);
                    ?>
                        <tr>
                            <td>
                                <a href="<?php echo $patient_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo $patient->user_login; ?>
                                </a>
                            </td>
                            <td class="hide"><?php echo $nhs_number; ?></td>
                            <td class="patient-name">
                                <a href="<?php echo $patient_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo $name; ?>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <?php echo $nhs_number ? "(NHS#: $nhs_number)" : ''; ?>
                            </td>
                            <td><?php echo $phone; ?></td>
                            <td style="width: 540px;text-align: right;vertical-align: middle;">
                                <?php if( !$consultant ): ?>
                                    <a href="<?php echo home_url('consultant?patient_id='.$patient->user_login . '&patient='.$patient_post_id.'&doctor='.$user->ID); ?>" class="btn style_4 small">Consultation Needed</a>
                                <?php else: ?>
                                    <a href="<?php echo admin_url( 'admin-post.php?action=create_consultation_file_pdf&patient='.$patient_post_id ); ?>" class="btn style_4 small">Consultation Complete</a>
                                <?php endif; ?>
                                <a href="<?php echo home_url('about-us/patient-follow-up/?patient='.$patient->ID.'&patient_post='.$patient_post_id.'&doctor='.$user->ID); ?>" class="btn style_2 small">Follow Up</a>

                                <a href="<?php echo admin_url( 'admin-post.php?action=create_patient_file_pdf&patient='.$patient_post_id ); ?>" class="btn style_3 small" target="_blank">Export Patient File</a>

                                <div class="dropdown">
                                    <button class="btn style_4 small dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addNoteModal<?php echo $patient_post_id; ?>">Add Note</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mdtModal<?php echo $patient_post_id; ?>">MDT</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#prescriptionModal<?php echo $patient_post_id; ?>">Prescription</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#quickSummeryModal<?php echo $patient_post_id; ?>">Quick Summary</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $patient_url; ?>?activetab=pills-letters" target="_blank" rel="noopener noreferrer">Letters</a></li>
                                    </ul>
                                </div>

                                <div class="modal fade" id="addNoteModal<?php echo $patient_post_id; ?>" tabindex="-1" aria-labelledby="addNoteModal<?php echo $patient_post_id; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="addNoteModal<?php echo $patient_post_id; ?>Label">Add Note</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo do_shortcode('[gravityform id="14" title="false" ajax="true" field_values="patient_post_id='.$patient_post_id.'"]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="mdtModal<?php echo $patient_post_id; ?>" tabindex="-1" aria-labelledby="mdtModal<?php echo $patient_post_id; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="mdtModal<?php echo $patient_post_id; ?>Label">MDT</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo do_shortcode('[gravityform id="15" title="false" ajax="true" field_values="patient_post_id='.$patient_post_id.'&doctor='.$user->ID.'"]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="prescriptionModal<?php echo $patient_post_id; ?>" tabindex="-1" aria-labelledby="prescriptionModal<?php echo $patient_post_id; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="prescriptionModal<?php echo $patient_post_id; ?>Label">Add Prescription</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo do_shortcode('[gravityform id="16" title="false" ajax="true" field_values="patient_post_id='.$patient_post_id.'"]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="quickSummeryModal<?php echo $patient_post_id; ?>" tabindex="-1" aria-labelledby="quickSummeryModal<?php echo $patient_post_id; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="quickSummeryModal<?php echo $patient_post_id; ?>Label">Quick Summary</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="list-items">

                                                    <?php if( $mc_consultation_date ): ?>
                                                        <div class="item">
                                                            <span>Initial consultation date :</span>
                                                            <div class="value">
                                                                <?php echo $mc_consultation_date; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if( $meeting_date ): ?>
                                                        <div class="item">
                                                            <span>MDT meeting date :</span>
                                                            <div class="value">
                                                                <?php echo $meeting_date; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if( $follow_up_appointments ): ?>
                                                        <div class="item">
                                                            <span>Follow up date : </span>
                                                            <div class="value">
                                                                <?php
                                                                    foreach( $follow_up_appointments as $follow_up ) {
                                                                        echo '<span>'.$follow_up['appointment_date'].'</span>';
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if( $prescription_date_1 || $prescription_date_2 || $prescription_date_3 || $other_prescription_data ): ?>
                                                        <div class="item">
                                                            <span>Prescription date :</span>
                                                            <div class="value">
                                                                <?php if( $prescription_date_1 ): ?>
                                                                    <span><?php echo $prescription_date_1; ?></span>
                                                                <?php endif; ?>

                                                                <?php if( $prescription_date_2 ): ?>
                                                                    <span><?php echo $prescription_date_2; ?></span>
                                                                <?php endif; ?>

                                                                <?php if( $prescription_date_3 ): ?>
                                                                    <span><?php echo $prescription_date_3; ?></span>
                                                                <?php endif; ?>

                                                                <?php
                                                                    if($other_prescription_data) {
                                                                        foreach( $other_prescription_data as $prescription ) {
                                                                            echo '<span>'.$prescription['prescription_date'].'</span>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>

    </div>
</section>

<?php get_footer(); ?>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

<?php if( $need_followup_patients ): ?>
<div class="modal fade" id="needFollowupModal" tabindex="-1" aria-labelledby="needFollowupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="needFollowupModalLabel">The following patient are due their next follow up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <?php foreach( $need_followup_patients as $followup ): ?>
                        <li class="list-group-item"><?php echo $followup['name']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    var root = document.getElementsByTagName( 'html' )[0];
    var needFollowupModalEle = document.getElementById('needFollowupModal');
    
    document.addEventListener('DOMContentLoaded', function () {
        var needFollowupPopup = new bootstrap.Modal(needFollowupModalEle);

        needFollowupPopup.show();
    });

    needFollowupModalEle.addEventListener('shown.bs.modal', event => {
        root.classList.add('moda-open-html');
    });
</script>
<?php endif; ?>

<?php
    else:
        wp_redirect( home_url() );
        die();
    endif; 
else:
    wp_redirect( home_url('login') );
    die();
endif;
?>