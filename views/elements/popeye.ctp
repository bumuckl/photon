<?php 
if(!isset($album)) {
		$album = $this->requestAction(array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'view'), array('pass' => array('slug' => $slug)));
	} 
	
if(!empty($album)): ?>

	<?php if(isset($album['Photo']) && count($album['Photo'])): ?>
<div id="popeye" class="popeye<?php echo $popeye_id; ?>">
<ul class="ppy-imglist">
<?php foreach($album['Photo'] as $photo): ?>
<li><a href="<?php echo $this->Html->url('/img/photos/'. $photo['large']); ?>" class="thumb" title="<?php echo $photo['title']; ?>"><img src="<?php echo $this->Html->url('/img/photos/'. $photo['small']); ?>" alt="<?php echo $photo['description']; ?>"></a></li>
<?php endforeach; ?>
</ul>
<div class="ppy-outer">
    	<div class="ppy-stage">
            <div class="ppy-nav">
                <a class="ppy-prev" title="Previous image">Previous image</a>
                <a class="ppy-switch-enlarge" title="Enlarge">Enlarge</a>
                <a class="ppy-switch-compact" title="Close">Close</a>
                <a class="ppy-next" title="Next image">Next image</a>
            </div>
        </div>
    </div>
    <div class="ppy-caption">
        <div class="ppy-counter">
            Image <strong class="ppy-current"></strong> of <strong class="ppy-total"></strong> 
        </div>
        <span class="ppy-text"></span>
    </div>
</div>
	<?php else: ?>
		<?php  __d('photon','No photos in the album'); ?>
	<?php endif;?>
	
<?php else: ?>[Popeye:<?php echo $slug; ?>]<?php endif; ?>