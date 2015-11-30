<?php
namespace TestFramework\Fixture;

use Codeception\Module\Db;

class Expansion extends AbstractFixture
{
	const UNLOCKED_THROUGH_RESEARCH = 'research';

	public function unlock($x, $y, $width = 5, $length = 5) {
		$this->db->havePermanentInDatabase('game_citymap_unlocked_area', [
			'player_id' => $this->getPlayerId(),
			'x' => $x,
			'y' => $y,
			'width' => $width,
			'length' => $length,
			'unlocked_through' => self::UNLOCKED_THROUGH_RESEARCH,
			'timestamp' => time() - 300,
		]);
	}
}