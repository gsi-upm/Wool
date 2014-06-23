<?php  
echo Config::set('language', $language);
Lang::load('channels.json'); ?>
<div class=" titleText"><strong><?php echo Lang::get('index.title'); ?></strong></div>

<?php #echo Html::anchor('editor', 'Add new Rule', array('class' => 'btn btn-success')); ?>

<br>
<?php if ($channels): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang::get('index.table_title');?></th>
			<th><?php echo lang::get('index.table_logo');?></th>
			<th><?php echo lang::get('index.table_description');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($channels as $channel): ?>		
	<tr>
	<?php foreach($channel as $infoType => $info):
		if($infoType == '@graph'):
		foreach($info as $detailType => $detail): 
			if($detail['@type'] != null): 
			if($detail['@type'] == 'ewe:Channel'): ?>

				<td><?php echo $detail['dcterms:title']; ?></td>
				<td><img class="imageBox" src=<?php echo $detail['foaf:logo'];?> ></img></td>
				<td><?php echo $detail['dcterms:description']; ?></td>

			<?php endif;
			endif;
		endforeach;
		endif;
	endforeach; ?>
	<td><?php echo Html::anchor('admin/channels/view/'.$channel['_id'].'?lang='.$language, Lang::get('index.table_view'), array('class' => 'btn btn-info')); ?></td>
	</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>

<p class="alert alert-info channelInfoContent"><?php echo lang::get('index.no_channels'); ?></p>

<?php endif; ?><p>
	
<?php #echo Html::anchor('editor', 'Add new Rule', array('class' => 'btn btn-success')); ?>
</p>
