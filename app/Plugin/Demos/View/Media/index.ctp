<div class="media index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3>
					<?php echo __('Media'); ?> 
					<?php echo $this->Html->link('(Add new)', array('action' => 'add')); ?>				</h3>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->

	<div class="row">
				<div>
			<table cellpadding="0" cellspacing="0" class="table table-striped MediaTable">
				<thead>
					<tr>
										<th class="MediaGalleryIdField"><?php echo $this->Paginator->sort('gallery_id'); ?></th>
										<th class="MediaNameField"><?php echo $this->Paginator->sort('name'); ?></th>
										<th class="MediaAssetFileField"><?php echo $this->Paginator->sort('asset_file'); ?></th>
										<th class="MediaOriginField"><?php echo $this->Paginator->sort('origin'); ?></th>
										<th class="MediaSortField"><?php echo $this->Paginator->sort('sort'); ?></th>
										<th class="MediaModifiedField"><?php echo $this->Paginator->sort('modified'); ?></th>
										<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($media as $media): ?>
					<tr>
								<td class='MediaGalleryIdField'>
			<?php echo $this->Html->link($media['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $media['Gallery']['id'])); ?>
		</td>
						<td class='MediaNameField'><div class='limiter'><?php echo h($media['Media']['name']); ?>&nbsp;<div></td>
							<td class='MediaAssetFileField'>
								<div class='limiter'>
									<?php 
										$arr = explode('.', $media['Media']['asset_file']);
										$ext = array_pop($arr);
										$prepend = strrpos($media['Media']['asset_file'], '://') === false ? '/files/uploads/':''; 
										if(in_array($ext, ['png', 'gif', 'jpg', 'jpeg'])) {
											echo $this->Html->link( $this->Html->image($prepend . $media['Media']['asset_file']),  $prepend . $media['Media']['asset_file'], ['target' => '_blank', 'escape' => false, 'data-fancybox-group' => 'le-group', 'class' => 'fancy'] , []); 
										} else {
											echo $this->Html->link( h($media['Media']['asset_file']),  $prepend . $media['Media']['asset_file'], ['target' => '_blank'] ); 
										}
									?>
									&nbsp;
								</div>
							</td>
						<td class='MediaOriginField'><div class='limiter'><?php echo h($media['Media']['origin']); ?>&nbsp;<div></td>
						<td class='MediaSortField'><div class='limiter'><?php echo h($media['Media']['sort']); ?>&nbsp;<div></td>
						<td class='MediaModifiedField'><div class='limiter'><?php echo h($media['Media']['modified']); ?>&nbsp;<div></td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $media['Media']['id']), array('class' => 'btn btn-default','escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $media['Media']['id']), array('class' => 'btn btn-default', 'escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $media['Media']['id']), array('class' => 'btn btn-default', 'escape' => false), __('Are you sure you want to delete # %s?', $media['Media']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->