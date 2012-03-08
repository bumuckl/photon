<?php

class PhotonActivation {

    public function beforeActivation(&$controller) {
    	//Create database tables
       		$sql = file_get_contents(APP.'plugins'.DS.'photon'.DS.'config'.DS.'photon.sql');
	        if(!empty($sql)){
	        	App::import('Core', 'File');
	        	App::import('Model', 'ConnectionManager');
	        	$db = ConnectionManager::getDataSource('default');

	        	$statements = explode(';', $sql);

		        foreach ($statements as $statement) {
		            if (trim($statement) != '') {
		                $db->query($statement);
		            }
		        }
	        }
		return true;
    }


    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
		$controller->Croogo->addAco('Albums');
        $controller->Croogo->addAco('Albums/index', array('registered', 'public')); 
        $controller->Croogo->addAco('Albums/view', array('registered', 'public'));
        $controller->Croogo->addAco('Albums/admin_index', array('admin'));
		$controller->Croogo->addAco('Albums/admin_add', array('admin'));
		$controller->Croogo->addAco('Albums/admin_edit', array('admin'));
		$controller->Croogo->addAco('Albums/admin_delete', array('admin'));
		$controller->Croogo->addAco('Albums/admin_upload', array('admin'));
		$controller->Croogo->addAco('Albums/admin_upload_photo', array('admin'));
		$controller->Croogo->addAco('Albums/admin_delete_photo', array('admin'));
		$controller->Croogo->addAco('Photos');
		$controller->Croogo->addAco('Photos/admin_index', array('admin'));
		$controller->Croogo->addAco('Photos/view', array('registered','public'));
		$controller->Croogo->addAco('Photos/admin_updateTitleAndDescription', array('admin'));
		
		//Set initial settings
		$controller->Setting->write('Photon.album_limit_pagination', '10', array('editable' => 1, 'title' => 'Albums Per Page'));
		$controller->Setting->write('Photon.max_width', '500', array('editable' => 1));
    	$controller->Setting->write('Photon.max_width_thumb', '120', array('editable' => 1));
    	$controller->Setting->write('Photon.max_height_thumb', '80', array('editable' => 1));
    	$controller->Setting->write('Photon.quality', '90', array('editable' => '1'));
    }


    public function beforeDeactivation(&$controller) {
    	//We better not drop the tables, since one probabl ymight activate the plugin accidentally ;)
        return true;
    }


    public function onDeactivation(&$controller) {
        $controller->Croogo->removeAco('Albums'); // ExampleController ACO and it's actions will be removed
        $controller->Croogo->removeAco('Photos');

		$controller->Setting->deleteKey('Photon.album_limit_pagination');
		$controller->Setting->deleteKey('Photon.max_width');
    	$controller->Setting->deleteKey('Photon.max_width_thumb');
    	$controller->Setting->deleteKey('Photon.max_height_thumb');
    	$controller->Setting->deleteKey('Photon.quality');
    }
}
?>