<?php
include __DIR__ . '/location-info.php';

use Square\Environment;
use Ramsey\Uuid\Uuid;
// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

add_shortcode( 'payment', 'mc_payment_shortcode_func' );
function mc_payment_shortcode_func( $atts ) {

    $location_info = new LocationInfo();

    ob_start();

    wp_enqueue_script('squarecdn');
    wp_enqueue_script('sq-card-pay');
    wp_enqueue_script('sq-payment-flow');
    ?>
        <script type="text/javascript">
            window.applicationId = "<?php echo getenv('SQUARE_APPLICATION_ID'); ?>";
            window.locationId = "<?php echo getenv('SQUARE_LOCATION_ID'); ?>";
            window.currency = "<?php echo $location_info->getCurrency(); ?>";
            window.country = "<?php echo $location_info->getCountry(); ?>";
            window.idempotencyKey = "<?php echo Uuid::uuid4(); ?>";
        </script>

        <form class="payment-form" id="fast-checkout">
            <div class="wrapper">
                <div id="card-container"></div>
                <button id="card-button" type="button">Pay with Card</button>
                <span id="payment-flow-message"></span>
            </div>
        </form>
    <?php
	return ob_get_clean();
}