<?php
echo $this->element('Crud/gallery_index', array(
	'model' => 'AssetFile',
	'preview' => function($View, $item, $model) {
		if($item[$model]['is_image']) {
			$image = AssetFile::url($item[$model]['id'],'admin_248x300');
		} else {
			$image = 'http://placehold.it/284x300.jpg';
		}
		
		$filePath = AssetFile::url($item[$model]['id']);
		
		return $View->Html->link($View->Html->image($image), $filePath, array(
			'target' => '_blank', 
			'escape' => false, 
			'class' => 'thumbnail'
		));
	},
	'columns' => array(
		'name',
		'id'
	),
	'row_actions' => array(
		'10_view' => function($View, $item, $model, $baseUrl) { 
			return $View->Html->link('View',
				array('action' => 'view', $item[$model]['id']),
				array(
					'class' => 'btn', 
					'escape' => false
			)); 
		}
	)), 
	array(
       'plugin' => 'TwitterBootstrap'
	)
);