<?php

class RelatedAlbumBehavior extends ModelBehavior {
	
	public $settings = array();

	public function setup(&$Model, $settings = array()) {
		if(!isset($this->settings[$Model->alias])) {
			if(!isset($this->settings[$Model->alias])) {
				$this->settings[$Model->alias] = array(
					
				);
			}
			$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], $settings);
		}
		
	}
	
	function beforeFind(&$model, $query) {
		if (!empty($this->settings[$model->alias]['relationship'])) {
			$model->bindModel($this->settings[$model->alias]['relationship'], false);
		}
		
		return $query;
	}

	public function beforeSave(&$Model) {
	
		//The album creation logic should go in here, but this will come in further stable releases ;)
		 
		return true;
	}

}
