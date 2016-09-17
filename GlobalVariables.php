<?php
namespace TestFramework;

class GlobalVariables
{
// define accessible vars here
	private static $inst = null;

	private function __construct() {

	}

	/**
	 * @return GlobalVariables
	 */
	public static function getInstance() {
		if (null === self::$inst) {
			self::$inst = new GlobalVariables();
		}
		return self::$inst;
	}
}
