<?php
	/**
	 * InfinitasVideos Controller
	 *
	 * @property InfinitasVideo $InfinitasVideo
	 */
	class InfinitasVideosController extends VideosAppController {
		/**
		 * index method
		 *
		 * @return void
		 */
		public function index() {
			$this->set('infinitasVideos', $this->paginate());
		}

		/**
		* view method
		*
		* @param string $id
		* @return void
		*/
		public function view($id = null) {
			$this->InfinitasVideo->id = $id;
			if (!$this->InfinitasVideo->exists()) {
				throw new NotFoundException(__('Invalid infinitas video'));
			}
			$this->set('infinitasVideo', $this->InfinitasVideo->read(null, $id));
		}
		
		/**
		 * admin_index method
		 *
		 * @return void
		 */
		public function admin_index() {
			$infinitasVideos = $this->Paginator->paginate();
			
			foreach($infinitasVideos as &$infinitasVideo) {
				if(empty($infinitasVideo[$this->modelClass]['foreign_key'])) {
					$infinitasVideo[$this->modelClass]['content_title'] = null;
					continue;
				}
				
				$infinitasVideo[$this->modelClass]['content_title'] = ClassRegistry::init('Contents.GlobalContent')->find(
					'list',
					array(
						'fields' => array(
							'GlobalContent.foreign_key',
							'GlobalContent.title'
						),
						'conditions' => array(
							'GlobalContent.foreign_key' => $infinitasVideo[$this->modelClass]['foreign_key']
						),
						'limit' => 1
					)
				);
				
				$infinitasVideo[$this->modelClass]['content_title'] = current($infinitasVideo[$this->modelClass]['content_title']);
			}
			
			$filterOptions = $this->Filter->filterOptions;
			$filterOptions['fields'] = array(
				'name'
			);

			$this->set(compact('infinitasVideos', 'filterOptions'));
		}
		
		public function admin_add() {
			parent::admin_add();
			
			$this->set('plugins', $this->{$this->modelClass}->getPlugins());
		}
		
		public function admin_edit($id = null) {
			if(!empty($this->request->data)) {
				$this->request->data[$this->modelClass]['model'] = sprintf(
					'%s.%s',
					$this->request->data[$this->modelClass]['plugin'],
					$this->request->data[$this->modelClass]['model']
				);
			}
			parent::admin_edit($id);

			$plugins = $this->{$this->modelClass}->getPlugins();
			if(!empty($this->request->data[$this->modelClass]['model'])) {
				list(
					$this->request->data[$this->modelClass]['plugin'], 
					$this->request->data[$this->modelClass]['model']
				) = pluginSplit($this->request->data[$this->modelClass]['model']);

				$models = $this->{$this->modelClass}->getModels($this->request->data[$this->modelClass]['plugin']);
				$records = $this->{$this->modelClass}->getRecords(
					$this->request->data[$this->modelClass]['plugin'], 
					$this->request->data[$this->modelClass]['model']
				);
			}
			$this->set(compact('plugins', 'models', 'records'));
		}
	}
