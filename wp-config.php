<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demo2' );

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
define( 'AUTH_KEY',         'aSt[Hc(t%Sly4^rHKdVsghSB%cbGdjX_KogK9]SFjUCl Sl_yEG-_PZgg>OkaImE' );
define( 'SECURE_AUTH_KEY',  'orGCXr?%`6q653{+!3jY.sK8&1p;mG-TSCTPUu-=7luRO$+P@wXF|Kt$Kvn#O8SE' );
define( 'LOGGED_IN_KEY',    '~u;Vsx3G8$dpL@j:)?O~x(kQ(B4x>!W-G``9tPk:9x@Pr(?}:Rd({c< ?S|e)*}<' );
define( 'NONCE_KEY',        '1uML9Vu[H!YLV6(`P,Q1Z8tH|xdx?wNr(1Iy;6j[2)#~:s)|;#Q;kFLdWx^[c#Yc' );
define( 'AUTH_SALT',        'O)[Sml>7#?vni8MtR-};0PK=%TzZJeUS$fBw(ydspNQ |1kp,GxPvI9;lPmln/L[' );
define( 'SECURE_AUTH_SALT', 'l %sT%J-cnaW!s:,wMbrEkS B(m_(8k{/^4t2`l8#axs#:~DmQzsr~(Y?.m^m0/M' );
define( 'LOGGED_IN_SALT',   'e.~kTx=AmlC~^+>Nk*ZS^c,XY?pc.E,XEE(5X@~2|dSLNQ7oe6`KC*f]f_2&V14&' );
define( 'NONCE_SALT',       'P(m8S>%N>`;F8~+gl;X{J?^$p<*V7fANaJFAsF&;2M!j,qKm` ;KpEQn:fi]$$6N' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
