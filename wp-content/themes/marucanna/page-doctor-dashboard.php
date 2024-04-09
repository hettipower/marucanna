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

        <?php get_template_part( 'template-part/doctor', 'dashbord-nav' ); ?>
        
        <table id="patients_details" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th style="width: 350px;">Actions</th>
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

                            $patient_url = get_author_posts_url($patient->ID);
                    ?>
                        <tr>
                            <td>
                                <a href="<?php echo $patient_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo $patient->user_login; ?>
                                </a>
                            </td>
                            <td class="patient-name">
                                <a href="<?php echo $patient_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo $name; ?>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </td>
                            <td><?php echo $phone; ?></td>
                            <td style="width: 405px;">
                                <?php if( !$consultant ): ?>
                                    <a href="<?php echo home_url('consultant?patient_id='.$patient->user_login . '&patient='.$patient_post_id.'&doctor='.$user->ID); ?>" class="btn style_4 small">Consultation</a>
                                <?php else: ?>
                                    <a href="<?php echo admin_url( 'admin-post.php?action=create_consultation_file_pdf&patient='.$patient_post_id ); ?>" class="btn style_4 small">Consultation File</a>
                                <?php endif; ?>
                                <a href="<?php echo home_url('about-us/patient-follow-up/?patient='.$patient->ID.'&patient_post='.$patient_post_id.'&doctor='.$user->ID); ?>" class="btn style_2 small">Follow Up</a>

                                <a href="<?php echo admin_url( 'admin-post.php?action=create_patient_file_pdf&patient='.$patient_post_id ); ?>" class="btn style_3 small">Export Patient File</a>
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