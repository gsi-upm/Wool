<?php echo Config::set('language', $language);
    Lang::load('rules.json'); ?>
<div class=" titleText"><strong><?php echo Lang::get('index.title'); ?></strong></div>
<br>
<?php echo Html::anchor('editor', Lang::get('index.add_button'), array('class' => 'btn btn-success btn-lg')); ?>
<br>
<?php if ($rules): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th></th>
			<th><?php echo Lang::get('index.when'); ?></th>
			<th></th>
			<th><?php echo Lang::get('index.do'); ?></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rules as $rule): ?>		<tr>

			<td><div class="optionsView">
				<?php 
				if($rule['deployed']): ?>
					<p class="alert alert-success"><span class="text-Description"><?php echo Lang::get('index.activated'); ?></span></p>
				<?php else:
					echo Html::anchor('export/rule/'.$rule['_id'], Lang::get('index.activate'), array('class' => 'btn btn-primary btn-lg')); 
				endif;	?>
			</div></td>

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
				
				<?php echo Html::anchor('editor#/editor/'.$rule['_id'], Lang::get('index.edit'), array('class'=>'btn btn-primary channelInfoContent')); ?> 
				<?php echo Html::anchor('admin/rules/delete/'.$rule['_id'], Lang::get('index.delete'), 
					array('onclick' => "return confirm('Are you sure?')", 'class'=>'btn btn-danger')); ?>
				</div>
			</td>		
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p class="alert alert-info channelInfoContent"><?php echo lang::get('index.no_rules'); ?></p>

<?php endif; ?><p>
<?php echo Html::anchor('editor/?lang='.$language, Lang::get('index.add_button'), array('class' => 'btn btn-success btn-lg')); ?>

</p>
