<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dgc' );

/** MySQL database username */
define( 'DB_USER', 'dgc' );

/** MySQL database password */
define( 'DB_PASSWORD', 'C0d1g0' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9u:1!f1XE)oE#b_LP7&9A~U2;hB?UgA<WP-M$70u^N- ,NP_`gp|svq11J])v;&A' );
define( 'SECURE_AUTH_KEY',  '@$B9l3VdP(>[xC,UPKyj`@SP%i{ix>Ihza_j+o=e.^:,ox=SSfOhp1VYhCG1=Xf|' );
define( 'LOGGED_IN_KEY',    '7kB[Env.mHZ]t_E8B$Rfyr;&n TkCD3h])ol&F$4&UbTI63+$A/4gj24Fe3n[r)O' );
define( 'NONCE_KEY',        ';%l=}$U-(/=DWa<DCaF&IYT f&p#<!piE]&7A=(SCo^HP7 PuY<b+sHo!Y:y(^W7' );
define( 'AUTH_SALT',        '{?C)8RxVi??,RI$ool6tX;NhpLLZ*wHtts?PhcMF;/7xgCcAh{h$ndOCX`!j)S[g' );
define( 'SECURE_AUTH_SALT', 'StD,SUaEHhyJv/yq41aRe6vg3GVK%zxs,rV(l;xF?l:cz0We(B,MK*V+:Qc -%`+' );
define( 'LOGGED_IN_SALT',   '*s<!LcH3_HqIFS&jZ,ke@K6}fm&aB!4vQ-@$4fR=ZgOU/VH2}U3 NEYnZJ~&t. }' );
define( 'NONCE_SALT',       'PSt#QR.S2;Wo)o8.x(fxS/m$O_A:p[ XmAFW NK5B_sN^_ro<<|W,a.jN{7!={e5' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
