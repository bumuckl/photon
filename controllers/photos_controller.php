<?php
/**
 * Photos Controller
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
class PhotosController extends PhotonAppController {

	var $name = 'Photos';

	/*
	 * @description View a single photo
	 * @param int id
	 * @sets array photo, title_for_layout
	 */
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('photon','Invalid photo. Please try again.', true));
			$this->redirect(array('controller' => 'albums', 'action' => 'index'));
		}

		$photo = $this->Photo->find('first', array('conditions' => array('Photo.id' => $id)) );
		
		if (isset($this->params['requested'])) {
			return $photo;
		}

		if (!count($photo)) {
			$this->Session->setFlash(__d('photon','Invalid photo. Please try again.', true));
			$this->redirect(array('controller' => 'albums', 'action' => 'index'));
		}

		$this->set('title_for_layout',__d('photon',"Photo", true) . $photo['Photo']['title']);
		$this->set(compact('photo'));
	}
	
	/*
	 * @description Update title and description of a photo, AJAX powered!
	 * @param int id, string title, string description
	 * @sets JSON
	 */
	public function admin_updateTitleAndDescription($id = null, $title = null, $description = null) {
		
		set_time_limit ( 360 ) ;

		$this->layout = 'ajax';
		$this->render(false);
		Configure::write('debug', 0);

		$this->Photo->id = $id;
		$this->Photo->saveField('title', $title);
		$this->Photo->saveField('description', $description);
		
		//Clearing the cache
		$db = ConnectionManager::getDataSource('default');
		@unlink(TMP . 'cache' . DS . 'models/cake_model_default_' . $db->config["database"] . '_list');
		@unlink(TMP . 'cache' . DS . 'models/cake_model_default_photos');
		@unlink(TMP . 'cache' . DS . 'models/cake_model_default_albums');
		$db->sources(true);
		
		$result = $this->Photo->findById($id);

		echo json_encode($result);
	}

}
?>