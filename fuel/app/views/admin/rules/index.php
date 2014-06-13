<div class=" titleText"><strong>Rules</strong></div>
<br>
<?php echo Html::anchor('editor', 'Add new Rule', array('class' => 'btn btn-success')); ?>
<br>
<?php if ($rules): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>If this</th>
			<th></th>
			<th>Then that</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rules as $rule): ?>		<tr>

			<td><img class="imageBox" src=<?php echo /*$logos[array_search($rule, $rules)]*/ $rule['ifthis']['logo'] ?> ></td>

			<td> <?php echo Asset::img('rules-arrow.png') ?>  </td>

			<td><img class="imageBox" src=<?php echo /*$logos2[array_search($rule, $rules)]*/ $rule['thenthat']['logo'] ?> ></td>

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
