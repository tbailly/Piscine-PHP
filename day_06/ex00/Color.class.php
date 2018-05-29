<?php

Class Color {

	private $_red   = 0;
	private $_green = 0;
	private $_blue  = 0;

	public static $verbose = False;

	public function __construct(array $kwargs) {
		$colorTab = $kwargs;
		if (array_key_exists('rgb', $colorTab) && is_int($colorTab['rgb']))
			$colorTab = $this->getPrimaryColors($colorTab);

		if (array_key_exists('red', $colorTab) && array_key_exists('green', $colorTab) && array_key_exists('blue', $colorTab)) {
			$this->setRed($colorTab['red']);
			$this->setGreen($colorTab['green']);
			$this->setBlue($colorTab['blue']);
		}

		if (self::$verbose)
			printf( "Color( red: %3d, green: %3d, blue: %3d ) constructed." . PHP_EOL, $this->_red, $this->_green, $this->_blue );
	}

	public function __destruct() {
		if (self::$verbose)
			printf( "Color( red: %3d, green: %3d, blue: %3d ) destructed." . PHP_EOL, $this->_red, $this->_green, $this->_blue );
	}

	public function __toString() {
		$res = sprintf( "Color( red: %3d, green: %3d, blue: %3d ) destructed." . PHP_EOL, $this->_red, $this->_green, $this->_blue );
		return ($res);
	}

	private function getPrimaryColors(array $args) {
		$colorTab = array();
		$colorTab['red']   = ($args['rgb'] / 256 / 256) % 256;
		$colorTab['green'] = ($args['rgb'] / 256) % 256;
		$colorTab['blue']  = $args['rgb'] % 256;
		return ($colorTab);
	}

	public function getRed() { return $this->_red; }
	public function getGreen() { return $this->_green; }
	public function getBlue() { return $this->_blue; }

	public function setRed($colorToSet) {
		$colorToSet = (int)$colorToSet;
		if ($colorToSet > 255)
			$this->_red = 255;
		else if ($colorToSet < 0)
			$this->_red = 0;
		else
			$this->_red = $colorToSet;
		return;
	}

	public function setGreen($colorToSet) {
		$colorToSet = (int)$colorToSet;
		if ($colorToSet > 255)
			$this->_green = 255;
		else if ($colorToSet < 0)
			$this->_green = 0;
		else
			$this->_green = $colorToSet;
		return;
	}

	public function setBlue($colorToSet) {
		$colorToSet = (int)$colorToSet;
		if ($colorToSet > 255)
			$this->_blue = 255;
		else if ($colorToSet < 0)
			$this->_blue = 0;
		else
			$this->_blue = $colorToSet;
		return;
	}

	public function add(Color $colorToAdd) {
		$newColor = array(
			'red'   => ($this->_red + $colorToAdd->red),
			'green' => ($this->_green + $colorToAdd->green),
			'blue'  => ($this->_blue + $colorToAdd->blue)
		);
		return (new Color($newColor));
	}

	public function sub(Color $colorToSub) {
		$newColor = array(
			'red'   => ($this->_red - $colorToSub->red),
			'green' => ($this->_green - $colorToSub->green),
			'blue'  => ($this->_blue - $colorToSub->blue)
		);
		return (new Color($newColor));
	}

	public function mult($factor) {
		$newColor = array(
			'red'   => ($this->_red * $factor),
			'green' => ($this->_green * $factor),
			'blue'  => ($this->_blue * $factor)
		);
		return (new Color($newColor));
	}

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