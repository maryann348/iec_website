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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'QtTVHCLO(a`ZhCv|[<mg#u;$6y;3i:xo{(bfBe6/#LNyyi=50 oB|RH6FwW*E:>S' );
define( 'SECURE_AUTH_KEY',  'Ws,zc}DCC^{i=r&s&kp#|~yZ}wBxgw2YuOM)_B8G5+}#6&jf)3;#:Y$iEprvUwbq' );
define( 'LOGGED_IN_KEY',    'lwek`r?6;oZ~fC~0~z;>r70cTz]gS$zw{~HxHYqF6,Qkd+`=F{QVp,lP8}l=k8f|' );
define( 'NONCE_KEY',        '1.cN0:r{$OG,i]ko$b]0)#b!$3*3oqiD4Lp|kReb3SH]DK~u4$z[0gU2$!iT~r[<' );
define( 'AUTH_SALT',        '_%mb?VS6@XCa61t+F]Ux}}xnR,-2$8,R)LDK@],`p{98!UNJo/z^yx:(a5p6+PN3' );
define( 'SECURE_AUTH_SALT', '_TD_7>0w]$H6%*3Y+QwP>uF%NPs2VD4qRO3[,[UPV](|~(%/3:!T?j9QhB;hHCdI' );
define( 'LOGGED_IN_SALT',   'Y|1#bHJ_MH8t7DTyaV3fc_{z!2fPr},Z0)ax2k+1yaY<sMw}/hfKyDx657Y5.Li/' );
define( 'NONCE_SALT',       'F0[o%g(ZiyILddRz*5q;:J;j|eB%1FmqWIgJz2mA12I.(uag9>8FVPm/82b7$G=x' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_webdev';

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
