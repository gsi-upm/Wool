<div id="header">
	    <div id = "logo">
		<a href="#" data-bind="click: $root.changeURL.bind($data,'#')">
                <div class="epistemeLogo titleText">rule <span class="colorGreen">editor</span></div>
                </a>
		<br class="clear" />
            </div>

	    <div  id = "menuBar" data-bind="visible: page() < 3">
	    <div class="menuBarItem">
	    	<div class = "menuItemIcon ">
                 <?php echo Asset::img('help.svg'); ?>
      		</div>
    		<?php echo Html::anchor('admin', 'Dashboard') ?>
    	</div>

    	<div class="menuBarItem">
    		<div class = "menuItemIcon ">
                <?php echo Asset::img('help.svg'); ?>
		  </div>
    		<?php echo Html::anchor('admin/rules', 'Reglas') ?>
    	</div>

		<div  class = "menuBarItem" data-bind="css: { inactive: status() < -1, selected: help()}">
		  <a  href="#" data-bind="click: $root.activateHelp.bind($data,'help','')">
		  <div class = "menuItemIcon ">
                    <?php echo Asset::img('help.svg'); ?>
		  </div>
		  <div class = "menuItemText"><span data-bind="text: lang().m5"></span></div>
		  </a>
		</div>
		<div class="navbar-collapse collapse menuBarItem">
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $current_user->username ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo Html::anchor('admin/logout', 'Logout') ?></li>
						</ul>
					</li>
				</ul>
			</div>
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
	        <a href="#" data-bind="click: changeLanguage.bind($data,'0')">
	        	<?php echo Asset::img('spanish.png', array('class'=>'flag', 'data-bind'=>"css: { flagSelected: lang().lang == 'Spanish' }")); ?>
		</a>
	        <a href="#" data-bind="click: changeLanguage.bind($data,'1')">
	        	<?php echo Asset::img('english.png', array('class'=>'flag', 'data-bind'=>"css: { flagSelected: lang().lang == 'English' }")); ?>
		</a>
	    </div>
	    <div  id = "messageBar" >
		
	    </div>
        </div>
