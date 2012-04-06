<?php
App::uses('InfinitasVideo', 'Videos.Model');

/**
 * InfinitasVideo Test Case
 *
 */
class InfinitasVideoTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.videos.infinitas_video');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InfinitasVideo = ClassRegistry::init('InfinitasVideo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InfinitasVideo);

		parent::tearDown();
	}

}
