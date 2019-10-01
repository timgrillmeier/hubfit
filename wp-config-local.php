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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wordpress' );

/** MySQL hostname */
define( 'DB_HOST', 'database' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '/msNL8ml?Ga_7;Wh;jyr:_!aD6?vIe&IGTc7_7JD:7!~BDhrsyz=VER~}_~40,:y');
define('SECURE_AUTH_KEY',  'vY<T|*XO?3*9)`7W4tcfqFX+6h7S)7@-f#^s/1$&-x1q74 e`ub.7>3b#&@2|R~z');
define('LOGGED_IN_KEY',    'hVx r4U3Ya}o9xtr-y.TB-%PWeQ<z:V~PxTKhA th|M]k%L+1W~Hv!X-3jbL<UWv');
define('NONCE_KEY',        '_ SYqW.pD<vA%sj3u(B/V5RmlVL>E0aNbN-/JJ2cjB=[oGCW-;]6OXRZdKCD=uu3');
define('AUTH_SALT',        '(k*,20`j|R:aiJ+pdh/)up#Ouyk%7NVqbAGw;yJul7wRU8hF5~tx08Je/:xl@N/b');
define('SECURE_AUTH_SALT', 'o*c*/^0pkEKieHbQfZD=-e-GG,FwO+0Q]Ty2Qn[(~er^8ueA6wt^dOuvi=ecWbM+');
define('LOGGED_IN_SALT',   ' 7-A2tk=2v]xPiRzDEs~sfW)GG_k}G>WozNyWL]?L!!$)OD%T(P&c:#y9RJSa$rh');
define('NONCE_SALT',       '0t.YJjU;Mu<FVH,y/U;#-npjlqtp]5l>7FXH/[!#2vC48uv-2+Jq#4?zP#ZthD9R');

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
