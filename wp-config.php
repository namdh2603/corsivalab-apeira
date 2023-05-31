<?php
define( 'SBI_ENCRYPTION_KEY', '0dM&*$duxmvUg551iUZCdP3qN3uON^&LmF2cqdX8cYpV)WvqBXoz4Cl%7c&ViQmo' );

define( 'SBI_ENCRYPTION_SALT', '^OZ(^mry1j&1LjAN(5yIYx6TbYP(mGz7zq8Vx0!d9Lq%2UUog*(TU)eW<?phpaXCW1k' );

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
define( 'DB_NAME', 'apeira' );

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
define( 'AUTH_KEY',         'MYLZ`W;4J-HVMd}wLpQBmN@0 Zt.AfJ*ZN^+edx*T!9KsnCR~Wz/SlpaG7mhfN_/' );
define( 'SECURE_AUTH_KEY',  '$#2mh]_-f[]FiV;3P>h/2,/~i2:m%FSLV0oIB4Dk{y!x-OgpU?-pN3BhC,xE_?j+' );
define( 'LOGGED_IN_KEY',    '1!36mu_v^ $TW:T!]h{^dC$}3g&*t7id@OvFeLCdvM@#%D[qzgEv@=ns6:} j=Zl' );
define( 'NONCE_KEY',        'nx)LsNYEU/2CEJ&r=3=q_$=/T3FWUdN|}O*D~A 1-bz.yhz{u,&QI0uArG,n`b k' );
define( 'AUTH_SALT',        '3#3aehgKSM/A|&a`Z.,g &HTbj)/YWZ#HucU::E4R**L)g3jKq#6v8huGguTgs:$' );
define( 'SECURE_AUTH_SALT', '{Y>uFTdeFt]`gAK|+}{Q8BGOD5t]0I*0ZCTU]GOe;ro?eREhhz]tQ~,sLt}-*;G[' );
define( 'LOGGED_IN_SALT',   ' PKqX;K9tz2CGp]stF[/:j9J%s@|L*KPZ`.CeZj}<dogELfn}v:J)64V:zBM5&4J' );
define( 'NONCE_SALT',       ',wQN]#JON+{;W}Ih,NC0H(C;$Ikktr));5T|WF`i*9qW[:=dTp7=Vyh3OiY<O&eR' );

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
