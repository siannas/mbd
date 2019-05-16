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
define( 'DB_NAME', 'rumahsakit' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'Cq@q>&3:@z;1#_t5$%o64HJ&rCH_|8rN=L9ez6M;(XLxZ&R=W~kW<Re<*5d)kwFc' );
define( 'SECURE_AUTH_KEY',  'Um2RiI+5ij(q)9ou*=Ef93[97W<|.i4x6.:F87YhaVkUiV1=uXSe&Zyb,0$N`KjY' );
define( 'LOGGED_IN_KEY',    '{7;b.p8aH{=9(,o_n$d]hHOU_sLg.tkg&gyf1#G#P{3()2Q~rS%6=`|M%Eqi+l8|' );
define( 'NONCE_KEY',        '-$7=T9KUv]h[C8V{bx(,E@q4A=odI{$~GoP6)96en:)`RIFv}_(Zgi3/gvNc?&IP' );
define( 'AUTH_SALT',        '/mv<MI ]FGr+5Th5(!.{k]eJXJ[BO>zB0DxPkycR0iGG}:NWPa.Z5$v5d:p=)CG+' );
define( 'SECURE_AUTH_SALT', 'cR&V0>_=v?y5pjg{<#m/vRa@s>3aFDPXAb>4UmYo[Zm@&[D%4}!^,57E<{=Fmyo|' );
define( 'LOGGED_IN_SALT',   '^sy3SA.i}Z3Us;ktM@+jwe*&|HQvT305Pn113-]&AsbyR@*OVaHR!w?neUF28[8a' );
define( 'NONCE_SALT',       'D])kt4_;ja7E~>`fbz`8m}*VMUFQ+Ju+b]D9me-`5eWA-(BtT3lKe;4YY(xAW_n7' );

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
