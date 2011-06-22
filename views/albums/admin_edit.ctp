<div class="users form">
    
    <h2><?php __d('photon','Edit album'); ?></h2>
    
    <div class="actions">
		<ul>
			<li><?php echo $html->link(__('Back', true), array('action'=>'index')); ?></li>
		</ul>
	</div>
    
    <?php echo $form->create('Album');?>
	<fieldset>
    <div class="tabs">
			<ul>
				<li><a href="#album-basic"><span><?php __('Settings'); ?></span></a></li>
				<li><a href="#album-images"><span><?php __('Images'); ?></span></a></li>
				<?php echo $layout->adminTabs(); ?>
			</ul>
			
			<div id="album-basic">
		        <?php
					echo $form->input('id');
		            echo $form->input('title',array('label' => __('Title', true)));
		            echo $form->input('slug');
					echo $form->input('description',array('label' => __('Description', true)));
					echo $form->input('status');
		        ?>
		    </div>
		    
		    <div id="album-images">
		    	<?php echo $this->element('admin_node_edit', array('album' => $album) ); ?>
		    </div>
			<?php echo $layout->adminTabs(); ?>
	</div>
	</fieldset>
	<?php echo $form->end('Submit');?>
	
</div>