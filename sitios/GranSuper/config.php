
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
define( 'DB_NAME', 'gsuser' );

/** MySQL database username */
define( 'DB_USER', 'gsuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'I5BTURlaluWH67PN' );

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
define( 'AUTH_KEY',         'UY@X?NEzj&vkl@&0(D<+e_F_QdoX0RH!l|)*2?6hS]WVhFUC?(P%W^51ms=F-$zS' );
define( 'SECURE_AUTH_KEY',  'h[pgOMb)TO+7,oMBLBR?87{P&B[$1F@iw~ju]{}#T)>PZWXgTuib_&]ZgFLOw y~' );
define( 'LOGGED_IN_KEY',    'LB>;f[fZf}y;iuL%I3l a11RxxgEnH|9mV}v2ByTypk|DYopQ5$e+}jsci5R=:Q;' );
define( 'NONCE_KEY',        '<:9kN;zv;>r~i>t.3!Xu:d*+5CR?YV6*Ox0T]@zOP dni@$#Zo4AplUv_X9b iHB' );
define( 'AUTH_SALT',        'MT6IW8e5BBN%v4p{STpa!,5_ Ge5V.y9bV,Tohr.#^fodkUDl9lyLD7E+$@ .:9C' );
define( 'SECURE_AUTH_SALT', '1 |/s`!+VcA2a/y< V4q7/jL$^evT77Djm@D~cc;)W__<rb^5itw!NRC0w]6esG[' );
define( 'LOGGED_IN_SALT',   'N:D;n~~I&|sI}@W]y3KU#J6kXlh.l)p0v=SV;noTl{bGq`U}b+,h&kF:6:ugN9}{' );
define( 'NONCE_SALT',       '(HgRso &c|}B!m8 /.Er Gt!n4-&(=_FEX)x)B1,vJL)&4-=$ 9[oWz[2IFX>w@Q' );

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

