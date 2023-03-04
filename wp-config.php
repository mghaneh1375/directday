<?php
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
define( 'DB_NAME', 'directday' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'Ghhy@110' ); //Asd12#45_

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
define( 'AUTH_KEY',         'i:C+nRRl;x;`)) ;^~za,Ozg$J7tM[aX->T /12:7pm#V_(Q-)[?R&E(zMLfHz4U' );
define( 'SECURE_AUTH_KEY',  '1(Xtr$]UIeT>:9#(/,nH?;b7-,jHpao.Nw6.k$_ER0oXCQ:OJ^QY_Ny/RQ9B4)@V' );
define( 'LOGGED_IN_KEY',    'Rh-=R0>4V1:n$2h=@[wW2:S{-P+nC%fe+cBl{vrp *5<FQ*NFNwjLvE}6bTes0>N' );
define( 'NONCE_KEY',        'D]ZHtX)mj{.yc-)sr4G>|ar!JaLI.-X<a+XYu;8nj/y3,zkT<mGyAOp+*l<FtaQW' );
define( 'AUTH_SALT',        '2SZ2eQYhOV%9-i O;(A,Ql7BW]su/c(^+IoM(c YAI(vp89- )=gpiRQ.8^wI-%t' );
define( 'SECURE_AUTH_SALT', '})Lh(LN`M,cm9O4sV(^l!plx2]/kgszDBvx]?&rmdlDYCFhAMMC+5wiKqcm>6^1Z' );
define( 'LOGGED_IN_SALT',   'Qm,Wsy%Vd9s5e@MM)z2<<jT9OA| ky`?ek>) +XmFdnYS#^BKZ)6n9hxQ}x[KR}Z' );
define( 'NONCE_SALT',       '1k3`-bInjm5]TsEVCuRHieJ{Q_%flfAe{@#q)VX<!?2s<3YaywX+K@,)7V*Zs5<W' );

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
