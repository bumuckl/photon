<?php
/**
 * Routes
 */
	Croogo::hookRoutes('Photon');
/**
 * Behavior
 */
   	Croogo::hookBehavior('Node', 'Photon.RelatedAlbum', array(
	'relationship' => array(
		'hasOne' => array(
			'Album' => array(
				'className' => 'Photon.Album',
				'foreignKey' => 'node_id',
				),
			),
		),
	));
/**
 * Component
 */
	Croogo::hookComponent('Nodes', 'Photon.NodeAlbum');
/**
 * Helper
 */
    Croogo::hookHelper('Nodes', 'Photon.Gallery');
/**
 * Admin menu (navigation)
 *
 * This plugin's admin_menu element will be rendered in admin panel under Extensions menu.
 */
    Croogo::hookAdminMenu('Photon');
/**
 * Admin tab
 */
 	Croogo::hookAdminTab('Nodes/admin_add', 'Images', 'photon.admin_node_add');
	Croogo::hookAdminTab('Nodes/admin_edit', 'Images', 'photon.admin_node_edit');
?>