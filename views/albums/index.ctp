<?php
	$counter = 0; //We need a counter in order to set up popeye properly
?>
<header>
    <hgroup>
        <h1>»<?php __d('photon','Albums');?>«</h1>
        <h3>...proudly presenting my gallery!</h3>
    </hgroup>
</header>
	
	<?php if(count($albums) == 0): 
		echo '<article><p class="notification">';
        __d('photon','No albums found.');
		echo '</p></article>';
	else: ?>
		<div class="albums">
		<?php foreach($albums as $album): ?>
				<?php //if (!empty($album['Photo'][0]['small'])) : ?>
				<article class="clearfix">
					<header>
						<div class="thumb">
							<?php echo $this->element('popeye', array("slug" => $album['Album']['slug'], "album" => $album, "popeye_id" => $counter)); $counter++; ?>
						</div>
						<h2><?php echo $album['Album']['title']; ?></h2>
						<div class="description"><?php echo $album['Album']['description']; ?></div>
					</header>
					<p><?php echo $this->Html->link(__d('photon','view album', true), array('plugin' => 'gallery', 'controller' => 'album', 'action' => $album['Album']['slug']), array('class' => 'button')); ?></p>
				</article>
				<?php //endif; ?>
		<?php endforeach; ?>
		</div> 
	<?php endif; ?>	
	
<footer>
	<nav id="pagination"><?php echo $paginator->numbers(); ?></nav>
</footer>
              