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

define('WP_MEMORY_LIMIT', '64M');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'knowingberlin_prod');

/** MySQL database username */
define('DB_USER', 'tatjana');

/** MySQL database password */
define('DB_PASSWORD', 'Najlepsija');

/** MySQL hostname */
define('DB_HOST', 'mysql.tatjanizza.com');

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
define('AUTH_KEY',         'sa;)Kc)$0YuO~D)qHejl<jNR>vr+/C9`ZG.diZJ_:NqMF7qATq?y g9}xG?ydf.@');
define('SECURE_AUTH_KEY',  'pEYWYX_k%7Qh^Io^D~-&>pJRqllq~6(I?TsRf?:Yqyh3y>It+2YfidRV4Ii+%gu-');
define('LOGGED_IN_KEY',    'vNQWs tetz9YE<RZ;5/azZ5)}|jzh=>I6^D{R&vN 3Fe$F9c{@75|?H8]Kjqz=fQ');
define('NONCE_KEY',        'ttC6tLc^DMmx,&{?qK4-#hxuQ^M;DY8RW,*~REU1ZFASo{_(0wYHg([;1E43]ip3');
define('AUTH_SALT',        ':(sMrOL.+a@|sWzld[MM1xqk~L#?vF8^sn@^&[1RKoqQ5#wByFwUl!VW@vhAuZlR');
define('SECURE_AUTH_SALT', '<oZ7@({)jl!R5dRIWuf *YK72`j*Qn|w[hikTRx>xBXzaT(7FM!W?3d_8q](PgMx');
define('LOGGED_IN_SALT',   ';m5+j^wa*Y3cOdOU}O0e|L#xxw$![L; ^h9C+3~jq{7iMaVyF%+tQT>h{&#zpC:*');
define('NONCE_SALT',       'wr 4(G%g7Px}HKD)}xu.fZ?CiU?|*em>lxv%xE[@0U=,<VJ;[/VT1f;cdi;[%yHZ');

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
