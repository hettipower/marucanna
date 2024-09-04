<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'marucanna' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'B|AmIye}VpZSTzu^0|U]b>>:gj]G_={6[0TBou%8P*$s#*W81{!.^ve[/?jP,OF ' );
define( 'SECURE_AUTH_KEY',  'hKzboaYF/LUVbeP*!^0F(! 8t[dZ4H CIt)w8Ub/3qvi8VIp^U639;9mo?%X]?#a' );
define( 'LOGGED_IN_KEY',    'bG3!5*SF[`<zP`%aw^D&Xq7`yq&fo7%:/]nd#BWqT1fiSqD}{P>bex@!wkxN:Rl2' );
define( 'NONCE_KEY',        'TIS5X%q)l)6hBV0Bh[?4CHBhx4ps~&s|]HS_D=Zq=1b32>&2.) UXF3,dmXSMaj.' );
define( 'AUTH_SALT',        '>uAHa*q,pX$1UZj/h AmJrH1Bs$&T, EK$hKJ]+@BZ[7M@C$cDS[Vu`_zEmbUe)o' );
define( 'SECURE_AUTH_SALT', '~%9DBsj*3[0BfW:zY[wfie3hHPC;7+Km^ilZoDviYclaX.Kz 4V$}y5^U>d^aA2=' );
define( 'LOGGED_IN_SALT',   'X[cHfBJ$/}Q^qFo}z<Ph<{9s4Gra/ZXT:6^Th%=):_0fQfCb)>MUC_)*bN;1u%Rs' );
define( 'NONCE_SALT',       'W6ss!I~#e7,;(^s+=Pe>7eZTM}T|Q@SuO_lq.=G8brt?]QrXO2=[?(:E9lko+$-D' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wprl_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
