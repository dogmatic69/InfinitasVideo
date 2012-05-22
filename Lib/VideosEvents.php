<?php
	class VideosEvents extends AppEvents {
		public function onPluginRollCall() {
			return array(
				'name' => 'Videos',
				'description' => 'Link to external video sites',
				'icon' => '/videos/img/icon.png',
				'author' => 'Infinitas',
				'dashboard' => array('plugin' => 'videos', 'controller' => 'infinitas_videos', 'action' => 'index'),
			);
		}
		
		public function onRequireComponentsToLoad($event = null) {
			return array(
				'Videos.InfinitasVideoLoader'
			);
		}
	}