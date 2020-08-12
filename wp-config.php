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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'webapp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '1OuE;2MogFw)#KN`_-WnO7q,m-fu-yr0)hHVKI)3@Js/F::0}e}%Jl$ro$pLV-o;' );
define( 'SECURE_AUTH_KEY',  'S8ux(|j2!]Q+!8DL8[X0ZC-}R/{)Ug{2.tRiJ-oHS*K|>W4|2g%40Nkj9QkSu~s/' );
define( 'LOGGED_IN_KEY',    'o_H488CjtXIXdv9L.}ebDR?o_la1bqyH^9ys;v,<S!g`8r+wCS`lCh*~V=JM7jG(' );
define( 'NONCE_KEY',        'e45oEc*YQSs:M>H}y4AT6B^BmAM?tlxR4mz;`g65JeQZ#=$U:g@Bl4HLohBg00y1' );
define( 'AUTH_SALT',        '2=mh+E<^y75<d[d.<rh4G*aHB;!wwNJaakdhr)e-p40km$UeZU@raGO,ffBP,jNI' );
define( 'SECURE_AUTH_SALT', '7>zAa2ZF=4:%rmzcc4|Q1-$~IqDgfs+lQC6d$E($tYIwJV|1CF=8U[[Xn$P-<(rW' );
define( 'LOGGED_IN_SALT',   '49g3n3skGpw0jl(6nJtvol$dP@$5RbkdN[+qT)jBve(+$[[XMveNvNcyUsG-b}K6' );
define( 'NONCE_SALT',       '(Zicd3y,Vz|LhwKJY[m7lyB]7n7i@)hXkm0//.~x/xabZzm}.y9%I)j9wfLJvVk,' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
