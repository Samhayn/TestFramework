<?php
namespace TestFramework\Fixture;

class Encounter extends AbstractFixture
{
	const UNLOCK_ACTION_TRADE = 'trade';

	public function solve($provinceId, $number, $unlockAction = self::UNLOCK_ACTION_TRADE) {
		$this->db->havePermanentInDatabase('game_world_map_encounters', [
			'player_id' => $this->getPlayerId(),
			'province_id' => $provinceId,
			'encounter_number' => $number,
			'unlock_action' => $unlockAction,
			'unlock_timestamp' => time() - 300,
		]);
	}

	public function solveRange($provinceId, $numberFrom, $numberTo) {
		for ($i = $numberFrom; $i <= $numberTo; $i++) {
			$this->solve($provinceId, $i);
		}
	}
}