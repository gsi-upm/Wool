<?php
echo Config::set('language', $language);
Lang::load('field.json');
?>
<div class=" titleText"><strong><?php echo Lang::get('index.mainTitle'); ?></strong>
	<?php echo Asset::img('gsi_logo.png');?>
</div>

<div class="dashboardBox presentationBox fieldBox">

<?php foreach ($rules as $rule) { ?>
	<div class="fieldEvent">
		<button class="fieldEventButton" 
		data-bind="click: triggerEvent.bind($data, '<?php echo $rule['ifthis']['@id']?>', <?php echo count($rule['ifthisOutputs'])?>)">
		<img class="imageBox imageBoxField" src=<?php echo $rule['ifthis']['logo-event'] ?> 
		 	data-bind="attr:{id:  '<?php echo $rule['ifthis']['@id']?>' }">
		<p>
			<?php echo $rule['ifthis']['dcterms:title']?>
		</p>
		</button>
	</div>
<?php }?>

<div id="map" class="mapGSIOff">
	<div id="warning">
		<p class="alert alert-danger"><?php echo Lang::get('warning');?></p>
	</div>

	<div class="dni" >
	 	<img id="dniImage">
	 	<div class="tvText" data-bind="text: dni() + '\n' + '<?php echo Lang::get('dni.dni_entered')?>'"></div>
		</img>
	</div>

	<div class="tv">
		<img id="tvImage">
		<div class="tvText" data-bind="text: tvText()"></div>
		</img>
	</div>

	<div class="bot">
		<img class="imageBox imageBoxField" src="https://www.gsi.dit.upm.es/templates/jgsi/images/bot/avatars/happy.png">
		<div data-bind="text: 'Bot: ' + botText() " ></div>
	</div>

 	<img id="gsiLab"></img>

</div>

</div>

<div id="dialog-event" data-bind="visible: false">
	<div class="input-group">
		<input type="text" class="form-control" placeholder="<?php echo Lang::get('inputform.input');?>"
			data-bind="value: outputMessage">
	</div>
	<p class="alert alert-danger" style="margin: 5px;" data-bind="visible: formAlert() "><?php echo Lang::get('inputform.alert');?></p>
</div>


