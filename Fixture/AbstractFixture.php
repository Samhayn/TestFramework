<?php
namespace TestFramework\Fixture;

use Codeception\Module\ExtendedDbHelper;
use Codeception\Module\MasterDBHelper;
use TestFramework\GlobalVariables;

abstract class AbstractFixture
{
	/**
	 * @var ExtendedDbHelper
	 */
	protected $db = null;

	public function __construct(ExtendedDbHelper $db) {
		$this->db = $db;
	}

	public function getPlayerId() {
		return GlobalVariables::getInstance()->playerId;
	}

}
