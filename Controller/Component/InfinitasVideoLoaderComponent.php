<?php
	class InfinitasVideoLoaderComponent extends InfinitasComponent {
		public function beforeRender(Controller $Controller) {
			parent::beforeRender($Controller);
			
			if(empty($Controller->request->params['slug'])) {
				return;
			}
			
			$video = ClassRegistry::init('Videos.InfinitasVideo')->relatedVideo(
				array(
					'plugin' => $Controller->request->plugin,
					'model' => $Controller->modelClass,
					'slug' => !empty($Controller->request->params['slug']) ? $Controller->request->params['slug'] : null,
					'id' => !empty($Controller->request->params['named'][0]) ? $Controller->request->params['named'][0] : null
				)
			);
			
			$Controller->set('autoLoadVideo', $video);
		}
	}