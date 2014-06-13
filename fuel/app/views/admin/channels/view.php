<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Channel'): ?>

<div class=" titleText"><strong><?php echo $detail['dcterms:title']; ?></strong></div>

<br>
	<div class="channelInfo">
		<div class="channelInfoContent">
		<img  style="float:left" class="imageBox" src=<?php echo $detail['foaf:logo'];?> ></img>
		<p><strong>Title:</strong>
		<br>
		<?php echo $detail['dcterms:title']; ?>
		</p>
		<p><strong>Summary:</strong>
		<br>
		<?php echo $detail['dcterms:description']; ?>
		</p>
		</div>
	</div>
	<?php endif;
	endif; ?>


<?php endforeach; ?>
<?php $counter = 0; ?>
<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Action'): ?>
	<?php if($counter==0):?>
	<table class="table table-striped">
		<thead>
			<th>Title</th>
			<th>Description</th>
		</thead>
		<tbody>
	<br>
	
	<span class="mini-title"><h2>Actions</h2></span>
	<?php endif;?>
		<tr>
		<td><?php echo $detail['dcterms:title']; ?></td>
		<td><?php echo $detail['dcterms:description']; ?></td>
		</tr>
	</tbody>
	
	<?php $counter++; ?>
	<?php endif;
	endif; ?>
<?php endforeach; ?>
</table>

<?php $counter = 0; ?>

<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Event'): ?>
	<?php if($counter==0):?>
	<table class="table table-striped">
		<thead>
			<th>Title</th>
			<th>Description</th>
		</thead>
	<tbody>
		
	<span class="mini-title"><h2>Events</h2></span>
	<?php endif;?>
		<tr>
		<td><?php echo $detail['dcterms:title']; ?></td>
		<td><?php echo $detail['dcterms:description']; ?></td>
		</tr>
	</tbody>

	<?php $counter++; ?>
	<?php endif;
	endif; ?>
<?php endforeach; ?>
	</table>



<?php echo Html::anchor('admin/channels', 'Back'); ?>