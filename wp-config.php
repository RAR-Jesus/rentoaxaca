<?php
/** CloudTech (Remove These Lines) */;

// define('WP_SITEURL','http://localhost/oaxaca');
// define('WP_HOME','http://localhost/oaxaca');

define('WP_SITEURL','http://rentoaxaca.com/');
define('WP_HOME','http://rentoaxaca.com/');
/** 
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ren1321109285702');

/** MySQL database username */
define('DB_USER', 'ren1321109285702');

/** MySQL database password */
define('DB_PASSWORD', 'q6K%60JdPE');

/** MySQL hostname */
define('DB_HOST', 'p3plcpnl0701.prod.phx3.secureserver.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '_gqY*X9yw/$S*(j!kQ1J');
define('SECURE_AUTH_KEY',  '!04WC#RHPQD=1 NVp$Tq');
define('LOGGED_IN_KEY',    'IMwv(wBX31OHzB/LTLpy');
define('NONCE_KEY',        'EaU&S_)E*-hrsG&PfEzd');
define('AUTH_SALT',        'gv-m7_cbPT!n=EqZs%Ra');
define('SECURE_AUTH_SALT', '_1++AFZ8T4y*+FV&Q28m');
define('LOGGED_IN_SALT',   '2Udt#03kB!0tKCPGnx#U');
define('NONCE_SALT',       'kAyVj/n(fK7!dA6b)YLc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
