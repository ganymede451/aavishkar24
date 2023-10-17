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
define( 'DB_NAME', 'aavishkar' );

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
define( 'AUTH_KEY',         'mOg+-e`2~4*,s?N8)QsMSrlNjs:<S<CQRsNE;FJZU5V|;}(YvtA5uQ(S<o(mK=p4' );
define( 'SECURE_AUTH_KEY',  'StTR%6VmW0R311J2H</S>!hr@gqI~b0Z*a~ibIQ!a7s_nW%pLu_!FE:SdeY@T7va' );
define( 'LOGGED_IN_KEY',    't9N=A4C($!VQswT?K*`_OT}F>yl[o>tHMI6:U!&5{Q8M=AhPi~Ge s-DB&PvoX[D' );
define( 'NONCE_KEY',        'ww7LewOc!u#*|Q{Wd`0hNHmGu|jBZuu5Gf>!ckZmAcR#o]bb`gA{g6vpkjyi8M*o' );
define( 'AUTH_SALT',        'X=ZYwK{9,{KQq=7[+$Y3{#E90OxmdD]Vs73>.WhlZW5@e(orybfDqJ/29.sPDpZR' );
define( 'SECURE_AUTH_SALT', 'v-8:v?E4SiNUv}tb068`EK4uakpYp!D*@W?(=D$h,*}.L%+-FEK=)MIbqZyQUWTR' );
define( 'LOGGED_IN_SALT',   'XK/~GqSg1Pa1 2r<iEV^g9{}B>?iP.3qyw3}E.TRl|]&J$3OWj$0NFI^CzF>wvOZ' );
define( 'NONCE_SALT',       'atiX-Jk7_!-GBQ}B3U:YeFdqDyH8Z-/}C0y@ M(.6MV%>I`/PI40kq@.*Z*WcU.;' );

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
