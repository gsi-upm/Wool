<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::js(array(
		'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
		'bootstrap.js'
	)); ?>
	<!-- css -->
    <?php echo Asset::css(array('reset.css', 'jquery-ui-1.9.1.custom.min.css', 'kendo.common.min.css', 'kendo.metro.min.css', 'jquery.confirm.css', 'layout.css', 'fonts.css')); ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <!-- javascript libs-->
    <?php echo Asset::js(array('jquery-1.8.2.js', 'jquery-ui-1.9.2.custom.min.js', 'jquery.ui.touch-punch.min.js', 'jquery.pajinate.js', 'kendo.web.min.js',
    'underscore.js', 'knockout-2.1.0.js', 'knockout.mapping.js', 'sammy-latest.min.js', 'knockout-kendo.min.js', 'jquery.confirm.js', 'jquery.blockUI.js')); ?>

    <!-- javascript custom-->
    <?php echo Asset::js(array('manager.js')); ?>

	<script>
		$(function(){ 
			// $('.topbar').dropdown(); 
	});
			
	</script>
    

<body>
<div id="container">
	<div id="header">
	    <div id = "logo">
		<a href="#">
                <div class="epistemeLogo titleText">rule <span class="colorGreen">editor</span></div>
                </a>
		<br class="clear" />
            </div>
              
	    <div  id = "menuBar" data-bind="visible: true">
	    <div class="menuBarItem">
	    	<div class = "menuItemIcon ">
                 <?php #echo Asset::img('help.svg'); ?>
                 <?php echo Html::anchor('admin/'.'?lang='.$language, Asset::img('house.svg', array('class'=>'menuItemIcon'))) ?>
      		</div>
      		<?php echo Config::set('language', $language);?>
      		<?php Lang::load('general.json'); ?>
    		<?php echo Html::anchor('admin'.'?lang='.$language, Lang::get("titleBar.dashboard")); ?>
    	</div>

		<?php
			$files = new GlobIterator(APPPATH.'classes/controller/admin/*.php');
			foreach($files as $file)
			{
				$section_segment = $file->getBasename('.php');
				$section_title = Inflector::humanize($section_segment);
				?>
				<div class="menuBarItem">
					<div class="<?php echo Uri::segment(2) == $section_segment ? 'active' : '' ?> ">
						<div class = "menuItemIcon ">
	                 		<?php #echo Asset::img('help.svg'); 
	                 		#echo $section_segment; ?>
	                 		<?php echo Html::anchor('admin/'.$section_segment.'?lang='.$language, Asset::img($section_segment.'.svg', 
	                 			array('class'=>'menuItemIcon'))) ?>
	      				</div>
	      				<?php echo Html::anchor('admin/'.$section_segment.'?lang='.$language, Lang::get("titleBar.".$section_segment)) ?>
					</div>
				</div>
				<?php
			}
		?>
		 <div class="menuBarItem">
            <div class = "menuItemIcon ">
                      <?php #echo Asset::img('help.svg'); ?>
                      <?php #echo Html::anchor('admin/'.$section_segment, Asset::img('help.svg')) ?>
                      <?php echo Html::anchor('admin/logout', Asset::img('logout.svg', 
                        array('class'=>'menuItemIcon'))) ?>
                </div>
                <?php echo Html::anchor('admin/logout', Lang::get('titleBar.logout')) ?>
          </div>
		<!--
    	<div class="menuBarItem">
    		<div class = "menuItemIcon ">
                <?php echo Asset::img('help.svg'); ?>
		  </div>
    		<?php echo Html::anchor('admin/rules', 'Reglas') ?>
    	</div>
    -->

		<!-- 
		<?php if($current_user): ?>
		<div class="navbar-collapse collapse menuBarItem">
				<ul class="nav navbar-nav pull-right" style="{margin: auto;}">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $current_user->username ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo Html::anchor('admin/logout', 'Logout') ?></li>
						</ul>
					</li>
				</ul>
			</div>
		<?php endif;?>	  -->   
		</div>



    <!--
		<div  class = "selectedOffer" data-bind="visible: page() > 0.5 && option() != 1, click: $root.loadComposeSearch.bind($data, $root.currentSearch.id()), clickBubble: false">
                  <div class="logoContainer">
                    <img class="defaultLogo" data-bind="attr: { 'src': './images/offers/' + $root.currentSearch.logo() + '.png' }"/>
                 </div>
		  <div class="textContainer">
        	    <p class="draggableText" data-bind="text: $root.currentSearch.name()"></p>
      		  </div>
		</div>
  -->
  
	    <div  id = "langBar" >
	        <a href="<?php echo '?lang=es';?>" >
	        	<?php echo Asset::img('spanish.png', array('class'=>'flag')); ?>
		</a>
	        <a href="<?php echo '?lang=en';?>">
	        	<?php echo Asset::img('english.png', array('class'=>'flag')); ?>
		</a>
	    </div> 
	    <div  id = "messageBar" >
		
	    </div>
        </div>
	
	

<div  class="mainLayout">

	<!-- DROPPABLES -->

	<!-- DRAGGABLES -->
	<div class="generalLayout">

		<div id="mainLayoutElements" class="main">
			<?php echo $content; ?>
		</div>	
	</div>
</div>
<?php include('footer.php'); ?>
	<div id="dialog-modal" data-bind="visible: false">
		<h3><?php echo Lang::get('credits.image-credits');?></h3><br>

		<?php echo Lang::get('credits.house'); ?><br>
		<?php echo Lang::get('credits.sheep'); ?><br>
		<?php echo Lang::get('credits.yarn');?><br>
		<?php echo Lang::get('credits.question'); ?><br>

	</div>

</body>
</html>