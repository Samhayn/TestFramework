<?php
namespace TestFramework\Fixture;

class Offer extends AbstractFixture
{
	const BUNDLE_WORKER_PREMIUM = 'worker_premium_bundle';

	public function activateOffer($bundleId) {
		$this->db->havePermanentInDatabase('game_player_offers',[
			'player_id' => $this->getPlayerId(),
			'bundle_id' => $bundleId,
			'activation_time' => time() - 1000,
			'expiration_time' => time() + 1000,
			'active' => 'TRUE',
			'bought' => 0,
		]);
	}

	public function inactiveByTimeOffer($bundleId) {
		$this->db->havePermanentInDatabase('game_player_offers',[
			'player_id' => $this->getPlayerId(),
			'bundle_id' => $bundleId,
			'activation_time' => time() - 200,
			'expiration_time' => time() - 100,
			'active' => 'TRUE',
			'bought' => 0,
		]);
	}

	public function inactiveByStatusOffer($bundleId) {
		$this->db->havePermanentInDatabase('game_player_offers',[
			'player_id' => $this->getPlayerId(),
			'bundle_id' => $bundleId,
			'activation_time' => time() - 200,
			'expiration_time' => time() + 100,
			'active' => 'FALSE',
			'bought' => 0,
		]);
	}
}