<h2><?php __d('photon', 'Album');?>: <?php echo $album['Album']['title']; ?></h2>
<p><?php echo $album['Album']['description']; ?></p>
<?php echo $this->element('gallery'); ?>
<h3><?php __d('photon', 'View another album'); ?></h3>
<?php echo $this->element('more_albums'); ?>