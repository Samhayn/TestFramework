<?php
namespace TestFramework;

use Codeception\Module\Db;
use TestFramework\Fixture\Encounter;
use TestFramework\Fixture\Expansion;
use TestFramework\Fixture\GameFeatureFlags;
use TestFramework\Fixture\Guild;
use TestFramework\Fixture\Manufactories;
use TestFramework\Fixture\Offer;
use TestFramework\Fixture\Province;
use TestFramework\Fixture\Technology;
use TestFramework\Fixture\CityBuilder;
use TestFramework\Fixture\Resources;
use TestFramework\Fixture\Quest;

class Fixture {

	/**
	 * @var Db
	 */
	private $db = null;

	/**
	 * @var CityBuilder
	 */
	private $cityBuilder = null;
	/**
	 * @var Resources
	 */
	private $resources = null;

	/**
	 * @var GameFeatureFlags
	 */
	private $gameFeatureFlags = null;

	/**
	 * @var Technology
	 */
	private $technology = null;

	/**
	 * @var Province
	 */
	private $province = null;

	/**
	 * @var Encounter
	 */
	private $encounter = null;

	/**
	 * @var Expansion
	 */
	private $expansion = null;

	/**
	 * @var Manufactories
	 */
	private $manufactories = null;

	/**
	 * @var Quest
	 */
	private $quest = null;

	/**
	 * @var Guild
	 */
	private $guild = null;

	/**
	 * @var Offer
	 */
	private $offer = null;

	public function __construct(Db $db) {
		$this->db = $db;
	}

	/**
	 * @return CityBuilder
	 */
	public function city() {
		if (null === $this->cityBuilder) {
			$this->cityBuilder = new CityBuilder($this->db);
		}
		return $this->cityBuilder;
	}

	/**
	 * @return Manufactories
	 */
	public function manufactories() {
		if (null === $this->manufactories) {
			$this->manufactories = new Manufactories($this->db);
		}
		return $this->manufactories;
	}

	/**
	 * @return Quest
	 */
	public function quest() {
		if (null === $this->quest) {
			$this->quest = new Quest($this->db);
		}
		return $this->quest;
	}

	/**
	 * @return Resources
	 */
	public function resources() {
		if (null === $this->resources) {
			$this->resources = new Resources($this->db);
		}
		return $this->resources;
	}

	/**
	 * @return Technology
	 */
	public function technology() {
		if (null === $this->technology) {
			$this->technology = new Technology($this->db);
		}
		return $this->technology;
	}

	/**
	 * @return Guild
	 */
	public function guild() {
		if (null === $this->guild) {
			$this->guild = new Guild($this->db);
		}
		return $this->guild;
	}

	/**
	 * @return GameFeatureFlags
	 */
	public function gameFeatureFlags()
	{
		if (null === $this->gameFeatureFlags) {
			$this->gameFeatureFlags = new GameFeatureFlags($this->db);
		}
		return $this->gameFeatureFlags;
	}

	public function expansion()
	{
		if (null === $this->expansion) {
			$this->expansion = new Expansion($this->db);
		}
		return $this->expansion;
	}

	/**
	 * @return Province
	 */
	public function province() {
		if (null === $this->province) {
			$this->province = new Province($this->db);
		}
		return $this->province;
	}

	/**
	 * @return Encounter
	 */
	public function encounter() {
		if (null === $this->encounter) {
			$this->encounter = new Encounter($this->db);
		}
		return $this->encounter;
	}

	/**
	 * @return Offer
	 */
	public function offer() {
		if (null === $this->offer) {
			$this->offer = new Offer($this->db);
		}
		return $this->offer;
	}
}