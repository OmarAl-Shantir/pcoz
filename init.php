<?php

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
if ( ! defined( 'HOMEPAGE' ) ) {
	define( 'HOMEPAGE', __DIR__ );
}
if ( ! defined( 'TASKS' ) ) {
	define( 'TASKS', 4 );
}
if ( file_exists( ABSPATH . 'config.php' ) ) {
	require_once ABSPATH . 'config.php';
}
require_once ABSPATH.'class-autoloader.php';
