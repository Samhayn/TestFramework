<?php
namespace TestFramework\Fixture;

class Manufactories extends AbstractFixture
{
	const TYPE_PRODUCING = 'Producing';
	const TWO_DAY = 4;

	public function production($entityId, $type, $transitionAt = 0, $current_product = null)
	{
		$fields = [
			'entity_id' => $entityId,
			'player_id' => $this->getPlayerId(),
			'type' => $type,
			'transition_at' => $transitionAt,
		];

		if (null !== $current_product) {
			$fields['current_product'] = $current_product;
		}

		$this->db->havePermanentInDatabase('game_city_map_entity_states', $fields);
	}
}