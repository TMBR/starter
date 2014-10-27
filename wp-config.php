<?php
// Should only need to modify this line
define( 'DB_NAME', 'tmbr_starter' );

// Rest of these can likely stay the same
define( 'WP_DEBUG', true );
define( 'WP_DEFAULT_THEME', 'tmbr' );

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
define( 'WP_SITEURL', WP_HOME . '/' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define('AUTH_KEY',         's6-+fc~_iZ(NiX};OC.xK5nw*&Y&F{8H>[Bde8+EG6kE SX#,WOM 9r1sDl=FGM4');
define('SECURE_AUTH_KEY',  '+kPNNjXZA>Tik6{h!!4-lhd;|O>!$<Ju<CwZf>#} xnaF[`W+cbc[wmQHs%_(mJ%');
define('LOGGED_IN_KEY',    'WeGu##mnAR^k:2dWXfGE4L,.D7Y|$I6-4^+n7yCGj~F,K#I2)&LPsOkpr[%;.vaa');
define('NONCE_KEY',        '$yK/wL<L5%/}xv-9(U/|LVOKx7#zOc/OXO~`mB{{i|(Pgv1C;hUl$Ry+UV_3h)z:');
define('AUTH_SALT',        '0qsU7#&GJN}V2DNv]4}c~,y`-9!H}V3#?ES(4 +j},H:i<n~_|.wcGExS^W_%DVZ');
define('SECURE_AUTH_SALT', 'JhBW?=|c~nnDMvQv%H& |JXDb8Njh|:wKTwSvy#/6eTL#r;R!7q7<jlDqWi%~fn=');
define('LOGGED_IN_SALT',   '*K|_(O31^^e!i~RI6$Pn?0C1Xn)HHHP3s_)5.t4HsXlD-wb0aM~l(!$AZUu`Jx~u');
define('NONCE_SALT',       'DUZ13/G(RZy3!K9cZmCg3Y+aY%q?[2_[9,=]d.MA*ny1j+t=:F=~?0Q|JJ+=7.VT');

$table_prefix  = 'wp_';

define('WPLANG', '');

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
