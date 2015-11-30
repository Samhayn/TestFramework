<?php
namespace TestFramework\Fixture;

class CityBuilder extends AbstractFixture
{
	protected $idPart = 123;
	const CE_S_HUMANS_TRAIL = 'S_Humans_Trail';
	const CE_R_HUMANS_RESIDENTIAL_1 = 'R_Humans_Residential_1';
	const CE_A_HUMANS_STATUE_1 = 'A_Humans_Statue_1';
	const CE_B_HUMANS_AW1_1 = 'B_Humans_AW1_1';
	const CE_Z_HUMANS_WORKERHUT_1 = 'Z_Humans_WorkerHut_1';
	const CE_Z_HUMANS_WORKERHUT_2 = 'Z_Humans_WorkerHut_2';
	const CE_Z_HUMANS_WORKERHUT_3 = 'Z_Humans_WorkerHut_3';
	const CE_P_HUMANS_WORKSHOP_1 = 'P_Humans_Workshop_1';
	const CE_B_DWARFS_AW2_1 = 'B_Dwarfs_AW2_1';
	const CE_G_HUMANS_FACTORYWOOD_1 = 'G_Humans_FactoryWood_1';
	const CE_G_HUMANS_FACTORYSTONE_1 = 'G_Humans_FactoryStone_1';
	const CE_G_HUMANS_FACTORYMETAL_1 = 'G_Humans_FactoryMetal_1';

	const CE_A_ELVES_BOAT_1 = 'A_Elves_Boat_1';

	const TYPE_CONSTRUCTION = 'Construction';

	private $cityEntityToType = [
		self::CE_S_HUMANS_TRAIL => 'street',
		self::CE_R_HUMANS_RESIDENTIAL_1 => 'residential',
		self::CE_A_HUMANS_STATUE_1 => 'culture',
		self::CE_B_HUMANS_AW1_1 => 'ancient_wonder',
		self::CE_B_DWARFS_AW2_1 => 'ancient_wonder',
		self::CE_Z_HUMANS_WORKERHUT_1 => 'worker_hut',
		self::CE_Z_HUMANS_WORKERHUT_2 => 'worker_hut',
		self::CE_Z_HUMANS_WORKERHUT_3 => 'worker_hut',
		self::CE_P_HUMANS_WORKSHOP_1 => 'production',
		self::CE_G_HUMANS_FACTORYMETAL_1 => 'goods',
		self::CE_G_HUMANS_FACTORYSTONE_1 => 'goods',
		self::CE_G_HUMANS_FACTORYWOOD_1 => 'goods',

		self::CE_A_ELVES_BOAT_1 => 'culture',
	];

	public function remove($cityMapId)
	{
		if (!$cityMapId) {
			throw new \RuntimeException('To remove a cityMap entity i need the CityMapId');
		}
		$this->db->driver->getDbh()->exec(
			"DELETE FROM game_citymap_entity WHERE player_id={$this->getPlayerId()} AND id={$cityMapId}"
		);
	}

	public function upgrade($cityMapEntityIdToUpgrade, $cityMapEntityAfterUpgrade, $level) {
		$this->db->driver->getDbh()->exec(
			sprintf(
				"UPDATE game_citymap_entity SET cityentity_id  = '%s', level = %d WHERE cityentity_id = '%s' AND player_id = %d",
				$cityMapEntityAfterUpgrade, $level, $cityMapEntityIdToUpgrade, $this->getPlayerId()
			)
		);
	}

	public function inConstruction($cityMapEntityIdToUpgrade, $cityMapEntityAfterUpgrade, $level, $timeInConstruction) {
		$this->upgrade($cityMapEntityIdToUpgrade, $cityMapEntityAfterUpgrade, $level);

		$this->db->havePermanentInDatabase('game_city_map_entity_states', [
				'entity_id' => $this->db->getCityMapId($cityMapEntityAfterUpgrade),
				'player_id' => $this->getPlayerId(),
				'type' => self::TYPE_CONSTRUCTION,
				'transition_at' => time() - $timeInConstruction,
			]
		);
	}

	public function insert($cityEntityId, $x, $y, $level = 1)
	{
		if (!isset($this->cityEntityToType[$cityEntityId])) {
			throw new \RuntimeException('This city entity is not defined in tests: ' . __CLASS__);
		}

		$this->db->havePermanentInDatabase('game_citymap_entity', [
			'id' => $this->idPart++,
			'player_id' => $this->getPlayerId(),
			'cityentity_id' => $cityEntityId,
			'type' => $this->cityEntityToType[$cityEntityId],
			'x' => $x,
			'y' => $y,
			'connected' => 1,
			'level' => $level,
			'unlocked_slots' => 0,
		]);
	}
}
