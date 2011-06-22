<?php 
if(!isset($album)) {
		$album = $this->requestAction(array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'view'), array('pass' => array('slug' => $slug)));
	} 
	
if(!empty($album)): ?>

	<?php if(isset($album['Photo']) && count($album['Photo'])): ?>
		<div id="slider" class="slider<?php echo $slider_id; ?>">
			<ul>
				<?php foreach($album['Photo'] as $photo): ?>
				<li><a href="<?php echo $this->Html->url('/img/photos/'. $photo['large']); ?>" title="<?php echo $photo['title']; ?>" class="slider"><img src="<?php echo $this->Html->url('/img/photos/'. $photo['large']); ?>" alt="<?php echo $photo['title']; ?>"></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php else: ?>
		<?php  __d('photon','No photos in the album'); ?>
	<?php endif;?>
	
<?php else: ?>[Slider:<?php echo $slug; ?>]<?php endif; ?>