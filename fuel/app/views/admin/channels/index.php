<div class=" titleText"><strong>Channels</strong></div>

<?php #echo Html::anchor('editor', 'Add new Rule', array('class' => 'btn btn-success')); ?>

<br>
<?php if ($channels): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Logo</th>
			<th>Description</th>
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
	<td><?php echo Html::anchor('admin/channels/view/'.$channel['_id'], 'View'); ?></td>
	</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Channels.</p>

<?php endif; ?><p>
	
<?php #echo Html::anchor('editor', 'Add new Rule', array('class' => 'btn btn-success')); ?>
</p>
