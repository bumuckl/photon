<h2><?php __d('photon', 'Album');?>: <?php echo $album['Album']['title']; ?></h2>
<p><?php echo $album['Album']['description']; ?></p>
<?php echo $this->element('gallery'); ?>
<ul>
	<li><?php echo $html->link(__d('photon','Back', true), '/gallery'); ?></li>
</ul>