<?php
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
define( 'DB_NAME', 'marucanna_shop' );

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
define( 'AUTH_KEY',         '3u<5}GNQqu@=NoK( ??pFkW>;8PuNDZ&p2hjPrA!Ph^Pf#;v.f%8yD11Lf*>&C9 ' );
define( 'SECURE_AUTH_KEY',  ' .|$ VHQ>J70{;apGY]*g8Dyq:aB0Hpzs12)PaQne+&2g=Vfd#ug=o4+LS@,?[rx' );
define( 'LOGGED_IN_KEY',    '^8x{_bX;k;-Iz[}St15>bC[=r-upqK-2:oEu`iqV>k)J$zH<>e65t!oN_(@8pgK3' );
define( 'NONCE_KEY',        'zBRxd-s3+}3+k)XTLJ{w4!ps4sjS`*=(~2/q^n;#-*sGW,Kwl^@[BF5-x}%vA_LU' );
define( 'AUTH_SALT',        'l!ds~[H9Uy*5T5ChJ AyBu{3v32&H?O.S+Wm_]kck4a83%ThIoZRxX)+]RX,Vbt^' );
define( 'SECURE_AUTH_SALT', 'IC98n*`w,GK47~AMBCGkBjNzxi7e^,er.g6(HPkl1QdD,XBSUgOE[~EWtb&I=swS' );
define( 'LOGGED_IN_SALT',   'L-OuqGhERGVM#>O)tpHEa{OZ/G9Phns9KUrc8`f7~$k$tY91G8b``81U5gZ^lcb(' );
define( 'NONCE_SALT',       'Q@)A^Q9E[aDY+a_5ajMM2`h=MKK{p[G}$P.lX6U2UdoRet(v[4(cYmo5ihAGG dC' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
