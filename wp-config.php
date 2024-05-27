<?php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_MEMORY_LIMIT', '256M');


define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u823984162_99v8e' );

/** Database username */
define( 'DB_USER', 'u823984162_p6c48' );

/** Database password */
define( 'DB_PASSWORD', 'T8aUceLijU' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '<SyD-jS0t_mbw`/c9Snn|01CvLz&8NL*dgU;0YvNCr @~+cKr<7bdz{-W}3hm!Vu' );
define( 'SECURE_AUTH_KEY',   'i~9nU@%_h@a?0.e[1&Snv-aZLd@W]b|h9>qm$S}.7=/mJ&[fGAPS2]zeas,CdrrL' );
define( 'LOGGED_IN_KEY',     '}G)W9DV+ZFPw}Vjrkz~Be}2Eg8<+XmgrAbom7w/3gx~8x}9R[)H%aM4U:|^9>6oG' );
define( 'NONCE_KEY',         '^-f6a%k&EX@y`{.]~a%Ni{!2T2kh3H28{?CI&o`/h/RRdE#Q/{Lxak5lP%!*vN)?' );
define( 'AUTH_SALT',         'Y0JOF=*j ?#WJ+2)n@Q&u]PyA9*l^+H;bt;@I0v ?1n*+]QmfA`LAb]zoz|D,SFO' );
define( 'SECURE_AUTH_SALT',  'M)B`(k}K#]9V,I17=Hs-P;>485/:{; w@=|}X6!0@VG3bmo$3rr/U6thZCE~(#Pg' );
define( 'LOGGED_IN_SALT',    'g0U`{tLW n(mlS1FCsmt4>T|;vkz1:+FB3[1]L4DUF1tfZ-Eb^s)3nIdw_>& sqy' );
define( 'NONCE_SALT',        '.*-gzq}e$nP*0c:;V1l/V,vctFIp#Gw1^U_$_AWj4Tb/Ee&CHMKj-}}DNAEg^TH)' );
define( 'WP_CACHE_KEY_SALT', '}]Efb3Wb]aZ$=;<bocK:N|=DNOLGEVdhfZkWi>*^Nhxv`;d>GlRL3%@G3DqW/jk;' );


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



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('DISALLOW_FILE_EDIT', false);
define('DISALLOW_FILE_MODS', false);