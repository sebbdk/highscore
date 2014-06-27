<div class="images index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3>
					<?php echo __('Images'); ?> 
					<?php echo $this->Html->link('(Add new)', array('action' => 'add')); ?>				</h3>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->

	<div class="row">

		<div>
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('asset_file'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($images as $image): ?>
					<tr>
						<td><div class='limiter'><?php echo h($image['Image']['name']); ?>&nbsp;<div></td>
							<td>
								<div class='limiter'>
									<?php 
										$arr = explode('.', $image['Image']['asset_file']);
										$ext = array_pop($arr);
										if(in_array($ext, ['png', 'gif', 'jpg', 'jpeg'])) {
											echo $this->Html->link( $this->Html->image('/files/uploads/' . $image['Image']['asset_file']),  '/files/uploads/' . $image['Image']['asset_file'], ['target' => '_blank', 'escape' => false, 'data-fancybox-group' => 'le-group'] , []); 
										} else {
											echo $this->Html->link( h($image['Image']['asset_file']),  '/files/uploads/' . $image['Image']['asset_file'], ['target' => '_blank'] ); 
										}
									?>
									&nbsp;
								</div>
							</td>
						<td><div class='limiter'><?php echo h($image['Image']['modified']); ?>&nbsp;<div></td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $image['Image']['id']), array('class' => 'btn btn-default','escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $image['Image']['id']), array('class' => 'btn btn-default', 'escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $image['Image']['id']), array('class' => 'btn btn-default', 'escape' => false), __('Are you sure you want to delete # %s?', $image['Image']['id'])); ?>
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