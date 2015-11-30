<?php
namespace TestFramework\Fixture;

class Technology extends AbstractFixture
{

	const T_HUMANS_WORKSHOP_S = 'humans_workshop_s';
	const T_HUMANS_WEALTH_S_1 = 'humans_wealth_s_1';
	const T_HUMANS_BASERACE_AW = 'humans_baserace_aw';
	const T_HUMANS_DWARVEN_AW = 'humans_dwarven_aw';
	const T_HUMANS_GOODS_S_1 = 'humans_good_s_1';
	const T_HUMANS_GOODS_S_2 = 'humans_good_s_2';
	const T_HUMANS_GOODS_S_3 = 'humans_good_s_3';
	const T_HUMANS_BONUS_1 = 'humans_good_bonus_1';

	const T_ELVES_WEALTH_L_1 = 'elves_wealth_l_1';

	protected $technologyConf = [
		self::T_HUMANS_WORKSHOP_S => [
			'current_strategy_points' => 3,
		],
		self::T_HUMANS_WEALTH_S_1 => [
			'current_strategy_points' => 5,
		],
		self::T_HUMANS_BASERACE_AW => [
			'current_strategy_points' => 90,
		],
		self::T_HUMANS_DWARVEN_AW => [
			'current_strategy_points' => 95,
		],
		self::T_HUMANS_GOODS_S_1 => [
			'current_strategy_points' => 32,
		],
		self::T_HUMANS_GOODS_S_2 => [
			'current_strategy_points' => 28,
		],
		self::T_HUMANS_GOODS_S_3 => [
			'current_strategy_points' => 30,
		],
		self::T_HUMANS_BONUS_1 => [
			'current_strategy_points' => 14,
		],

		self::T_ELVES_WEALTH_L_1 => [
			'current_strategy_points' => 30,
		],
	];

	public function open($technologyId, $paid = true)
	{
		$this->validateTechnology($technologyId);

		$this->db->havePermanentInDatabase('game_player_technologies', array_merge($this->technologyConf[$technologyId], [
			'player_id' => $this->getPlayerId(),
			'tech_id' => $technologyId,
			'last_changed' => time() - 200,
			'is_paid' => $paid ? 'TRUE' : 'FALSE',
			'ignore_money' => 'FALSE',
			'ignore_supplies' => 'FALSE',
		]));
	}

	public function invest($technologyId, $amount) {
		$this->validateTechnology($technologyId);

		$this->db->driver->getDbh()->exec(
			sprintf('UPDATE game_player_technologies SET current_strategy_points = %d
					WHERE player_id = %d AND tech_id = \'%s\'', $amount, $this->getPlayerId(), $technologyId)
		);
	}

	private function validateTechnology($technologyId) {
		if (!isset($this->technologyConf[$technologyId])) {
			throw new \RuntimeException('This technology is not defined in tests: ' . __CLASS__);
		}
	}
}