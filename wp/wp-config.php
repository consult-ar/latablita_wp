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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'latablitaar_wp' );

/** MySQL database username */
define( 'DB_USER', 'latablitaar_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'xuO5u^96' );

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
define( 'AUTH_KEY',         'dv ;%0L_r[Pdm7K76vcJx=toxL#xO~LBs+^i:m&9MB6k#L`06[0?i,4V:@6<JJH[' );
define( 'SECURE_AUTH_KEY',  '3q>E@~sV}H=RB]{*rPQofj9l/Te;8IyF|u>$N&fZ._2KXBM[/^+ZELmkBpmdD$r~' );
define( 'LOGGED_IN_KEY',    'o/.`:cM|=~!U;F/Qh5pX6#=ttre$]eqEn5=}g`)f_3!lxtK]*zEM9G~i)Z=vt;3q' );
define( 'NONCE_KEY',        '|KE7::9d7R0>Z<ZPbQW99$jYf7=<q{*MP:U;0>f1$PmD>Z,%|wQ4Y&lQwx=V-sO_' );
define( 'AUTH_SALT',        '4d{j0k@49~ZoC%:xv0zX64hs_WN*ctd]X%jS^3OoN/ovCi+asgtiigh-E3f_wlA3' );
define( 'SECURE_AUTH_SALT', 'm ~^vPD[5=CoWz]pQLYq-s^ F4E$_jS=4l*5).t84K57(m#kb7[.8y8h3hBs6x5.' );
define( 'LOGGED_IN_SALT',   'P*nqp<-yeMah2.5kT%2)/mIFA5JfS&1+:!k3Vw8U0pkF6h*5gKq4N?Fr>QXbs)>F' );
define( 'NONCE_SALT',       'KWJHcL&Ap,55i;4.gv7`kpchR8&pJ3I0;e8r[?R|/K<3mT4lUWfS}btUj~[!Y]M|' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
