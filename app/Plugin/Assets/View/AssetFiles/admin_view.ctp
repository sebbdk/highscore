<div style="text-align: center;">
	<?php echo $this->Html->image(AssetFile::url($this->data['AssetFile']['id'])); ?>
</div>
<?php
echo $this->element('Crud/form', array(
	'model' => 'AssetFile',
	'columns' => array(
		'id' => array(
			'type' => 'text',
			'disabled' => true
		),
		'name' => array(
			'type' => 'text',
			'disabled' => true
		),
		'original_name' => array(
			'type' => 'text',
			'disabled' => true
		),
		'size' => array(
			'type' => 'text',
			'disabled' => true
		),
		'action' => array(
			'type' => 'text',
			'disabled' => true
		),
		'text_content' => array(
			'type' => 'textarea',
			'disabled' => true,
			'style' => 'height: 600px;'
		),
		'folder' => array(
			'type' => 'text',
			'disabled' => true
		),
		'created' => array(
			'type' => 'text',
			'disabled' => true
		)
	),
	'settings' => array(
		'showSubmit' => false
	)
), array(
	'plugin' => 'TwitterBootstrap'
));