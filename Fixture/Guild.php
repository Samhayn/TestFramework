<?php
namespace TestFramework\Fixture;

class Guild extends AbstractFixture
{

	public function found() {
		$name = (string) new \MongoId();
		$this->db->havePermanentInDatabase('game_guild',[
			'name' => $name,
			'description' => '',
			'banner_shape_id' => 'guildbanner01',
			'banner_shape_color' => 11862016,
			'banner_symbol_id' => 'guildicon03',
			'banner_symbol_color' => 5744869,
			'invitation_allowed' => 'TRUE',
			'application_allowed' => 'TRUE',
			'created_at' => time(),
		]);
		return $name;
	}

	public function addUserToGuild($name) {
		$guildId = $this->db->driver->getDbh()->query(
			"SELECT id FROM game_guild WHERE name ='{$name}'"
		)->fetchColumn(0);

		$this->db->driver->getDbh()->exec(
			sprintf(
				'UPDATE game_player SET guild_id = %d, guild_role = 1 WHERE id = %d;',
				$guildId,
				$this->getPlayerId()
			)
		);
	}

}