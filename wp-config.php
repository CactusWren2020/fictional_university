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
define( 'DB_NAME', 'fictionalu' );

/** MySQL database username */
define( 'DB_USER', 'fictionalu' );

/** MySQL database password */
define( 'DB_PASSWORD', 'p)t48j8pS!' );

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
define( 'AUTH_KEY',         'quoamso8rjlqihiwp91ybjhbqt8srbq1mqn4tlyamymhdxqlufve8rrm4tej8weh' );
define( 'SECURE_AUTH_KEY',  '57d0otxtd4o0l9nvjiarlk8mtwk7ihtjjskhf89mg78hfgyfftcrzw1khodybsqy' );
define( 'LOGGED_IN_KEY',    'abr5uswfbi5hd8x5fomrihuojhapxs8lljiktaqwvtdsdpj8tpys5kf5pgxrknya' );
define( 'NONCE_KEY',        'la2l75530b0a8opnntpngakumcwkqqu8vua2t1rj9j9oxqft0du7ktliy8ammq9t' );
define( 'AUTH_SALT',        'gmbznnoqoaviwfzfr1hj9k090g6lzigywteia24hunootslf8erjhbsstsataqd7' );
define( 'SECURE_AUTH_SALT', 'n63n86gvaponlrl0tyrcbnbmo2iu00zr1cpfhpssxr26kx50iiu5hduk2svzwtgh' );
define( 'LOGGED_IN_SALT',   'rbpl7gn5iepye5blcxwdwqwmxhihctwvwtmv6yykx7mwgy1lzrb0wyk6yrhvhyd7' );
define( 'NONCE_SALT',       '1jieqdn9hqdegs4dbcvljsjmoxchzqfqzndlgm1gvnwcyb5zm7oy2nx6kdsmtme4' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'fict';

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
