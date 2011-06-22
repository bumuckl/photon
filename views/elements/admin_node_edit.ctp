<div class="album upload">

	<?php
	$album_id = '';
	if (isset($album['Album']['id'])) {
		$album_id = $album['Album']['id'];
	}
	?>

	<h3><?php echo __d('photon', 'Pictures for this node:', true); ?></h3>
	<small><?php echo __d('photon', 'Every node has got its private gallery album. Everytime you upload an image in this tab, it will be appended to this album. To show the whole album in your node, paste the following code at the location of your choice (of course this works in other nodes as well):', true); ?><br/>
	[Gallery:<?php echo $album['Album']['slug'];?>]<br/>
	[Popeye:<?php echo $album['Album']['slug'];?>]<br/>
	[Slider:<?php echo $album['Album']['slug'];?>]
	</small>
	
	<?php if(isset($album['Photo'])): ?>
	<p><table cellpadding="0" cellspacing="0" id="return">
	<tr>
			<th><?php __('Picture');?></th>
			<th><?php __('Title, Description & URL');?></th>
			<th><?php __('Embedding');?></th>
			<th></th>
	</tr>
	<?php foreach($album['Photo'] as $photo): ?>
		<tr>
			<td><?php echo $this->Html->image('photos/'.$photo['small']); ?></td>
			<td>
			<input type="text" name="title<?php echo $photo['id']; ?>" value="<?php echo $photo['title']; ?>" /><br/>
			<input type="text" name="desc<?php echo $photo['id']; ?>" value="<?php echo $photo['description']; ?>" /><br/>
			<?php __d('photon','URL: '); ?><a href="/img/photos/<?php echo $photo['large']; ?>">/img/photos/<?php echo $photo['large']; ?></a>
			</td>
			<td>Insert [Image:<?php echo $photo['id']; ?>] into your node.</td>
			<td><a href="javascript:;" class="remove" rel="<?php echo $photo['id']; ?>"><?php __d('photon','Remove'); ?></a></td>
		</tr>
	<?php endforeach; ?>
	</table></p>
	<?php endif; ?>
	
	<!--This container will be filled with data received from the Uploader-->
	<p><div id="upload">

	</div></p>
	
</div>

<?php echo $this->Html->script('/photon/js/fileuploader', false);  echo $this->Html->css('/photon/css/fileuploader', false); ?>

<script>

function createUploader(){     
       
    var uploader = new qq.FileUploader({
        element: document.getElementById('upload'),
        action: '<?php echo $this->Html->url(array('plugin' => 'photon', 'controller' => 'albums', 'action' => 'upload_photo', $album_id)); ?>',
		onComplete: function(id, fileName, responseJSON){
			$('.qq-upload-fail').fadeOut(function(){
				$(this).remove();
			});
			$('#return').append('<tr>' +
				'<td><img src="<?php echo $this->Html->url('/img/photos/'); ?>'+responseJSON.Photo.small+'" /></td>' +
				'<td>' +
				'<input type="text" name="title'+responseJSON.Photo.id+'" value="" /><br/>' +
				'<input type="text" name="desc'+responseJSON.Photo.id+'" value="" /><br/>' +
				'<?php __d('photon','URL: '); ?><a href="/img/photos/'+responseJSON.Photo.small+'">/img/photos/'+responseJSON.Photo.small+'</a>' + 
				'</td>' +
				'<td>Insert [Image:'+responseJSON.Photo.id+'] into your node.</td>' +
				'<td><a href="javascript:;" class="remove" rel="'+responseJSON.Photo.id+'"><?php __d('photon','Remove'); ?></a></td>' +
			'</tr>');
		},
		
	        template: '<div class="qq-uploader">' + 
	                '<div class="qq-upload-drop-area"><span><?php __d('photon','Drop files here to upload'); ?></span></div>' +
					'<a class="qq-upload-button ui-corner-all" style="background-color:#EEEEEE;float:left;font-weight:bold;margin-right:10px;padding:10px;text-decoration:none;cursor:pointer;"><?php __d('photon','Add new photos'); ?></a>' +
					'<ul class="qq-upload-list"></ul>' + 
	             '</div>',
		      
			fileTemplate: '<li>' +
		                '<span class="qq-upload-file"></span>' +
		                '<span class="qq-upload-spinner"></span>' +
		                '<span class="qq-upload-size"></span>' +
		                '<a class="qq-upload-cancel" href="#"><?php __d('photon','cancel'); ?></a>' +
		            '</li>',

    });
    
    $('input[name^=title]').live('change', function() {
    	
    	var id = parseInt($(this).attr("name").replace("title", ""));
    	var title = $(this).val();
    	var description = $('input[name=desc'+id+']').val();
    	$.ajax({
  			url: '<?php echo $this->Html->url(array('plugin' => 'photon', 'controller' => 'photos', 'action' => 'updateTitleAndDescription')); ?>/'+id+'/'+title+'/'+description,
  			success: function( data ){
    			$(this).val(data.title);
    			$('input[name=desc'+id+']').val(data.description);
  			}
		});
    	
    });
    
    $('input[name^=desc]').live('change', function() {
    	
    	var id = parseInt($(this).attr("name").replace("desc", ""));
    	var description = $(this).val();
    	var title = $('input[name=title'+id+']').val();
    	$.ajax({
  			url: '<?php echo $this->Html->url(array('plugin' => 'photon', 'controller' => 'photos', 'action' => 'updateTitleAndDescription')); ?>/'+id+'/'+title+'/'+description,
  			success: function( data ){
    			$(this).val(data.description);
    			$('input[name=title'+id+']').val(data.title);
  			}
		});
    	
    });
            
}

// in your app create uploader as soon as the DOM is ready
// don't wait for the window to load  
$(function(){

	createUploader();
	$('.remove').live('click', function(){
		var obj = $(this);
		$.getJSON('<?php echo $this->Html->url('/admin/photon/albums/delete_photo/');?>'+obj.attr('rel'), function(r) {
            if (r['status'] == 1) {
				obj.parent().parent().fadeOut(function(){
					$(this).remove();
				});
            } else {
                alert(r['msg']);	
            }
		});
	});
	
});

</script>