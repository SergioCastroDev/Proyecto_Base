<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'base_proyect' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'oMi ^A<5xl,2+Gt65[GZ$1:==yi|Jd#~sI}tH`&h+{w]RxUCK9Q+C]r=@-=1@@x?' );
define( 'SECURE_AUTH_KEY',  'La#AyK!^.1~x-8:5Rz]75bRH.J=N7,^f:Q=kV*ph&K[T/+S1^7_F*K63$Dg7V4<.' );
define( 'LOGGED_IN_KEY',    'oH;F~Dxnxsj{-Z )]c848#snG,@nS@/{(.og@&GRKjtJXa%0kGSRy-3P~yui}npW' );
define( 'NONCE_KEY',        'S9uE=Y*4$ez=.Nw*S$6i4iiuEt&vm$o8x~m6OIdYy+^V^?B&fKdI>g-HjD^,e<Jf' );
define( 'AUTH_SALT',        'g6fNU:S8tp{Hs=%4yE[wca}1sYJCt}aTJga:d5@EDcV+9T6Y7Ci(~twYfh6R<ok.' );
define( 'SECURE_AUTH_SALT', 'gZ1%O: hPs*p.>N^tx)LTg#9abD-c| _ %lIbo_=Qzn[hbhTI{]caEKSL5IQOw:.' );
define( 'LOGGED_IN_SALT',   't$g.iB(^-xO n<YSNkI|=(D?~:rh%=eQ#a}NWlj.9_NXEw<BlFrw7orI_5804N`G' );
define( 'NONCE_SALT',       'qC8N~I>~x_[m^5Av8bcS;ots(cgjC>K-7O;A$^#3RB`kjGeH[YEX:`t&2/$bZBEh' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
