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
define( 'AUTH_KEY',          'Y2#!#eNfXlgOV;T[xr6XYs>FuSCvm!.Q6/A[N:Sm1?_YWlb!/>vku!0R[g1m|-ck' );
define( 'SECURE_AUTH_KEY',   'P59g T12(4udSR]wJfmO]LLC8xQ;&k7nNuSq%:h8]~xTD;g-[RtuwLs8lb(&l?o?' );
define( 'LOGGED_IN_KEY',     'BC(mAq$Nc]d+K_kJ4a%h2dIm(JPC&3{H&dF51I<z{Ba;FAsk7D:5T_|]M_gEALZj' );
define( 'NONCE_KEY',         'Bx``HrAFIGO)iJpjCOl=_Q.Q*ZRLd}e,|#CF|eN)9X,e^%Tq8[Vp}%b7Q8TR-WgL' );
define( 'AUTH_SALT',         'x;W2Z#H8dd,dmz;L4J;}V3oT6|[>m&`PILW?5#YoH?N#X|/(D}[S1=h}?F~1H4n<' );
define( 'SECURE_AUTH_SALT',  'RnT`GL93iYgPy9:ZP|{.,wE{._.Gtt{rROp*n@&qI$|@,acHPgug=HXh<&|,@ozO' );
define( 'LOGGED_IN_SALT',    '&m!u*!<hx:4GatD.rCzv8(<}1#iR9PhCvdAlhsbXu|9=(q]JM>9gsxdYZYG}_rQE' );
define( 'NONCE_SALT',        'tK487Ls]^I.ns# U+i;g_0:~@$N&eG* Y<M7)u&<n5=>C9nW)$hYxc5]`]J69S/5' );
define( 'WP_CACHE_KEY_SALT', 'cYpK&od[]kc-z~A D9Ca$^?D(R-Y`{<G]juv`HuA]c5|LwxLqei/oSp,mA,ey2Ln' );


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
