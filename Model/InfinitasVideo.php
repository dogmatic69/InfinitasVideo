<?php
	/**
	 * InfinitasVideo Model
	 *
	 */
	class InfinitasVideo extends VideosAppModel {
		/**
		 * Display field
		 *
		 * @var string
		 */
		public $displayField = 'name';

		/**
		 * Validation rules
		 *
		 * @var array
		 */
		public $validate = array();

		public $actsAs = array(
			'Filemanager.Upload' => array(
				'preview' => array(
					'thumbnailSizes' => array(
						'jumbo' => '1600l',
						'large' => '1000l',
						'medium' => '600l',
						'small' => '300l',
						'thumb' => '50l'
					)
				)
			)
		);

		public $findMethods = array(
			'video' => true
		);

		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);

			$this->validate = array(
				'name' => array(
					'notempty' => array(
						'rule' => array('notempty'),
						'message' => __d('videos', 'Please enter a name for this video'),
					),
					'isUnique' => array(
						'rule' => array('isUnique'),
						'message' => __d('videos', 'There is already a video with this name'),
					),
				),
				'description' => array(
					'notempty' => array(
						'rule' => array('notempty'),
						'message' => __d('videos', 'Please enter the text to display'),
					),
				),
				'url' => array(
					'notempty' => array(
						'rule' => array('notempty'),
						'message' => __d('videos', 'Please enter a valid url'),
					),
				)
			);
		}

		protected function _findVideo($state, $query, $results = array()) {
			if ($state === 'before') {
				if(empty($query[0])) {
					throw new Exception('Missing video');
				}
				$fields = array($this->alias . '.*');
				$this->virtualFields['content_image_path_full'] = String::insert(
					'IF((:alias.preview = \'\' OR :alias.preview IS NULL), "/contents/img/no-image.png", CONCAT("/files/infinitas_video/preview/", :alias.dir, "/", :alias.preview))',
					array('alias' => $this->alias)
				);
				$fields[] = 'content_image_path_full';

				foreach($this->actsAs['Filemanager.Upload']['preview']['thumbnailSizes'] as $name => $size) {
					$this->virtualFields['content_image_path_' . $name] = String::insert(
						'IF((:alias.preview = "" OR :alias.preview IS NULL), "/contents/img/no-image.png", CONCAT("/files/infinitas_video/preview/", :alias.dir, "/", "' . $name . '_", :alias.preview))',
						array('alias' => $this->alias)
					);
					$fields[] = 'content_image_path_' . $name;
				}

				$query['conditions'] = array(
					$this->alias . '.slug' => $query[0]
				);

				$query['fields'] = $fields;
				$query['limit'] = 1;

				unset($query[0]);
				return $query;
			}

			return (array)current($results);
		}

		public function relatedVideo($slug) {
			$slug = array_merge(
				array('plugin' => null, 'model' => null, 'slug' => null, 'id' => null),
				(array)$slug
			);
			$id = ClassRegistry::init('Contents.GlobalContent')->find(
				'list',
				array(
					'fields' => array(
						'GlobalContent.foreign_key',
						'GlobalContent.foreign_key'
					),
					'conditions' => array(
						'GlobalContent.model' => sprintf('%s.%s', $slug['plugin'], $slug['model']),
						'or' => array(
							'GlobalContent.slug' => $slug['slug'],
							'GlobalContent.foreign_key' => $slug['id'],
						)
					)
				)
			);

			if(empty($id)) {
				return array();
			}

			$video = $this->find(
				'list',
				array(
					'fields' => array(
						$this->alias . '.' . $this->primaryKey,
						$this->alias . '.slug',
					),
					'conditions' => array(
						$this->alias . '.model' => sprintf('%s.%s', $slug['plugin'], $slug['model']),
						$this->alias . '.foreign_key' => current($id)
					)
				)
			);

			return current($video);
		}
	}
