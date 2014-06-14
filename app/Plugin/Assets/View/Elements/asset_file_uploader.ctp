<?php
	$this->Html->script('Assets.form.upload', ['block' => 'script']);
	$this->Html->css('Assets.form.elements', ['block' => 'css']);

	$model = Inflector::camelize(Inflector::singularize($this->params['controller']));
	$imagePath = isset($this->data[$model]) ? $this->webroot . 'files/uploads/' . $this->data[$model]['asset_file']:'';
?>

<div class="assetfile-block well">
	<div class="preview" style="background-image: url('<?php echo $imagePath; ?>');"></div>
	<?php echo $this->Form->input('Ignore.file', ['type' => 'file', 'label' => false, 'div' => false]); ?>
	<?php echo $this->Form->input($field, ['type' => 'hidden']); ?>
</div>