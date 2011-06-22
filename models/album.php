<?php
/**
 * Album
 *
 * PHP version 5
 *
 * @category Model
 * @package  Croogo
 * @version  1.3
 * @author   bumuckl <bumuckl@gmail.com> and Edinei L. Cipriani <phpedinei@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.bumuckl.com
 */
class Album extends AppModel {

	var $name = 'Album';

	var $validate = array(
		'slug' => array(
			'rule' => 'isUnique',
			'message' => 'Slug is already in use.',
		),
	);

	var $hasMany = array(
			'Photo' => array(
				'className' => 'Photon.photo',
				'foreignKey' => 'album_id',
				'dependent' => true,
				'conditions' => '',
				'fields' => '',
				'order' => 'Photo.title ASC',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),

	);
	
	var $belongsTo = array(
        'Node' => array(
            'className'    => 'Node',
            'foreignKey'    => 'node_id'
        )
    );  

}
?>