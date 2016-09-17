<?php
namespace TestFramework;

use Codeception\Module\Db;

class Fixture {

	/**
	 * @var Db
	 */
	private $db = null;

	public function __construct(Db $db) {
		$this->db = $db;
	}

}
