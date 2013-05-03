<?php
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
define('DB_NAME', 'stream');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'KM+d&o<|62pp`,0Q6)DuP@o5FwZ?1mY]qW9] )L{?/[zY6myq4uK&6^D+F89;o&S');
define('SECURE_AUTH_KEY',  '@J!,+$01[p5%e/I*jPyy[esqbdsAJTF}x PPaZc~N8eTZ<0}+fkaE*=5Sdmh}DXX');
define('LOGGED_IN_KEY',    '4G{$+&o4J76l;`.D;Tv:RA`*Hp TobF[%k?ea^Z3g #Kw$#[J~<xXWW:$tRI #z)');
define('NONCE_KEY',        '}*>cfs+a&@=7&<oZ:t;/CTIG@5ZGz!*yjZAv$K9[YLmVK_L#7ivKXU1G.Dz=70#c');
define('AUTH_SALT',        '_HM^gK(ai?,T5EXWUfou^`,U84{vQpeV3FDOC^Qy+~hkK44MO7]BkU?6pC*w_tZ%');
define('SECURE_AUTH_SALT', '5u{Fm3P#L&xAP2VN>=<^0Va%+_[F|PFe16oD8;80t`E#y)`-w]f1jUnGGQZJ(}@D');
define('LOGGED_IN_SALT',   'LBaOKS,TKE2a*@3ohVxV),N4t_R..P}AET<7lsJB ECl cW>bo<?88+T%7D+PB-R');
define('NONCE_SALT',       '@_R;s&86>AovUnO1*H9TgC^bmRv*M0%7U[U4c11i=Qpg}EvnN6`q0)[OchF_2&Mj');

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
