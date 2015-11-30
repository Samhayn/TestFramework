<?php
namespace TestFramework\Fixture;

class Quest extends AbstractFixture
{
	private $id = 111;
	const STATE_ACCOMPLISHED = 'accomplished';
	const QUEST_WITH_OFFER_REWARD = 7060;


	public function completeQuest($questId) {

		$this->db->havePermanentInDatabase('game_quests', [
			'id' => $questId,
			'player_id' => $this->getPlayerId(),
			'state' => self::STATE_ACCOMPLISHED,
			'counter' => 0,
			'diamonds_received' => 'FALSE',
		]);
		$this->db->havePermanentInDatabase('game_quest_progress', [
			'id' => $this->id++,
			'player_id' => $this->getPlayerId(),
			'quest_id' => $questId,
			'current_value' => 2,
			'max_value' => 2,
		]);
	}
}