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
define( 'DB_NAME', 'keicel' );

/** MySQL database username */
define( 'DB_USER', 'keiceldb' );

/** MySQL database password */
define( 'DB_PASSWORD', '6bXZLhkLtoBGAciq' );

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
define( 'AUTH_KEY',         ']aY&vA2M#9O;S#{+={N!%la6bQ[rT4}^T+v!0MTh^z{ddrsS&71!6PPFV.DY=dtP' );
define( 'SECURE_AUTH_KEY',  'ebe<+.zRvkU)Sjixj%Pon6 (yAv%sT%4hi.axiIn&C@XR:Qg5#CK2.U6{MaT@[:H' );
define( 'LOGGED_IN_KEY',    'lpqk(GX[<Iac4F>>kw=MIe}JrR7:[-&:gx_Fz)69 V4{&Gku )=~`w4lGys,(EKV' );
define( 'NONCE_KEY',        '5l0*2Jbo3J85t-EAxRrEU!gp!Qj)eY/DzL4I- }`PokXa70)?(n.4 gY_z47M]Y3' );
define( 'AUTH_SALT',        'wm3k6awMe2!5fmD0!9_wrp!e<*VN>U]bsNA,>*}!hg`-]aOy/*F}?<}chz;To3pb' );
define( 'SECURE_AUTH_SALT', 'JUBxn^T`aO f!I2Z>A<d*=hp(`;xw#2IBl,^@Ls2`[g&ezqWRfK&m!8a5;o=F8!S' );
define( 'LOGGED_IN_SALT',   '!Oh =P.m<*%mt.Atq#cPg=od:9|1:(f,/=8.kT?SMKsU}j,[zlcpXOiCu&KrCC{X' );
define( 'NONCE_SALT',       'L_?RDOa{tC9*a8uh`;gGXu*uC+r[/Xun*[ilX^I;=#tQV.``5Pen3)1MDO1+FdJ{' );

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
