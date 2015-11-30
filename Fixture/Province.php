<?php
namespace TestFramework\Fixture;

class Province extends AbstractFixture
{
	public function scout($r, $q)
	{
		try {
			$this->db->havePermanentInDatabase('game_world_map_good_provinces', [
				'r' => $r,
				'q' => $q,
			]);
		} catch (\PDOException $e) {
			// correct case to have duplication on global map
		}

		$provinceId = $this->getIdByCoordinates($r, $q);

		$this->db->havePermanentInDatabase('game_world_map_scouted_provinces', [
			'player_id' => $this->getPlayerId(),
			'province_id' => $provinceId,
			'scouting_technologies' => 0,
		]);
		return $provinceId;
	}

	public function getIdByCoordinates($r, $q) {
		return $this->db->driver->getDbh()->query(
			"SELECT id FROM game_world_map_good_provinces WHERE r = {$r} AND q = {$q}"
		)->fetchColumn(0);
	}
}