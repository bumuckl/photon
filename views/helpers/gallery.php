<?php
/**
 * Photon Gallery Helper
 *
 * PHP version 5
 *
 * @category Helper
 * @package  Croogo
 * @version  1.3
 * @author   bumuckl <bumuckl@gmail.com> and Edinei L. Cipriani <phpedinei@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.bumuckl.com
 */
class GalleryHelper extends AppHelper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */

	var $helpers = array(
		'Layout',
		'Html'
	);
	
	var $gallery_id = 0;
	var $popeye_id = 0;
	var $slider_id = 0;

/**
 * Called before LayoutHelper::setNode()
 *
 * @return void
 */
	public function beforeRender() {
		if(ClassRegistry::getObject('view')){
			//load all CSS files
			echo $this->Html->css('/photon/css/jquery.lightbox-0.5');
			echo $this->Html->css('/photon/css/gallery');
			echo $this->Html->css('/photon/css/jquery.popeye');
			echo $this->Html->css('/photon/css/jquery.popeye.style');
			
			//load all js libraries & scripts
			//echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js', array('inline' => false));
			echo $this->Html->script('/photon/js/jquery.lightbox-0.5.min', array('inline' => false));
			echo $this->Html->script('/photon/js/jquery.popeye-2.0.4.min', array('inline' => false));
			echo $this->Html->script('/photon/js/easySlider1.5', array('inline' => false));
			echo $this->Html->script('/photon/js/gallery', array('inline' => false));
		}
	}

/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
	public function afterSetNode() {
		$this->Layout->setNodeField('body', preg_replace_callback('/\[Gallery:.*\]/',array(&$this,'replaceForGallery'), $this->Layout->node('body')));
		$this->Layout->setNodeField('body', preg_replace_callback('/\[Popeye:.*\]/',array(&$this,'replaceForPopeye'), $this->Layout->node('body')));
		$this->Layout->setNodeField('body', preg_replace_callback('/\[Slider:.*\]/',array(&$this,'replaceForSlider'), $this->Layout->node('body')));
		$this->Layout->setNodeField('body', preg_replace_callback('/\[Image:.*\]/',array(&$this,'replaceForImage'), $this->Layout->node('body')));
	}

	public function replaceForGallery($subject){
		preg_match('/\[Gallery:(.*)\]/', $subject[0], $matches);
		return $this->Layout->View->element('gallery', array('plugin' => 'photon', 'slug' => $matches[1], 'gallery_id' => $this->gallery_id++));
	}
	
	public function replaceForPopeye($subject){
		preg_match('/\[Popeye:(.*)\]/', $subject[0], $matches);
		return  $this->Layout->View->element('popeye', array('plugin' => 'photon', 'slug' => $matches[1], 'popeye_id' => $this->popeye_id++));
	}
	
	public function replaceForSlider($subject){
		preg_match('/\[Slider:(.*)\]/', $subject[0], $matches);
		return  $this->Layout->View->element('slider', array('plugin' => 'photon', 'slug' => $matches[1], 'slider_id' => $this->slider_id++));
	}
	
	public function replaceForImage($subject){
		preg_match('/\[Image:(.*)\]/', $subject[0], $matches);
		return $this->Layout->View->element('image', array('plugin' => 'photon', 'id' => $matches[1] ));
	}

}

?>