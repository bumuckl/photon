<?php
/**
 * Albums Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.3
 * @author   bumuckl <bumuckl@gmail.com> and Edinei L. Cipriani <phpedinei@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.bumuckl.com
 */
class AlbumsController extends PhotonAppController {

	var $name = 'Albums';
	
	var $helpers = array(
		'Layout',
		'Html',
		'Photon.Gallery',
	);

	/*
	 * @description Index view for album administration
	 * @sets array albums
	 */
	function admin_index() {
		$this->set('title_for_layout', __d('photon','Albums', true));

		$this->Album->recursive = 0;
		$this->paginate = array(
				'limit' => Configure::read('Photon.album_limit_pagination'),
				'order' => 'Album.position ASC');
		$this->set('albums', $this->paginate());
	}

	/*
	 * @description Adding a new new album to the database
	 */
	function admin_add() {
		if (!empty($this->data)) {
			$this->Album->create();
			if(empty($this->data['Album']['slug'])){
				$this->data['Album']['slug'] = low(Inflector::slug($this->data['Album']['title'], '-'));
			}

			$this->Album->recursive = -1;
			$position = $this->Album->find('all',array(
				'fields' => 'MAX(Album.position) as position'
			));

			$this->data['Album']['position'] = $position[0][0]['position'] + 1;

			if ($this->Album->save($this->data)) {
				$this->Session->setFlash(__('Album is saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('photon','Album could not be saved. Please try again.', true));
			}
		}

	}

	/*
	 * @description Edit an existing album
	 * @param int id
	 * @sets array album
	 */
	function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid album.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Album->save($this->data)) {
				$this->Session->setFlash(__d('photon','Album is saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('photon','Album could not be saved. Please try again.', true));
			}
		}

	   	$this->data = $this->Album->read(null, $id);
	   	$album = $this->Album->find('first', array('conditions' => array('Album.id' => $id), 'contain' => 'Photo'));
		$this->set('album', $album);

	}

	/*
	 * @description Delete an existing album
	 * @param int id
	 */
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('photon','Invalid ID for album.', true));
			$this->redirect(array('action' => 'index'));
		} else {
			$ssluga = $this->Album->findById($id);
			$sslug = $ssluga['Album']['slug'];

			$dir  = WWW_ROOT . 'img' . DS . $sslug;
		}
		if ($this->Album->delete($id, true)) {
			$this->Session->setFlash(__d('photon','Album is deleted, and whole directory with images.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->render(false);
	}
	
	public function admin_moveup($id, $step = 1) {
        if( $this->Album->moveup($id, $step) ) {
            $this->Session->setFlash(__('Moved up successfully', true), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('Could not move up', true), 'default', array('class' => 'error'));
        }

        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_movedown($id, $step = 1) {
        if( $this->Album->movedown($id, $step) ) {
            $this->Session->setFlash(__('Moved down successfully', true), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('Could not move down', true), 'default', array('class' => 'error'));
        }

        $this->redirect(array('action' => 'index'));
    }

	/*
	 * @description Public index view, displaying all albums (accessible via yoururl.tld/gallery)
	 * @sets array albums
	 */
	public function index() {
		$this->set('title_for_layout',__d('photon',"Albums", true));
		
		//We're gonna use this in order to hack the pagination a bit
		$customCount = $this->Album->find('count', array(
			'conditions' => array('Album.status' => 1),
			'fields' => 'DISTINCT Album.id',
			'joins'  => array(
		    	array(
		        	'table' => 'photos',
		        	'alias' => 'Photos',
		        	'type' => 'inner',
		        	'conditions' => array('Album.id = Photos.album_id'),
		        )
		    ),
    	));

		$this->Album->recursive = -1;
		$this->Album->Behaviors->attach('Containable');
		$this->paginate = array(
				'conditions' => array('Album.status' => 1),
				'contain' => array('Photo'),
				'fields' => array('DISTINCT Album.id', 'Album.*'),
				'joins'  => array(
				    array(
				        'table' => 'photos',
				        'alias' => 'Photos',
				        'type' => 'inner',
				        'conditions' => array('Album.id = Photos.album_id'),
				        )
				    ),
				'limit' => Configure::read('Photon.album_limit_pagination'),
				'order' => 'Album.position ASC',
				'customCount' => $customCount, //This is kind of a hacky part
		);

		$this->set('albums', $this->paginate());
	}

	/*
	 * @description View a single album
	 * @param sstring slug
	 * @sets array album, title_for_layout
	 */
	public function view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__d('photon','Invalid album. Please try again.', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->Album->Behaviors->attach('Containable');
		$album = $this->Album->find('first', array('conditions' => array('Album.slug' => $slug), 'contain' => 'Photo'));

		if (isset($this->params['requested'])) {
			return $album;
		}

		if (!count($album)) {
			$this->Session->setFlash(__d('photon','Invalid album. Please try again.', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('title_for_layout',__d('photon',"Album", true) . $album['Album']['title']);
		$this->set(compact('album'));
	}

	/*
	 * @description Upload a photo, AJAX powered!
	 * @sets JSON
	 */
	public function admin_upload_photo($id = null) {
	
		set_time_limit ( 240 ) ;

		$this->layout = 'ajax';
		$this->render(false);
		Configure::write('debug', 0);

		$this->data['Photo']['album_id'] = $id;
		$this->Album->Photo->create();
		$this->data = $this->Album->Photo->upload($this->data);
		$this->Album->Photo->save($this->data);
		
		$result = $this->Album->Photo->findById($this->Album->Photo->id);

		echo json_encode($result);

	}

	/*
	 * @description delete a photo, AJAX powered!
	 * @sets JSON
	 */
	public function admin_delete_photo($id = null) {
		$this->layout = 'ajax';
		$this->autoRender = false;

		if (!$id) {
			echo json_encode(array('status' => 0, 'msg' => __d('photon','Invalid photo. Please try again.', true))); exit();
		}

		if ($this->Album->Photo->delete($id)) {
			echo json_encode(array('status' => 1)); exit();
		} else {
			echo json_encode(array('status' => 0,  'msg' => __d('photon','Problem to remove photo. Please try again.', true))); exit();
		}
	}
}
?>