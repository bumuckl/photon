<?php 
if(!isset($gallery_id)) {
	$gallery_id = 0;
}
if(!isset($album)) {
		$album = $this->requestAction(array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'view'), array('pass' => array('slug' => $slug)));
	} 
	
if(!empty($album)): ?>

	<?php if(isset($album['Photo']) && count($album['Photo'])): ?>
	<div id="gallery" class="gallery<?php echo $gallery_id; ?>">
	<ul>
	<?php foreach($album['Photo'] as $photo): ?>
	<li><a href="<?php echo $this->Html->url('/img/photos/'. $photo['large']); ?>" class="thumb" title="<?php echo $photo['title'] ?>"><img src="<?php echo $this->Html->url('/img/photos/'. $photo['small']); ?>" alt="<?php echo $photo['title'] ?>"></a></li>
	<?php endforeach; ?>
	</ul>
	<a href="<?php echo $this->Html->url('/img/photos/'. $album['Photo'][0]['large']); ?>" class="big" title="<?php echo $photo['title'] ?>"><img src="<?php echo $this->Html->url('/img/photos/'. $album['Photo'][0]['large']); ?>" alt="<?php echo $photo['title'] ?>"></a>
	</div>
	<?php else: ?>
		<?php  __d('photon','No photos in the album'); ?>
	<?php endif;?>
	
<?php else: ?>[Gallery:<?php echo $slug; ?>]<?php endif; ?>