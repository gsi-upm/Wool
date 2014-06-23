<?php  
echo Config::set('language', $language);
Lang::load('channels.json'); ?>
<?php foreach($graph as $detailType => $detail): 
	if($detail['@type'] != null): 
	if($detail['@type'] == 'ewe:Channel'): ?>

<div class=" titleText"><strong><?php echo $detail['dcterms:title']; ?></strong></div>

<br>
	<div class="channelInfo">
		<div class="channelInfoContent">
		<img  style="float:left" class="imageBox" src=<?php echo $detail['foaf:logo'];?> ></img>
		<p><strong><?php echo Lang::get('view.title'); ?></strong>
		<br>
		<?php echo $detail['dcterms:title']; ?>
		</p>
		<p><strong><?php echo Lang::get('view.summary');?></strong>
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
			<th><?php echo Lang::get('view.table_title');?></th>
			<th><?php echo Lang::get('view.table_description');?></th>
		</thead>
		<tbody>
	<br>
	
	<span class="mini-title"><h2><?php echo Lang::get('view.actions');?></h2></span>
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
			<th><?php echo Lang::get('view.table_title');?></th>
			<th><?php echo Lang::get('view.table_description');?></th>
		</thead>
	<tbody>
		
	<span class="mini-title"><h2><?php echo Lang::get('view.events');?></h2></span>
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



<?php echo Html::anchor('admin/channels'.'?lang='.$language, Lang::get('view.back'), array('class' => 'btn btn-primary')); ?>