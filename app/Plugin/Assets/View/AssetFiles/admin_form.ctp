<?php
	$field = (!empty($this->params->pass[0])) ? $this->params->pass[0]:'file';
	$domid = (!empty($this->params->pass[1])) ? $this->params->pass[1]:'file';
	
	$imagePath = (isset($data) && $data['AssetFile']['is_image']) ? AssetFile::url($data['AssetFile']['id'], 'admin_100x100'):'http://placehold.it/60x60';
	
	echo $this->Html->script('/Assets/js/form.js');
?>

<style>
	form {
		margin: 0px;
	}
</style>

<div id="loading" style="display: none; position: absolute; background-color: black; left: 0px; right: 0px; bottom: 0px; top: 0px; z-index: 100; opacity:.7;moz-border-radius: 4px; border-radius: 4px;">
	<h3 style="text-align: center; margin: 20px; color: white;">Uploading please wait...</h3>
</div>

<div class="add" style="height: 70px; display: <?php echo (isset($data))? 'none':'block'; ?>;">
	<?php	
		echo $this->Form->create('AssetFile', array('url' => array($field, $domid), 'enctype' => 'multipart/form-data'));
		echo $this->Form->input('file', array('type' => 'file', 'label' => 'Upload file'));
		echo $this->Form->end();
	?>
</div>

<div class="add-from-url" style="height: 70px; display: none; ?>;">
	<?php	
		echo $this->Form->create('AssetFile', array('url' => array($field, $domid), 'enctype' => 'multipart/form-data'));
		echo $this->Form->input('file_download', array('type' => 'text', 'label' => 'Download from url'));
		echo $this->Form->end();
	?>
</div>

<div style="position: absolute;top: 0px;right: 0px;">
	<div class="btn switch">switch</div>
</div>

<div class="edit" style="height: 70px; display: <?php echo (isset($data))? 'block':'none'; ?>;">
	<label>File</label>
	<input name="data[Chosen file]" class="" help="" disabled="disabled" id="file" type="text">
	<div class="btn" style="position: relative; top: -3px;">Clear <div class="icon-remove-sign"></div></div>
	<a href="#" class="thumbnail" style="position: absolute; right: 0px; top: 0px;">
		<?php echo $this->Html->image($imagePath, array('class' => 'image_preview', 'style' => 'width: 60px; height: 60px;')); ?>
    </a>
</div>

<?php if(isset($data)){
	?>
		<script type="text/javascript">
			var id = '#<?php echo $domid ?>';
			var id_file_path = '#<?php echo $domid ?>FilePath';
			var id_file_path_value = "<?php echo DS.$data['AssetFile']['folder'].DS.$data['AssetFile']['name']; ?>";
			var value = '<?php echo $data["AssetFile"]["id"] ?>';
			var name = '<?php echo $data["AssetFile"]["name"] ?>';
		
			$(document).on('ready', function(){
				parent.$(id).val(value);
				parent.$(id_file_path).val(id_file_path_value);
				parent.$(parent.document).trigger('uploadComplete');
				
				$('input#file').val(name);
				
				$('.btn').on('click', function(){
					$('.edit').hide();
					$('.add').show();
				});	
				
				$('.image_preview').click(function(evt){
					parent.$(parent.document).trigger('showImagePreview', [$('.image_preview').attr('src')]);
					evt.preventDefault();
				});
			});
		</script>
	<?php
} ?>

<script type="text/javascript">
	$(document).on('ready', function(){
		$('input[type=file]').on('change', function(){
			$('#loading').show();
			$('form').submit();
		});
		
		$('.switch').on('click',function(){
			if($('.add-from-url').css('display') == 'none') {
				$('.add').css('display', 'none');
				$('.add-from-url').css('display', 'block');
			} else {
				$('.add-from-url').css('display', 'none');
				$('.add').css('display', 'block');
			}
		});

	});
</script>