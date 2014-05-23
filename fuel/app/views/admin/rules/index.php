<div class=" titleText"><strong>Rules</strong></div>

<br>
<?php if ($rules): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>If this</th>
			<th>Description</th>
			<th>Then that</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rules as $rule): ?>		<tr>
			<td><img class="droppable imageBox" src=<?php echo $logos[array_search($rule, $rules)] ?> ></td>

			<td>When 
				<span class="text-Description"><?php echo $rule['ifthis']['dcterms:title'] ?></span>
				<?php if($rule['ifthis']['inputform'] != array()): ?>
				<div class="text-Description box-Description"> <?php echo $rule['ifthis']['inputform'] ?> </div>
				<?php endif; ?>
				then
				<span class="text-Description"><?php echo $rule['thenthat']['dcterms:title'] ?></span>
				<br><br>
				Created at: <?php echo $rule['created_at'] ?>
				<br>
				<?php if(isset($rule['last_edited_at'])): 
				echo "Last edited at: ". $rule['last_edited_at'];
				endif; ?>

			</td>

			<td><img class="droppable imageBox" src=<?php echo $logos2[array_search($rule, $rules)] ?> ></td>

			<td>
				<div class="optionsView">
				
				<?php echo Html::anchor('editor#/editor/'.$rule['_id'], 'Edit'); ?> |
				<?php echo Html::anchor('admin/rules/delete/'.$rule['_id'], 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				</div>
			</td>		
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rules.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('editor', 'Add new Rule', array('class' => 'btn btn-success')); ?>

</p>
