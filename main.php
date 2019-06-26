<?php

$start = microtime(true);

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once( __DIR__. DIRECTORY_SEPARATOR. 'magmatemplate'. DIRECTORY_SEPARATOR. 'init.php' );

define( 'DS', DIRECTORY_SEPARATOR );
define( 'DIR', __DIR__. DS );

$engine = new MagmaTemplate\Engine( DIR. 'templs'. DS, DIR. 'tmp'. DS );

/// Start

function lang( string $key ) {
	return 'lang';
}

$engine->addFn( 'lang', 'lang' );

$engine->go( 'test', [
	'page' => (object) [
		'title' => 'Title'
	],
	'url' => 'url/abc/'
], true );

// $engine->cleanTmps();

echo 'end '. ( microtime(true) - $start ). 'ms';