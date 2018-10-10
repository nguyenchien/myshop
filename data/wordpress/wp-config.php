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
define('DB_NAME', 'myshop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'PH}k.%)lc}==S]g$U;m}3{=^r4yz[Jq}GZ{>L#8.)[#k?##[+ANgg(|Kz#8K#_5^');
define('SECURE_AUTH_KEY',  'f,=ssv&lr#@>yO5T`WNzFs0}*jE|JV9W&txr)c0]7n)Z_( <@C;K(q_t#bmhdD#^');
define('LOGGED_IN_KEY',    '<69&(~a)o](o?%GLnc_a{ecgfK&bp0Hd4sqfvew:f[]RYDmf%krcBQ9y`X%t`f=D');
define('NONCE_KEY',        'WBNXS;TxJ8rH)JeC=IO6^gu636Wz*Kr{-}!M&Cw2u.hW+O &$2,V+|RbA;M?1k-n');
define('AUTH_SALT',        'm74> +^7S_3aD8pg#r}Z?oGSDrd>{kVx%rE[G<-dw[TnZ~yCT|H]0,HHg.tkQOf4');
define('SECURE_AUTH_SALT', '$x;$ cAe)tct. 0F-*{G)^2{A~h:kOHlQr5)qrj/!sRiJ!Y2_TAoN]Y}@r :G)LW');
define('LOGGED_IN_SALT',   'wazy:OY]}.L,Z:V? 4LcR:fBT]!_w/A{<Q!}nAPZ~Ep<t1}io_9DWwR~q5 %]dm2');
define('NONCE_SALT',       'g={9pZ|H,*?!Rl2id=*Qp%]Z,W|rfA-<Vu_7xD#xcnwWEYq-)?G%nu7dG7DCM5Qm');

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


/*======================================================================================================================
    ĐỊNH NGHĨA HẰNG SỐ ĐỊA CHỈ CHO WEB
======================================================================================================================*/
// Base url (/myshop/data)
$base_dir = '/'.implode('/', array_slice(explode('/', __DIR__), -3, 2));
define('BASE_URL','http://'.$_SERVER['SERVER_NAME'].$base_dir);

// Theme url (.../twentyseventeen)
define('WP_URL', get_parent_theme_file_uri());