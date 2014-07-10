<?php
	$this->Html->script('Assets.form.upload', ['block' => 'script']);
	$this->Html->css('Assets.form.elements', ['block' => 'css']);

	$model = Inflector::camelize(Inflector::singularize($this->params['controller']));
	$imagePath = isset($this->data[$model]) ? $this->data[$model][$field . '_url']:'';
	$id = "File" . $model . Inflector::camelize($field);
?>

<div class="form-group">
	<div class="input select"><label for="<?php echo $id; ?>"><?php echo Inflector::humanize($field); ?></label>
	
	<div class="assetfile-block well">
		<div class="preview" style="background-image: url('<?php echo $imagePath; ?>');"></div>
		<?php echo $this->Form->input('Ignore.file', ['type' => 'file', 'label' => false, 'div' => false, 'id' => $id]); ?>
		<?php echo $this->Form->input($field, ['type' => 'hidden']); ?>
	</div>
</div>