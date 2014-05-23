<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Channel'): ?>

<div class=" titleText"><strong><?php echo $detail['dcterms:title']; ?></strong></div>

<br>
	<p>
		<img class="droppable imageBox" src=<?php echo $detail['foaf:logo'];?> ></img></p>

		<p>
		<strong>Title:</strong>
		<br>
		<?php echo $detail['dcterms:title']; ?></p>
	<p>
		<strong>Summary:</strong>
		<br>
		<?php echo $detail['dcterms:description']; ?></p>
	<?php endif;
	endif; ?>

<?php endforeach; ?>
<table class="table table-striped">
		<thead>
			<th>Title</th>
			<th>Description</th>
		</thead>
		<tbody>
<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Action'): ?>
	
	<span style="margin-bottom: 10px;"><h2><strong>Action</strong></h2></span>
	
		<tr>
		<td><?php echo $detail['dcterms:title']; ?></td>
		<td><?php echo $detail['dcterms:description']; ?></td>
		</tr>
	<?php endif;
	endif; ?>
<?php endforeach; ?>
	</tbody>
</table>

<table class="table table-striped">
	<thead>
		<th>Title</th>
		<th>Description</th>
	</thead>
	<tbody>
<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Event'): ?>
	<tr>
	<td><?php echo $detail['dcterms:title']; ?></td>
	<td><?php echo $detail['dcterms:description']; ?></td>
	</tr>
	<?php endif;
	endif; ?>
<?php endforeach; ?>
	</tbody>
</table>


<?php echo Html::anchor('admin/channels', 'Back'); ?>