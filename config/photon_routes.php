<?php

CroogoRouter::connect('/gallery', array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'index'));
CroogoRouter::connect('/gallery/albums', array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'index'));
CroogoRouter::connect('/gallery/album/:slug', array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'view'), array('pass' => array('slug')));

?>