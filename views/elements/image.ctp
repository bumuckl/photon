<?php 
if(!isset($photo)) {
		$photo = $this->requestAction(array('plugin' => 'photon', 'controller' => 'photos', 'action' => 'view'), array('pass' => array('id' => $id)));
	} 
	
if(!empty($photo)): ?>

	<?php if(isset($photo['Photo']) && count($photo['Photo'])): ?>
	<a href="<?php echo $this->Html->url('/img/photos/'. $photo['Photo']['large']); ?>" class="single_thumb" title="<?php echo $photo['Photo']['title']; ?>"><img src="<?php echo $this->Html->url('/img/photos/'. $photo['Photo']['small']); ?>" alt="<?php echo $photo['Photo']['title']; ?>"></a>
	<?php else: ?>
		<?php  __d('photon','No photo found'); ?>
	<?php endif;?>
	
<?php else: ?>[Image:<?php echo $id; ?>]<?php endif; ?>