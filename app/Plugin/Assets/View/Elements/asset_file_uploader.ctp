<?php
echo $this->Form->input($settings['field'], array('type' => 'hidden'));
echo $this->Form->input($settings['field'].'_file_path', array('type' => 'hidden'));
$id = (isset($this->data) && isset($this->data[$this->Form->model()])) ? $this->data[$this->Form->model()][$settings['field']]:'';
?>
<div class="clearfix">
	<?php if(!isset($settings['label']) || (isset($settings['label']) && $settings['label'] !== false)) { ?>
		<label><?php echo isset($settings['label']) ? $settings['label']:Inflector::humanize($settings['field']); ?></label>
	<?php }//ENDIF ?>
	
	<div class="well" style="height: 70px;">
		<iframe 
			border="0" 
			style="width: 400px; height: 70px;" 
			frameborder="no" 
			src="<?php echo $this->Html->url(array(
													'plugin' => 'assets', 
													'controller' => 
													'asset_files', 
													'action' => 'add', 
													$this->Form->model().".".$settings['field'],
													$this->Form->domId($settings['field']), $id)) ?>"
													>
		</iframe>
	</div>
	
	<script type="text/javascript">
		if(assetFileScripRun == undefined) {
			$(document).on('ready', function(){
				$(document).on('showImagePreview', function(evt, arg){
					
					$('body').append(
					'<div class="modal hide fade" id="preview_model" style="width: auto;">'+
					  '<div class="modal-header">'+
					    '<a class="close" data-dismiss="modal">×</a>'+
					    '<h3>Modal header</h3>'+
					  '</div>'+
					  '<div class="modal-body">'+
						'<img src="" style="max-height: 400px;">'+
					  '</div>'+
					'</div>');
					
					$('#preview_model .modal-body img').attr('src', arg);
					$('#preview_model').modal('show');
				});
			});
		}
		var assetFileScripRun = true;
	</script>
	

	
</div>