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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'maFPF+0t.l|T3-{lFGnA7t 4v)+1IYO`q>IU|TpmZK1Q7^9)TwUAyv-0s&X~;^(=' );
define( 'SECURE_AUTH_KEY',   'H1.|i9aaqr}?^LNHpw:XxOhozhSm[#V(xFa[02-}{0:._p0fKa!9#9&q7v,Iqk?H' );
define( 'LOGGED_IN_KEY',     '75Wq1+VK^^}aPDLQJ3*W DUV&X.t;1A`dq0_]-<64C0Ap&~uUJM%;z|W{r,&h,al' );
define( 'NONCE_KEY',         'MtX)@9OHa0gV5!. u5:J<MV}*ZDB64-mr^WS/QdA:0Z~mPTgy%;%ZIqOsO<Vz$)?' );
define( 'AUTH_SALT',         '6WBgNV1]2G4r)-TBG=.,YwW;MlLe+ qR,eOK]|~ okYufW[9*lgc2^V<qN@6$Q^~' );
define( 'SECURE_AUTH_SALT',  '5F|_-wFmHA<`Xgu!nuhX*GG=B|@w,L&`HYgD>NJ4,B}0k-(^7sEe-8R8HLya_m|y' );
define( 'LOGGED_IN_SALT',    'f0j8|U;RS358HA.]Jk(eQJJJaW>{Pj!IBN~1D[qrF&o0L}K/SmtqP6I?]0wA8hr=' );
define( 'NONCE_SALT',        '8Fi{#q s$]F#7b3Wv4,CT *oaWgzGJvE=4gJ?6o5$u~~Csam+nEGS.|Pg-B&qCff' );
define( 'WP_CACHE_KEY_SALT', 'uUw&2:f+I^IXQ,<~{z2 -C4h2Edt$4s$SY}{ gEzaU j2.W([fPXw$}mh)i?jU0M' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
