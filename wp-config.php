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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'store-front-custom' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'yuRm9e0SgevTzdt1kAAOdOgMCtRiGz0B7RiDkHa4q4uR8c0iq3DcdWAPnUGQsXDX' );
define( 'SECURE_AUTH_KEY',  '231ByDLrpr9Pck2rpqFtsH3i2HCaBNIAPtOuKnswaXNnXbKuAyuFzsxPuuMtLikH' );
define( 'LOGGED_IN_KEY',    '0nxz5w0dxri54136HKgpI4FBTHPBvOdczG4DvCgWJ524yNEGqmIvxLQgcEpRAp4k' );
define( 'NONCE_KEY',        '7uFmZ3noTvW4xo2PoJ4hxZWJtIfde4vuTDFf0vOXFctIkctlEZNuUVdfHnsV8RgH' );
define( 'AUTH_SALT',        'PAGF5dM03XzC2eukfN0ezWKiwihELVHSu4McqAiEg7BePl1PjWkmd8Bp5KRjYHkf' );
define( 'SECURE_AUTH_SALT', 'kSitnQhsOPr18xjtW1nBAMrSpVQ38ncbb6sxV6qwQv7Lq9qspWkT8Mb7I6Va3uFp' );
define( 'LOGGED_IN_SALT',   'iB4lEcqUnxckM9DXokUwNJXiNB97gSJn5ocCmFsbtfoRhpYTyH4yIS664UiSo8P1' );
define( 'NONCE_SALT',       'u0cHI5tPkQIPOgBP1uj22NBIleSeANVDR7njyQPI7vlY32EbhojyGwOz7LZ8xOFY' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
