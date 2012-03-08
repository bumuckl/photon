<a href="#"><?php __d('photon','Photon Gallery'); ?></a>
<ul>
   <li><?php echo $html->link(__d('photon','List albums', true), array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'index')); ?></li>
   <li><?php echo $html->link(__d('photon','New album', true), array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'add')); ?></li>
   <li><?php echo $html->link(__d('photon','List photos', true), array('plugin' => 'photon', 'controller' => 'photos', 'action' => 'index')); ?></li>
   <li><?php echo $html->link(__d('photon','Gallery settings', true), array('plugin' => '', 'controller' => 'settings', 'action' => 'prefix', 'Photon')); ?></li>
</ul>
