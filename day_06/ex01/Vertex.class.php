<?php

Class Vertex {

	private $_color = 0;
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;

	public static $verbose = False;

	public function __construct(array $kwargs) {
		if (!array_key_exists('x', $kwargs) || !array_key_exists('y', $kwargs) || !array_key_exists('z', $kwargs))
			return;

		$this->setX($kwargs['x']);
		$this->setY($kwargs['y']);
		$this->setZ($kwargs['z']);

		if (array_key_exists('w', $kwargs))
			$this->setW($kwargs['w']);

		if (array_key_exists('color', $kwargs) && ($kwargs['color'] instanceof Color))
			$this->setColor($kwargs['color']);
		else {
			$white = new Color( array('red' => 255, 'green' => 255, 'blue' => 255) );
			$this->setColor($white);
		}

		if (self::$verbose) {
			printf( "Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) constructed" . PHP_EOL,
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}

	public function __destruct() {
		if (self::$verbose) {
			printf( "Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) destructed" . PHP_EOL,
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}

	public function __toString() {
		$res = sprintf( "Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f", $this->_x, $this->_y, $this->_z, $this->_w);
		if (self::$verbose)
			$res .= ', ' . $this->_color . ' )';
		else
			$res .= ' )';
		return ($res);
	}

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }
	public function getColor() { return $this->_color; }

	public function setX($x) { $this->_x = (float)($x); }
	public function setY($y) { $this->_y = (float)($y); }
	public function setZ($z) { $this->_z = (float)($z); }
	public function setW($w) { $this->_w = (float)($w); }
	public function setColor($color) { $this->_color = $color; }

	public static function doc() {
		$className   = self::class;
		$doc_content = file_get_contents($className . '.doc.txt');
		$res = "<- $className ----------------------------------------------------------------------" . PHP_EOL .
			$doc_content .
			"---------------------------------------------------------------------- $className ->" . PHP_EOL;
		return ($res);
	}
}

?>