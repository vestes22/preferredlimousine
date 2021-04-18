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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'UcUJbDDFa40IKvzMDRH7IerbWjayb5WiM4fKbUpaloI50a//6UAsUDbt1NJ9ARvJK2HzZPoDvXbaawNwQxsMmQ==');
define('SECURE_AUTH_KEY',  'FA05HdSzjUajm2fUfESP27huQmlknZP7XLU3TztEvfNZkUrvSyDJxwmeQCHaDMOcjFuxQrqL4q8KagJeR6CRXA==');
define('LOGGED_IN_KEY',    'a91wec+bG1hpOUg77plBDRQhtbbSKrYn4kOEfXzaNec8/Hfx8CehJpj2BnG5gP7JTGESP/G8gBV6hVSqHP3eLw==');
define('NONCE_KEY',        'WWZHf3bbCZgND4oop6UrxDifV3qocE6DtmqJ6t7g3ZZiUnS2S8yTZrqYXWoZQkr9/N8mRRWLZ/DMYWyKs+k8Ng==');
define('AUTH_SALT',        'yueGYwtWc9Xuaap99S+jJjUEwOxFQSduhwbzEPbZmRXaBcDDVKCAmHzqIFahQ80TDL3WDueZyUpSA0jJvUOSDg==');
define('SECURE_AUTH_SALT', 'xML0d1HR+iHUlitpKKoHhGLhzYjHMMrmgh1rpnz8Mk86j0utROAjBlnO0upXJBFokVCl9PRpW/YSifdoCcH4VQ==');
define('LOGGED_IN_SALT',   'AgHcJcyUwu7yZjVKq7Re3e96jqQC8a7ihSa6V804Dg3ybsZzJ5yjFRNF6uW3Oq+gi0rALcj3vaXjDUiV3RolEQ==');
define('NONCE_SALT',       'ZE3xXRRFYQJ8YRgT3wUqlWNCR6fE6akfiKqOfAxlAhA6Mbs/W02r9CN3a9KPlYadq1JEV+gk+uBQ+MdWXnoAJg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
