<?php
namespace TestFramework;

class GlobalVariables
{
	public $playerId = 0;
	public $playerProvinceR = 0;
	public $playerProvinceQ = 0;
	public $registeredNeighbourId = 0;
	public $sid = '';
	public $csrf = '';
	protected $positionsByPlayerId = [];


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
