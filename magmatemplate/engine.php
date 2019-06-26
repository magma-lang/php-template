<?php
/*
@package: Magma PHP Template Engine
@author: Sören Meier <info@s-me.ch>
@version: 0.1 <2019-06-26>
@docs: templ.magma-lang.com/php/docs/
*/

namespace MagmaTemplate;

function engineInclude( string $path, array $data, Engine $engine ) {
	$includedByEngine = true;
	extract( $data );
	include( $path );
}

class Engine {

	public $data = [];

	public $debug = false;

	protected $templPath = '';

	protected $tmpPath = '';

	protected $parser = null;

	protected $divider = null;

	public function __construct( string $templPath, string $tmpPath ) {

		$functions = [
			'esc' => '\MagmaTemplate\Helper::esc',
			'between' => '\MagmaTemplate\Helper::between',
			'rep' => '\MagmaTemplate\Helper::repeat',
			'inc' => '$engine->parseAndExecute',

			'startBlock' => '\MagmaTemplate\Blocks::start',
			'endBlock' => '\MagmaTemplate\Blocks::end',
			'out' => '\MagmaTemplate\Blocks::out'
		];

		$this->templPath = $templPath;
		$this->tmpPath = $tmpPath;
		if ( !is_dir( $this->tmpPath ) )
			mkdir( $this->tmpPath );

		$this->parser = new BlockParser( $functions );
		$this->divider = new CharDivider( '|' );

	}

	public function addFn( string $fn, string $execution ) {
		$this->parser->addFn( $fn, $execution );
	}

	public function parse( string $file ) {

		$path = $this->templPath. $file. '.html';

		if ( !is_file( $path ) )
			throw new \Error( sprintf( 'could not find file "%s"', $path ) );

		$ctn = file_get_contents( $path );

		$s = '';
		foreach ( $this->divider->divide( $ctn ) as $p ) {

			if ( $p[0] ) // if is block
				$s .= $this->parser->parse( $p[1] );
			else
				$s .= $p[1];

		}

		return $s;

	}

	public function parseAndSave( string $file ) {

		$php = '<?php if ( !isset( $includedByEngine ) ) { die; } ?>';
		$php .= $this->parse( $file );
		file_put_contents( $this->tmpPath. $file. '.php', $php );

	}

	public function parseAndExecute( string $file ) {

		$path = $this->tmpPath. $file. '.php';

		if ( !is_file( $path ) || $this->debug )
			$this->parseAndSave( $file );

		engineInclude( $path, $this->data, $this );

	}

	public function go( string $file, array $data = [], bool $debug = false ) {

		$this->data = $data;
		$this->debug = $debug;

		// Helper::setEngine( $this );

		$this->parseAndExecute( $file );

		// Helper::clearEngine();

	}

	protected static function deleteDir( string $dir ) {

		foreach ( glob( $dir. '*', GLOB_MARK ) as $path )
			if ( is_file( $path ) )
				unlink( $path );
			else
				self::deleteDir( $path );

		rmdir( $dir );

	}

	public function cleanTmps() {
		self::deleteDir( $this->tmpPath );
	}

}