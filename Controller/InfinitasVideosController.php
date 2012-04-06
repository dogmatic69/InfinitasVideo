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
			
			$filterOptions = $this->Filter->filterOptions;
			$filterOptions['fields'] = array(
				'name'
			);

			$this->set(compact('infinitasVideos', 'filterOptions'));
		}
	}
