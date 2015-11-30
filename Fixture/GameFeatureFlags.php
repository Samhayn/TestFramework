<?php
namespace TestFramework\Fixture;

use Ig\StratCity\Classes\Amf\Vo\ClientIdentificationVO;

class GameFeatureFlags extends AbstractFixture
{
	private $modified = false;
	private $previousFeatureFlags = null;

	const FF_ANCIENT_WONDERS = 'ancient_wonders';
	const FF_PAYMENT_BUNDLES = 'payment_bundles';

	public function set($name, $status)
	{
		$this->loadPreviousFeatureFlags();
		$this->modified = true;

		$this->db->driver->getDbh()->exec("DELETE FROM game_feature_flags WHERE name = '{$name}';");
		$this->db->havePermanentInDatabase('game_feature_flags', ['name' => $name, 'status' => $status, 'platform_version' => ClientIdentificationVO::PLATFORM_VERSION_WEBSITE]);
	}

	private function loadPreviousFeatureFlags() {
		if (null === $this->previousFeatureFlags) {
			$query = $this->db->driver->getDbh()->prepare('SELECT name, status FROM game_feature_flags');
			$query->execute();
			$this->previousFeatureFlags = $query->fetchAll(\PDO::FETCH_ASSOC);
		}
	}

	public function revert() {
		if (!$this->modified) {
			return;
		}
		$this->db->driver->getDbh()->exec('TRUNCATE TABLE game_feature_flags');
		foreach ($this->previousFeatureFlags as $flag) {
			$this->db->driver->getDbh()->exec("INSERT INTO game_feature_flags (name, status) VALUES ('". $flag['name'] ."', " . $flag['status'] . ")");
		}
	}
}
