<?php
App::uses('InfinitasVideosController', 'Videos.Controller');

/**
 * TestInfinitasVideosController *
 */
class TestInfinitasVideosController extends InfinitasVideosController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * InfinitasVideosController Test Case
 *
 */
class InfinitasVideosControllerTestCase extends CakeTestCase {
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
		$this->InfinitasVideos = new TestInfinitasVideosController();
		$this->InfinitasVideos->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InfinitasVideos);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

	}
/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}
/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}
/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}
/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}
/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {

	}
/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {

	}
/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {

	}
/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {

	}
/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {

	}
}
