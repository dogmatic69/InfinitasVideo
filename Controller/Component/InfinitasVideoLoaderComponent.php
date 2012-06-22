<?php
	class InfinitasVideoLoaderComponent extends InfinitasComponent {
		public function beforeRender(Controller $Controller) {
			parent::beforeRender($Controller);

			$slug = !empty($Controller->request->slug) ? $Controller->request->slug : null;
			if(!$slug && !empty($Controller->request->params['slug'])) {
				$slug = $Controller->request->params['slug'];
			}

			if(empty($slug)) {
				return;
			}

			$video = ClassRegistry::init('Videos.InfinitasVideo')->relatedVideo(
				array(
					'plugin' => $Controller->request->plugin,
					'model' => $Controller->modelClass,
					'slug' => $slug,
					'id' => !empty($Controller->request->params['named'][0]) ? $Controller->request->params['named'][0] : null
				)
			);

			$Controller->set('autoLoadVideo', $video);
		}
	}