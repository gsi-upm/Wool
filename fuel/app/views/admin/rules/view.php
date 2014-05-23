<div class=" titleText"><strong>Rule</strong></div>


<p>
	<strong>Title:</strong>
	<?php echo $rule['name']; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $rule['description']; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $rule['sintaxis']; ?></p>

<?php echo Html::anchor('admin/rules/edit/'.$rule['_id'], 'Edit'); ?> |
<?php echo Html::anchor('admin/rules', 'Back'); ?>