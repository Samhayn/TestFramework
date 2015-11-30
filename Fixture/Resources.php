<?php
namespace TestFramework\Fixture;

class Resources extends AbstractFixture
{
	const R_PREMIUM = 'premium';

	const R_MONEY = 'money';
	const R_SUPPLIES = 'supplies';

	const R_PLANKS = 'planks';
	const R_MARBLE = 'marble';
	const R_STEEL = 'steel';

	const R_RELIC_STEEL = 'relic_steel';

	const B_HUMANS_AW1_SHARDS = 'b_humans_aw1_shards';

	public function setGood($name, $amount) {
		$this->db->driver->getDbh()->exec("DELETE FROM game_player_goods WHERE player_id = {$this->getPlayerId()} AND good_id = '{$name}';");
		$this->db->havePermanentInDatabase('game_player_goods', [
			'player_id' => $this->getPlayerId(),
			'good_id' => $name,
			'value' => $amount,
		]);
	}

	public function getResource($name) {
		$result = $this->db->driver->getDbh()->query("
			SELECT {$name} FROM game_player_resources WHERE player_id = " . $this->getPlayerId())->fetchColumn(0);

		return $result;
	}

	public function getGood($name) {
		$result = $this->db->driver->getDbh()->query("
			SELECT value FROM game_player_goods WHERE player_id = " . $this->getPlayerId() . "
				AND good_id = '{$name}'")->fetchColumn(0);

		return $result;
	}

	public function setBaseResources($marble, $steel, $planks) {
		$this->setGood(self::R_MARBLE, $marble);
		$this->setGood(self::R_STEEL, $steel);
		$this->setGood(self::R_PLANKS, $planks);
	}

	public function setResource($name, $amount) {
		$this->db->driver->getDbh()->exec(
			"UPDATE game_player_resources SET {$name} = {$amount} WHERE player_id = {$this->getPlayerId()}"
		);
	}

	public function setStrategyPoints($amount) {
		$this->db->driver->getDbh()->exec(
			"UPDATE game_player_resources SET strategy_points = {$amount}, strategy_points_last_change = " . time() ." WHERE player_id = {$this->getPlayerId()}"
		);
	}

	public function setCommonResources($money, $supplies) {
		$this->db->driver->getDbh()->exec(
			sprintf(
				"UPDATE game_player_goods SET value = %d WHERE player_id = %d AND good_id = '" . self::R_MONEY . "';
				UPDATE game_player_goods SET value = %d WHERE player_id = %d AND good_id = '" . self::R_SUPPLIES . "';",
				$money,
				$this->getPlayerId(),
				$supplies,
				$this->getPlayerId()
			)
		);
	}
}
