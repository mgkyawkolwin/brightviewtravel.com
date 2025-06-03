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
define('DB_NAME', 'cp324208_bvtt');

/** MySQL database username */
define('DB_USER', 'cp324208_bvtt');

/** MySQL database password */
define('DB_PASSWORD', 'control7');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '4)sEk^dFMP4#Vd+G/Oh}19?r~2h[~^tgZR9q:9HB:2~ HcmZH#B(^[;|4J|hn/+w');
define('SECURE_AUTH_KEY',  'BR)az6MDmsqy&/RCtZ:)|*x j3K-fm9:l:<<?$p.:]sT+7}wleSvhx{DaSiA2@-I');
define('LOGGED_IN_KEY',    'hU#9r7-B=P^CbeAB.Q:B[N&&*Z?]/lsqGK4e+M UgvUX KzL8Np,zI1n,3a,Q`BE');
define('NONCE_KEY',        '6_et^ZJooEv=YtV^?|mSHwy/:Uqb>{QgUazthMJ.N4i1p<cz261R<ofn&Jc6dGqO');
define('AUTH_SALT',        'S< ftwSda~LDw#wT38<O;SAZ23H&!u;BmuJaV]3zqe9y|UKHm$x{X*&(ZzL{[%SS');
define('SECURE_AUTH_SALT', '30?8 %eqycXE7a.iMf1%^h*i.f@_v5~.T9.LzC4+fAdDi}%JrJfvZ^&96iEs}Anm');
define('LOGGED_IN_SALT',   'fX|7NK}WpG4rV;mobrikf.(Qtc%3`1BBVoFG2Ej{xI4el,@&`fo`1u,pj9z Fj=#');
define('NONCE_SALT',       '$-;RITu:O?tURXP+-58bZn.-N0abc}v!LC(X|6.;>l`7L0i ~GpHTh{^Ii[c.lM!');
define('WP_MEMORY_LIMIT', '128M');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
