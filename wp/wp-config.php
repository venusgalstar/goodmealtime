<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

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
define( 'DB_NAME', 'i7452067_wp3' );

/** Database username */
define( 'DB_USER', 'i7452067_wp3' );

/** Database password */
define( 'DB_PASSWORD', 'S.gXidxP6KftzS20UvZ99' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'YvopV3XiPsVz51kHmbIUl9SiQY4ntrWZaUMpV1A4i6sNZ3sMUAy7ZDOe5iFwkbg4');
define('SECURE_AUTH_KEY',  'QLoUDooXDSOG13EWCVZrjP12PqX8CYVo4Unn7QScqqM3ma34v7ZQw8Ux9TXUMIL2');
define('LOGGED_IN_KEY',    'mjtZecmjouzrPPgELy1HKdP6IZ2S2ttMcxJXjsuCxWGPomOV5kXJESbPao3SPeyi');
define('NONCE_KEY',        'smRZkN2jo1IH5sGq2caX8T1IyaxK46H9NCvvXefj0qIpcI8vhGA1qzvFLpP5tXAZ');
define('AUTH_SALT',        'm808uMyh6Ozb4eDOoaHsdzqS2OBmDZdZS7kkGlM7ZpB1ZCdwbaJmT5imJrjoTv5I');
define('SECURE_AUTH_SALT', 'NOeCxwqoAXm3HHnfaBU68CG4LD6O9KBIk4TKbGjtuZWDq6jbkQvwY7tHPzpmTaQq');
define('LOGGED_IN_SALT',   'Z0XQ8YBWdnBswrJPP1OuQl3fqcbSrzU8TJvEUtTuGoqU6339Vj9nSlAPb3A4DCfe');
define('NONCE_SALT',       'mDKNBUmDpnpYjxzPDeIWTNij252rQrKpfG9yuH8FxsHqHwogMfdFuSvIUaNc2jHF');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


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
