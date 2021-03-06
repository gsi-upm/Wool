<?php Lang::load('dashboard.json') ?>
<div class="dashboardBox presentationBox">
	<div style="margin:30px;">
	<h1 class="dashboardTitle">Wool</h1>
	<p class="channelInfoContent"><?php echo Lang::get('presentationBox.description'); ?></p>
	<p><a class="btn btn-primary btn-lg" href="https://github.com/gsi-upm/Wool"><?php echo Lang::get('presentationBox.docsButton');?></a></p>
	</div>
</div>

<div class="dashboardBox statusBox">
	<div style="margin:30px;">
	<h1 class="dashboardTitle littleTitle"><?php echo Lang::get('statusBox.title'); ?></h1>
	<?php switch($status){
		case "OK": ?>
			<p class="alert alert-success"><?php echo Lang::get('statusBox.description-OK'); ?></p>
			<?php break;
		case "WARNING": ?>
			<p class="alert alert-warning"><?php echo Lang::get('statusBox.description-WARNING'); ?></p>
			<?php break;
		case "UNKNOWN": ?>
			<p class="alert alert-danger"><?php echo Lang::get('statusBox.description-DANGER'); ?></p>
			<?php break;
	} ?>


	
	<p>
		<!-- <a class="btn btn-primary btn-lg" href="https://github.com/gsi-upm/Wool"><?php echo Lang::get('presentationBox.docsButton');?></a> -->
		<?php echo Html::anchor('admin'.'?lang='.$language, Lang::get('statusBox.checkButton'), array('class' => 'btn btn-primary btn-lg')); ?>
	</p>
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-4">
		<h2>Get Started</h2>
		<p>The controller generating this page is found at <code>APPPATH/classes/controller/admin.php</code>.</p>
		<p>This view can be found at <code>APPPATH/views/admin/dashboard.php</code>.</p>
		<p>You can modify these files to get your application started quickly.</p>
	</div>
	<div class="col-md-4">
		<h2>Learn</h2>
		<p>The best way to learn FuelPHP is reading through the <a href="http://docs.fuelphp.com">Documentation</a>.</p>
		<p>Another good resource is the <a href="http://fuelphp.com/forums">Forums</a>.  They are fairly active, and you can usually get a response quickly.</p>
	</div>
	<div class="col-md-4">
		<h2>Contribute</h2>
		<p>FuelPHP wouldn't exist without awesome contributions from the community.  Use the links below to get contributing.</p>
		<ul>
			<li><a href="http://docs.fuelphp.com/general/coding_standards.html">Coding Standards</a></li>
			<li><a href="http://github.com/fuel/fuel">GitHub Respository</a></li>
			<li><a href="http://fuelphp.com/contribute/issue-tracker">Issue Tracker</a></li>
		</ul>
	</div>
</div> -->