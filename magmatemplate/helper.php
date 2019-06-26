<?php
/*
@package: Magma PHP Template Engine
@author: Sören Meier <info@s-me.ch>
@version: 0.1 <2019-06-26>
@docs: templ.magma-lang.com/php/docs/
*/

namespace MagmaTemplate;

class Blocks {

	protected static $blocks = [];

	public static function start() {
		ob_start();
	}

	public static function end( string $name ) {
		if ( !isset( self::$blocks[$name] ) )
			self::$blocks[$name] = ob_get_clean();
	}

	public static function out( string $name ) {
		echo self::$blocks[$name] ?? '';
	}

}

class Helper {

	public static function between( int $a, int $b ) {
		$ar = [];

		$up = $a < $b;
		$add = $up ? 1 : -1;

		for ( $i = $a; ( $up ? $i < $b : $i > $b ); $i += $add )
			$ar[] = $i;

		return $ar;
	}

	public static function repeat( int $num, $str ) {
		return str_repeat( $str, $num );
	}

	public static function esc( string $str ) {
		return htmlspecialchars( $str, ENT_HTML5 | ENT_QUOTES, 'UTF-8' );
	}

}