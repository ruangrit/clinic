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
define('DB_NAME', 'clinic');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'M0]=G]x~X_>=-#KJ#P;K3k{hl>V$(Z<Yt!k?$1KgaKCV|UTP!2yd?.nB%dE?6f,!');
define('SECURE_AUTH_KEY',  ')%uT9 Og2lbn~)+C,bYVHM:]rM FH|_5JDp@iZJ%mJIxr)nGS9N%dskAL#HyXWH?');
define('LOGGED_IN_KEY',    '[JWfglK={M+JNNyyW_lA,!78}b eX$}*H TX3PT=?}I@+>*N8|@J^6+b8=Mao0I_');
define('NONCE_KEY',        '<}L #VTV<.g%}Mb3im5t:b^@p%](t-rVss9*8N*T{`9`,[)unX9|o02oF42au:F@');
define('AUTH_SALT',        '|_c%zDe]gCv9f3W<MD:-/j>(y`d[~/v*LV1e}3-K(y,>V/>VBJ}:*bLdD@rDOr:A');
define('SECURE_AUTH_SALT', 'b~IOZk#wm=B%pq?3t*/bkXYuh%=b)Ke[bm1%@=%Edex>sLFL:4*X?f<1@DYMxG+g');
define('LOGGED_IN_SALT',   '9-]0S!<.#rHOBeU8/e31UE$$*r>Jj(E|Yog1@$y.W4tDr6(^w<:V117TcOvqp(9W');
define('NONCE_SALT',       'VM&;8cJ`Wf|[*$G({)sUwW^]4LS%<K^6+U7$hk${{l*{(Y&A8dlCuaGQ56 1_brX');

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
