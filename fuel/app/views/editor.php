<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    
  <?php echo Asset::js(array(
    'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
    'bootstrap.js'
  )); ?>
  <!-- css -->
    <?php echo Asset::css(array('reset.css', 'jquery-ui-1.9.1.custom.min.css', 'kendo.common.min.css', 'kendo.metro.min.css', 'jquery.confirm.css', 'layout.css', 'fonts.css')); ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <!-- javascript libs-->
    <?php echo Asset::js(array('jquery-1.8.2.js', 'jquery-ui-1.9.2.custom.min.js', 'jquery.ui.touch-punch.min.js', 'jquery.ui.position.js', 'jquery.pajinate.js', 'kendo.web.min.js',
    'underscore.js', 'knockout-2.1.0.js', 'knockout.mapping.js', 'sammy-latest.min.js', 'knockout-kendo.min.js', 'jquery.confirm.js', 'jquery.blockUI.js')); ?>

    <!-- javascript custom-->
    <?php echo Asset::js(array('configuration.js', 'dictionary.js', 'dragDrop.js', 'pagination.js', 'tooltips.js', 'modal.js', 'mvvm.js')); ?>

    
    <link rel="icon" href="favicon.ico" type="image/x-icon"> 
    
	<title>GSI Rule Editor</title>

</head>

<body>
    <div id="container">
        <div id="header">
	    <div id = "logo">
		<a href="#" data-bind="click: $root.changeURL.bind($data,'#/editor')">
                <div class="epistemeLogo titleText">rule <span class="colorGreen">editor</span></div>
                </a>
		<br class="clear" />
            </div>



	    <div  id = "menuBar" data-bind="visible: page() < 3">

	   

     <div class="menuBarItem">
        <div class = "menuItemIcon ">
                 <?php #echo Asset::img('help.svg'); ?>
                 <?php echo Html::anchor('admin/', Asset::img('help.svg')) ?>
          </div>
        <?php echo Html::anchor('admin', 'Dashboard') ?>
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
                      <?php #echo Asset::img('help.svg'); ?>
                      <?php echo Html::anchor('admin/'.$section_segment, Asset::img('help.svg')) ?>
                </div>
                <?php echo Html::anchor('admin/'.$section_segment, $section_title) ?>
          </div>
        </div>
        <?php
      }
    ?>

    <div  class = "menuBarItem" data-bind="css: { inactive: status() < -1, selected: help()}">
      <a  href="#" data-bind="click: $root.activateHelp.bind($data,'help','')">
      <div class = "menuItemIcon ">
                    <?php echo Asset::img('help.svg'); ?>
      </div>
      <div class = "menuItemText"><span data-bind="text: lang().m5 "></span></div>
      </a>
    </div>

    <?php if($current_user): ?>
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
    <?php endif;?>      
    
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
	    </div>
	    <div  id = "langBar" >
	        <a href="#" data-bind="click: changeLanguage.bind($data,'0')">
			<img class="flag" src="images/spanish.png" data-bind="css: { flagSelected: lang().lang == 'Spanish' }"/>		
		</a>
	        <a href="#" data-bind="click: changeLanguage.bind($data,'1')">
			<img class="flag" src="images/english.png" data-bind="css: { flagSelected: lang().lang == 'English' }"/>
		</a>
	    </div>
	    <div  id = "messageBar" >
		
	    </div>
        </div>



<div id="main" class="mainContainer" data-bind="visible: page() < 3">

<!-- DROPPABLES -->
<div class="dropContainer" data-bind="css: { offerContainer: page() == 0 }" >
    <!-- COMPOSER -->
    <!-- ko if: option() == 0 -->
    <div id="droppableElementsLeft" data-bind="visible: true && !savingFinished()" >

        <div data-bind="foreach: $root.containerLeft.container">
	 <div class="droppable droppableCompany company droppableContainerLeft" class="class2" id="droppable1" data-bind="visible: $root.page() > 0, attr: {'name': $data, 'index': $index},  css: { 'stateDisabled': $root.currentEntity() != $index(), 'selected': $root.currentEntity() == $index(), 'draggableContainerLeft': $data.containerName() != '', 'draggableEmpty': $data.containerName() == ''}">

           
	   <!-- ko if: $data.containerName() == '' -->
   	   <div class ="droppableText"> <span data-bind="text: $root.lang().d2+' '+$root.lang().channel+' '+($index()+1)"></span> </div>
	   <!-- /ko -->

           <!-- ko if: $data.containerName() != '' --> 
           <div class="droppedLogoContainer">
               <!-- ko if: $data.containerLogo() != '' -->
               <img class="defaultLogo" src="images/default.png" data-bind="attr: { 'src': $data.containerLogo() }"/>
               <!-- /ko -->
               <!-- ko if: $data.containerLogo() == '' -->
               <img class="defaultLogo" src="images/default.png"/>
               <!-- /ko -->
           </div>
           <div class="textContainer">
               <p class="draggableText" data-bind="text: $data.containerName()"></p>
           </div>
           <!-- /ko -->
	 </div>
	</div>  
    <div class="lines" id="lines" data-bind="if: page() == 1">
		  <img class="img" data-bind="attr: { 'src': lang().i1 }">
	  </div>

    <!-- ko if: containerLeft.container()[0].containerName() != '' -->
      <div class="containerDescription" data-bind="visible: containerLeft.container()[0].containerName() != '' ">
      <!-- ko if: ifthisConfig != '' -->
      <div style="width:100%;" data-bind="visible: !selectingTrigger() || ifthisConfig['@id']() != '' ">
        <p><span data-bind="text: lang().t4"></span><h6><span data-bind="text: ifthisConfig['dcterms:title']() + ''"></span></h6></p>

        <p data-bind="visible: $root.ifthisConfig['dcterms:description'] != '' ">
          <span data-bind="text: lang().t5"></span><h6><span data-bind="text: $root.ifthisConfig['dcterms:description'] "></span></h6>
        </p>

        <!-- ko if: $root.ifthisConfig['ewe:hasInputParameter'] != undefined && $root.ifthisConfig['@type']() == 'ewe:Event' -->
        <p data-bind="visible: $root.ifthisConfig['ewe:hasInputParameter']['dcterms:title']() != '' ">
          <span data-bind="text: ifthisConfig['ewe:hasInputParameter']['dcterms:title']() + ':' "></span>
          <h6><span data-bind="text: ifthisConfig.inputform "></span></h6>
        </p>
        <!-- /ko -->

        <!-- <p data-bind="visible: $root.ifthisConfig.config.inputform().length > 0">
        <div data-bind="foreach: $root.ifthisConfig.config.inputform()">
          <span data-bind="text: $root.ifthisConfig.config.inputform()[$index()]"></span>
          <h6><span data-bind="text: $root.ifthisConfig.config.inputform()[$index()]"></span></h6>
        </div>
        </p> -->

      </div>
      <!-- /ko -->
      </div>
    <!-- /ko -->

    </div>
    <!-- /ko -->
    <!-- ko if: option() == 0 -->
    <div id="droppableElementsRight" data-bind="visible: true && !savingFinished()" >

        <div data-bind="foreach: $root.containerRight.container">
   <div class="droppable droppableCompany company droppableContainerRight" class="class2" id="droppable1" data-bind="visible: $root.page() > 0, attr: {'name': $data, 'index': $index+1}, css: { 'stateDisabled': $root.currentEntity() != $index(), 'selected': $root.currentEntity() == $index(), 'draggableContainerRight': $data.containerName() != '', 'draggableEmpty': $data.containerName() == ''}">

           
     <!-- ko if: $data.containerName() == '' -->
       <div class ="droppableText"> <span data-bind="text: $root.lang().d2+' '+$root.lang().channel+' '+($index()+2)"></span> </div>
     <!-- /ko -->

           <!-- ko if: $data.containerName() != '' --> 
           <div class="droppedLogoContainer">
               <!-- ko if: $data.containerLogo() != '' -->
               <img class="defaultLogo" src="images/default.png" data-bind="attr: { 'src': $data.containerLogo() }"/>
               <!-- /ko -->
               <!-- ko if: $data.containerLogo() == '' -->
               <img class="defaultLogo" src="images/default.png"/>
               <!-- /ko -->
           </div>
           <div class="textContainer">
               <p class="draggableText" data-bind="text: $data.containerName()"></p>
           </div>
           <!-- /ko -->
   </div>
  </div>  
    <div class="lines" id="lines" data-bind="if: page() == 1">
      <img class="img" data-bind="attr: { 'src': lang().i1 }">
    </div>

    <!-- ko if: containerRight.container()[0].containerName() != '' -->
      <div class="containerDescription" data-bind="visible: containerRight.container()[0].containerName() != '' ">
      <!-- ko if: thenthatConfig != '' -->
      <div data-bind="visible: !selectingTrigger() || thenthatConfig['@id']() != '' ">
        <p><span data-bind="text: lang().t4"></span><h6><span data-bind="text: thenthatConfig['dcterms:title']() + ''"></span></h6></p>

        <p data-bind="visible: $root.thenthatConfig['dcterms:description']() != '' ">
          <span data-bind="text: lang().t5"></span><h6><span data-bind="text: thenthatConfig['dcterms:description']() "></span></h6>
        </p>

        <!-- <p data-bind="visible: $root.thenthatConfig.config.radiobutton.general() != '' ">
          <span data-bind="text: lang().t6"></span><h6><span data-bind="text: thenthatConfig.config.radiobutton[$root.lang().lang]"></span></h6>
        </p> -->

        <!-- <p data-bind="visible: false">
        <div data-bind="foreach: $root.thenthatConfig.config.inputform[$root.lang().lang]()">
          <span data-bind="text: $root.thenthatConfig.config.inputform[$root.lang().lang]()[$index()]"></span>
          <h6><span data-bind="text: $root.thenthatConfig.config.inputform.data()[$index()]"></span></h6>
        </div>
        </p> -->

      </div>
      <!-- /ko -->
      </div>
    <!-- /ko -->

    </div>
    <!-- /ko -->
    <div id="finalizeElements" data-bind="visible: editionFinished() && !savingFinished()" >
       <button  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only accept-button" data-bind="click: $root.saveRule">
        <span class="ui-button-text" data-bind="text: $root.lang().saveRule"></span></button>
        <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only accept-button" data-bind="click: $root.cancelEdition">
        <span class="ui-button-text" data-bind="text: $root.lang().cancelRule"></span></button>
    </div>

    <div data-bind="visible: savingFinished()">
      <div>
      <button  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only accept-button">
        <a class="ui-button-text" href="http://homer.gsi.dit.upm.es/wool/public/admin/rules">
          <span class="ui-button-text" data-bind="text: $root.lang().backToRules"></span>
        </a>
      </button>
      </div>
      <div>
      <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only accept-button" data-bind="click: $root.cancelEdition">
        <span class="ui-button-text" data-bind="text: $root.lang().backToEdit"></span>
      </button>
      </div>
        
    </div>
    <!-- FINALIZE -->

</div>



<!-- SEARCH EDITOR -->
<div id="searchEditor" class="searchEditorContainer" data-bind="visible: page() == 0 && status() == 1">
<!-- ko if: $root.option() == 0 -->
<div class="searchDescription">
    <div class="searchDescriptionContainer">
      <div id="logoContainer"><img data-bind="attr: { 'src': './images/offers/' + $root.currentSearch.logo() + '.png' }"></img></div>
      <span class="filterName" ><span data-bind="text: lang().name"></span></span>
      <input class="k-input" type="text" data-bind="value: $root.currentSearch.name, valueUpdate: 'afterkeydown'"><br>
      <span class="filterName" ><span data-bind="text: lang().description"></span></span>
      <textArea class="k-input" type="text" id="textDescription" data-bind="value: $root.currentSearch.about, valueUpdate: 'afterkeydown'"></textArea><br>
      <span class="filterName" ><span data-bind="text: lang().logo"></span></span>
      <select data-bind="options: availableLogos, value: $root.currentSearch.logo"></select>
    </div>
</div>
<!-- /ko -->
<div class="searchEntities">
<!-- ko with: $root.currentSearch.result -->
<div data-bind="kendoTabStrip: {}">
<ul data-bind="visible: $root.option() == 0">
  <!-- ko foreach: $root.currentSearch.result -->
    <!-- ko if: $root.currentSearch.result().length > $index()+1 -->
    <li class="entitytab"><span data-bind="text: $root.lang().entity+' '+($index()+1), click: $root.changeTab.bind($data, $index())"></span><span class="deleteEntity" data-bind="click: $root.removeEntity.bind($data, $root.currentSearch.result, $data)"> x</span></li>
    <!-- /ko -->
    <!-- ko if: $root.currentSearch.result().length == $index()+1 -->
    <li class="entitytab k-state-active"><span data-bind="text: $root.lang().entity+' '+($index()+1), click: $root.changeTab.bind($data, $index())"></span><span class="deleteEntity" data-bind="click: $root.removeEntity.bind($data, $root.currentSearch.result, $data)"> x</span></li>
    <!-- /ko -->
  <!-- /ko -->
  <!-- ko if: $root.currentSearch.result().length < 4 -->
  <li class="addEntity" data-bind="click: $root.addEntity.bind($data, $root.currentSearch.result)">+</li>
  <!-- /ko -->
</ul>
<!-- ko foreach: $root.currentSearch.result -->
  <div>
    <div class="filter" data-bind="visible: $data.entityName() != ''">
      <div class="filterHeader">
        <div class="filterName" ><span data-bind="text: $root.lang().selectedEntity"></span>:</div>
        <span class="entityName" data-bind="text: $data.entityName()"></span>
        <br>
      </div>
    </div>
    <div class="filter">
    <span>
      <span class="filterName" data-bind="text: $root.lang().origin"></span>
      <a class="greenButton provenanceBtn" data-bind="css: { active: $data.provenance()=='gsi'},click: $root.changeProvenance.bind($data, $index, 'gsi')">gsi</a>
      <!-- <a class="greenButton provenanceBtn" data-bind="css: { active: $data.provenance()=='vulka'},click: $root.changeProvenance.bind($data, $index, 'vulka')">vulka</a> -->
      <a class="filterInfo blueButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType),attr: { 'title': $root.lang().provenanceHelp}">?</a>
    </span>
    </div>
    <!-- Filtros SEMANTIC -->
    <div class="filter" data-bind="visible: $data.isSemantic() == 'true' ">
      <div class="filterHeader">
        <div class="filterName" ><span data-bind="text: $root.lang().semanticFilters"></span></div>
        <input class="semanticInput" data-bind="kendoAutoComplete: { data: $root.Skill, value: $root.newSkillName }, attr: { 'placeholder': $root.lang().semanticPlaceHolder }" />
        <fieldset class="rating">
          <input type="radio" id="star3" value="expert" data-bind="attr:{'name':$data.id},checked: $root.newSkillLevel"/><label for="star3" data-bind="attr: { 'title': $root.lang().advanced}"><span data-bind="text: $root.lang().advanced"></span></label>
          <input type="radio" id="star2" value="intermediate" data-bind="attr:{'name':$data.id},checked: $root.newSkillLevel"/><label for="star2" data-bind="attr: { 'title': $root.lang().expert}"><span data-bind="text: $root.lang().expert"></span></label>
          <input type="radio" id="star1" value="beginner" data-bind="attr:{'name':$data.id},checked: $root.newSkillLevel"/><label for="star1" data-bind="attr: { 'title': $root.lang().basic}"><span data-bind="text: $root.lang().basic"></span></label>
        </fieldset>
        <a class="greenButton" data-bind="click: $root.addSemanticFilter.bind($data,$data.semantic, $root.newSkillName, $root.newSkillLevel())">+</a>
        <a class="filterInfo blueButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType),attr: { 'title': $root.lang().semanticHelp}">?</a>
        <br>
      </div>
      <ul id="breadcrumbs-four" data-bind="foreach: $data.semantic">
        <li class="current"><a data-bind="text: $data.skill()+' ['+$root.lang()[$data.level()]+'] x', click: $root.removeSemanticFilter.bind($data, $parentContext.$data.semantic, $data)"></a></li>
      </ul>
    </div>
    <!-- Filtros SOLR -->
    <div data-bind="foreach: $data.solr">
    <div class="filter" data-bind="visible: $data.name() != 'hidden'">
    <span data-bind="if: $data.field() == 'Province'">
      <span class="filterName" data-bind="text: $root.lang().province"></span>
      <input class="solrInput" data-bind="kendoComboBox: { data: $root.Province, value: $root.selectedProvince }" />
      <a class="greenButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedProvince)">+</a>
      <a class="filterInfo blueButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType),attr: { 'title': $root.lang().provinceHelp}">?</a>
    </span>
    <span data-bind="if: $data.field() == 'Type'">
      <span class="filterName" data-bind="text: $root.lang().type"></span>
      <input class="solrInput" data-bind="kendoComboBox: { data: $root.Type, value: $root.selectedType }" />
      <a class="greenButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType)">+</a>
      <a class="filterInfo blueButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType),attr: { 'title': $root.lang().typeHelp}">?</a>
    </span>
    <span data-bind="if: $data.field() == 'Description'">
      <span class="filterName" data-bind="text: $root.lang().freeText"></span>
      <input class="solrInput k-input" type="text" data-bind="value: $root.selectedDescription, valueUpdate: 'afterkeydown', attr: { 'placeholder': $root.lang().typePlaceHolder }">
      <a class="greenButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedDescription)">+</a>
      <a class="filterInfo blueButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType),attr: { 'title': $root.lang().descriptionHelp}">?</a>
    </span>
    
    <!-- Nuevo filtro SOLR: Posibilidad de viajar-->
    <span data-bind="if: $data.field() == 'Travel'">
      <span class="filterName" data-bind="text: $root.lang().travel"></span>
      <input class="solrInput" data-bind="kendoComboBox: { data: $root.Travel, value: $root.selectedTravel}" />
      <a class="greenButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedTravel)">+</a>
      <a class="filterInfo blueButton" data-bind="click: $root.addSolrFilter.bind($data, $data.values, $root.selectedType),attr: { 'title': $root.lang().travelHelp}">?</a>
    </span>
    
    
      <!-- Filtros SOLR añadidos -->
      <ul id="breadcrumbs-four" data-bind="foreach: $data.values">
         <li class="current"><a data-bind="text: $data+' x', click: $root.removeSolrFilter.bind($data, $parentContext.$data.values, $data)"></a></li>
      </ul>
    </div>
    </div>
  </div>
<!-- /ko -->
</div>
<!-- /ko -->
</div>
<div class="searchDescription">
  <!-- ko if: $root.option() == 0 -->
  <a  class="greenButton" href="#" data-bind="click: $root.selectSearch.bind($data,'start')"><span data-bind="text: lang().RETURN"></span></a>
  <a  class="greenButton" href="#" data-bind="click: $root.doSaveJSON"><span data-bind="text: lang().SAVE"></span></a>
  <!-- /ko -->
  <a  class="blueButton" href="#" data-bind="attr: {'href': '#/composer/' + $root.currentSearch.id() + '/entity/'+$root.currentEntity()}"><span data-bind="text: lang().SEARCH"></span></a>
</div>
</div>
<!-- \SEARCH EDITOR -->



<!-- CONTROL -->
<!-- esto si que me interesa -->
<div class="controlContainer" data-bind="visible: !editionFinished()">
    <div id="filterBtn" data-bind="visible: false">
    <a class="category" href="#" data-filter-by-category="true"> <span data-bind="text: lang().b2"></span> </a>
    </div>
    <div id="resultsNumberBar" data-bind="if: page() == 1">
	<!-- ko if: filteredData().length != 1 -->
	<div id = "mBarText" data-bind="text: filteredData().length + ' ' + lang().m4, visible: page() == 1" ></div>
	<!-- /ko -->
	<!-- ko if: filteredData().length == 1 -->
	<div id = "mBarText" data-bind="text: filteredData().length + ' ' + lang().m4b, visible: page() == 1" ></div>
	<!-- /ko -->
    </div>
    <div id="filterBar" data-bind="if: page() == 1">
    <!-- <input id="search" data-bind="attr: { 'placeholder': lang().b1 }, value: filter, hasfocus: focusBar, valueUpdate: 'afterkeydown'"/>-->
    <input id="search" data-bind="attr: { 'placeholder': lang().b1 }, value: filter, valueUpdate: 'afterkeydown'"/>
    </div>
    <div class="lines" id="Selectlines" data-bind="if: ($root.page() == 0 && $root.status() == 0) && $root.currentSearches.values().length > 0">
        <span class="headingText" data-bind="text: lang().pickSearch "></span> <span class="colorBlue headingText" data-bind="text: lang().search "></span>
    </div>

</div>

<!-- DRAGGABLES -->
<div class="dragContainer" data-bind="visible: !editionFinished()">
<div id="leftArrow" data-bind="visible: existPagination()">
  <a class="prevBtn" href="">
    <img id="larrow" src="images/larrow.png" />
  </a>
</div>

<div id="draggableElements" class="main" data-bind="visible: page() != 0 || status() != 1">

    <!-- SELECT OPTION -->
    <div data-bind="visible: page() == 0.5">      

      <div class="draggable offer clickableOffers selectOption" data-bind="click: $root.selectSearch.bind($data,'start')">
        <div class="logoContainer">
          <img class="defaultLogo" src="images/search.png"/>
        </div>
        <div class="textContainer">
          <p class="draggableText" data-bind="text: $root.lang().searchCompany"></p>
        </div>
      </div>

    </div>

  <!-- SELECT SAVED SEARCH -->
  <div id="savedSearch" data-bind="foreach: $root.currentSearches.values, visible: page() == 0 && status() == 0, css: { content: page() == 0}">
    <div class="draggable offer clickableOffers" data-bind="click: $root.loadComposeSearch.bind($data, $data.id())">
      <div class="draggableInfo" data-bind="attr: { 'title': $data.about() }">?</div>
      <div class="deleteOffer" data-bind="click: $root.doDeleteJSON.bind($data, $data), clickBubble: false">X</div>
      <div class="logoContainer">
        <!-- ko if: $data.logo() != '' -->
        <img class="defaultLogo" src="images/default.png" data-bind="attr: { 'src': './images/offers/' + $data.logo() + '.png' }"/>
        <!-- /ko -->
        <!-- ko if: $data.logo() == '' -->
        <img class="defaultLogo" src="images/default.png"/>
        <!-- /ko -->
      </div>
      <div class="textContainer">
        <p class="draggableText" data-bind="text: $data.name()"></p>
      </div>
    </div>

    <!-- ko if: $index() == 13 && $root.currentSearches.values().length > 14 -->
    <div class="offerButtonDIV">
      <a data-bind="click: $root.composeSearch">
        <div id="newOfferContainer">
        <div id="newOfferText"> <span data-bind="text: $parent.lang().g1"></span> </div>
        </div>
      </a>
      <div class="lines" id="Offerlines" data-bind="if: $root.page() == 0">
        <img class="img" data-bind="attr: { 'src': $root.lang().i2 }">
      </div>
    </div>
    <!-- /ko -->
    <!-- ko if: $index() == $root.currentSearches.values().length-1 && $root.currentSearches.values().length < 15 -->
    <div class="offerButtonDIV">
      <a data-bind="click: $root.composeSearch">
        <div id="newOfferContainer">
        <div id="newOfferText"> <span data-bind="text: $parent.lang().g1"></span> </div>
        </div>
      </a>
      <div class="lines" id="Offerlines" data-bind="if: $root.page() == 0">
        <img class="img" data-bind="attr: { 'src': $root.lang().i2 }">
      </div>
    </div>
    <!-- /ko -->
  </div>
  <!-- ko if: $root.currentSearches.values().length == 0 && page() == 0 && status() == 0-->
  <div class="offerButtonDIV">
      <a data-bind="click: $root.composeSearch">
        <div id="newOfferContainer">
        <div id="newOfferText"> <span data-bind="text: $root.lang().g1"></span> </div>
        </div>
      </a>
      <div class="lines" id="Offerlines" data-bind="if: $root.page() == 0">
        <img class="img" data-bind="attr: { 'src': $root.lang().i2 }">
      </div>
    </div>
  <!-- /ko -->

  <!-- SEARCH RESULT -->

  <div data-bind="foreach: filteredData, beforeRemove: hideElement, css: { content: page() == 1}">
    <!-- ko if: $root.page() == 1 && $root.option() == 1 -->
    <div id="draggable" class="draggable clickableCompanies semanticCompanies" data-bind="attr: { 'name': $data.name, 'province': $data.Province}">
      <div class="draggableInfo" data-bind="click: $root.activateHelp.bind($data,'company',''), clickBubble: false
           ,attr: { 'title': '<b>'+$data.name()+'</b>'}">?</div>
      <div class="companyMedal"></div>
      <div class="logoContainer" style="display:none">
        <!-- ko if: $data.logo != undefined -->
        <img class="defaultLogo" src="images/default.png" data-bind="attr: {src: $data.logo}"/>
        <!-- /ko -->
        <!-- ko if: $data.logo == undefined -->
        <img class="defaultLogo" src="images/default.png"/>
        <!-- /ko -->
      </div>
      <div class="textContainer">
        <p class="draggableText" data-bind="text: $data.name"></p>
      </div>
    </div>
    <!-- /ko -->
  </div>

  <!-- /SEARCH RESULT -->
  <!-- COMPANIES NETWORK RESULT -->
  <!-- self.option() == 0 para que salgan los cubitos; ESTOS SON LOS CUBITOS PRINCIPALES - OSCAR -->
  <div data-bind="foreach: filteredData, beforeRemove: hideElement, visible: page() == 1 && option() == 0, css: { content: page() == 1}">
    <!-- ko if: $root.page() == 1 && $root.option() == 0 -->
    <div id="draggable" class="draggable draggableCompanies semanticCompanies" data-bind="attr: { 'name': $data.name, 'province': $data.Province}">

      <div class="draggableInfo" data-bind="click: $root.activateHelp.bind($data,'company',''), clickBubble: false
           ,attr: { 'title': '<b>'+$data.name()+'</b><br>Similarity: '+$data.weight() }">?</div>
      
      <div class="companyMedal"></div>
      <div class="logoContainer">
        <!-- ko if: $data.logo != undefined -->
        <img class="defaultLogo" src="images/default.png" data-bind="attr: {src: $data.logo}"/>
        <!-- /ko -->
        <!-- ko if: $data.logo == undefined -->
        <img class="defaultLogo" src="images/default.png"/>
        <!-- /ko -->
      </div>
      <div class="textContainer">
        <p class="draggableText" data-bind="text: $data.name"></p>
      </div>
    </div>
    <!-- /ko -->
  </div>
  <!-- /COMPANIES NETWORK RESULT -->

  <div class="page_navigation" data-bind="visible: $root.viewData().length > 0"></div>
  <div class="page_navigation_text" data-bind="if: page() == 1">
    <span data-bind="visible: semanticOrder() == false && $root.viewData().length > 0 , text: lang().m6"></span>
    <span data-bind="visible: semanticOrder() == true && $root.viewData().length > 0, text: lang().m7"></span>
  </div>

  <div class="message" data-bind="visible: filteredData().length < 1 && filter() != '' && page() == '1'">
    <div class="med">
      <p>
        <span data-bind="text: lang().h1"></span>
        <b><span data-bind="text: filter"></span></b>
        <span data-bind="text: lang().h2"></span>
      </p><br>
      <p><span data-bind="text: lang().h3"></span></p><br>
      <ul>
        <li><span data-bind="text: lang().h4"></span></li>
        <li><span data-bind="text: lang().h5"></span></li>
        <li><span data-bind="text: lang().h6"></span></li>
      </ul>
    </div>
  </div>
  <div class="no-results message" data-bind="visible: filteredData().length < 1 && filter() == '' && page() == '1' && !$root.loading()">
    <div class="med">
      <p>
        <span data-bind="text: lang().h7"></span>
      </p><br>
      <a class="greenButton" data-bind="click: $root.changeFilters.bind($data, $root.currentEntity())">volver</a>
    </div>
  </div>

</div>
<div id="rightArrow" data-bind="visible: existPagination()">
  <a  class="nextBtn"  href="">
    <img id="rarrowIMG" src="images/rarrow.png" />
  </a>
</div>
</div>	




<!-- RECOMMENDED CONTAINER -->
<div class="recommended" data-bind="visible: !editionFinished() && $root.viewData().length > 0">
  <div class="lines" id="recommendedLines" data-bind="visible: page() == 1 && status() == 1">
      <p class="recommendedText" data-bind="text: lang().recommended "></p>
  </div>
  <div id="draggableElements" data-bind="visible: page() != 0 || status() != 1">
    <!-- RECOMMENDED RESULT -->
    <!-- ko foreach: $root.recommendedData -->
    <!-- ko if: $index() < 5 -->

      <div id="draggable" class="draggable draggableCompanies recommendedCompanies" data-bind="attr: { 'name': $data.name, 'province': $data.Province},css: { clickableRecommended: $root.option() == 1}">
        <div class="draggableInfo" data-bind="click: $root.activateHelp.bind($data,'company',''), clickBubble: false
           ,attr: { 'title': '<b>'+$data.name()+'</b><br>Ranking: '+$data.Ranking()}">?</div>
        <div class="companyMedal"></div>
        <div class="logoContainer">
          <!-- ko if: $data.logo != undefined -->
          <img class="defaultLogo" src="images/default.png" data-bind="attr: {src: $data.logo}"/>
          <!-- /ko -->
          <!-- ko if: $data.logo == undefined -->
          <img class="defaultLogo" src="images/default.png"/>
          <!-- /ko -->
        </div>
        <div class="textContainer">
          <p class="draggableText" data-bind="text: $data.name"></p>
        </div>
      </div>

    <!-- /ko -->
     <!-- /ko -->
    <!-- /RECOMMENDED RESULT -->
  </div>
</div>
<!-- /RECOMMENDED CONTAINER -->



<div data-bind="autoPaginate: filteredData"></div>
<div data-bind="autoPaginate: $root.currentSearches"></div>



</div>
<!-- /MAIN CONTAINER -->

<div id="footer">
            <p><span data-bind="text: lang().c1"></span></p>
		<a href="http://gsi.dit.upm.es/" target="_blank">
		<div class="gsiLogo" title="Grupo de Sistemas Inteligentes" ></div>
		</a>
		</a>
</div>

<div id="blackDIV" data-bind="visible: help()"></div>
<div id="blackCont" data-bind="visible: help(), click: activateHelp, clickBubble: false">
  <div id="blackMSG">
    <div id="blackText">
        <div data-bind="if: $root.helpText">
          <h1 data-bind="text: lang().m5b"></h1>
          <h2>1.-<span data-bind="text: $root.lang().k1"></h2><br>
          <p>dfjksagsfjklgjkl</p>
          <!--
          <h2>2.-<span data-bind="text: $root.lang().k2"></h2><br>
          <h2>3.-<span data-bind="text: $root.lang().k3"></h2><br>
          <h2>4.-<span data-bind="text: $root.lang().k4"></h2><br>
        -->
        </div>
        <!--CHANNEL DETAILS MODAL-->
        <div>
          <h1><span data-bind="text: $root.lang().channelHelp1"></span></h1>
          <div class="logoContainer">
            <!-- ko if: $data.logo != undefined -->
            <img class="defaultLogo" src="images/default.png" data-bind="attr: {src: $data.logo[0]()}"/>
            <!-- /ko -->
            <!-- ko if: $data.logo == undefined -->
            <img class="defaultLogo" src="images/default.png"/>
            <!-- /ko -->
          </div>
        </div>
        <div data-bind="foreach: offerDetails">
          <h1><span data-bind="text: $root.lang().b20"></h1>
          <div class="logoContainer">
          <!-- ko if: $data.logo != undefined -->
          <img class="defaultLogo" src="images/default.png" data-bind="attr: {src: '.'+$data.logo.value()}"/>
          <!-- /ko -->
          <!-- ko if: $data.logo == undefined -->
          <img class="defaultLogo" src="images/default.png"/>
          <!-- /ko -->
          </div>
          <h2><span data-bind="text: $root.lang().b6"></h2>
          <p><span data-bind="text: $data.name.value"></span></p>
          <h2><span data-bind="text: $root.lang().b13"></h2>
          <p><span data-bind="text: $data.detail.value"></span></p>
          <h2><span data-bind="text: $root.lang().b14"></h2>
          <p><span data-bind="text: $data.contractor.value"></span></p>
          <h2><span data-bind="text: $root.lang().b15"></h2>
          <p><span data-bind="text: $data.budget.value"></span></p>
          <h2><span data-bind="text: $root.lang().b16"></h2>
          <p><span data-bind="text: $data.address.value"></span></p>
          <h2><span data-bind="text: $root.lang().b17"></h2>
          <p><span data-bind="text: $data.beginDate.value"></span></p>
          <h2><span data-bind="text: $root.lang().b18"></h2>
          <p><span data-bind="text: $data.endDate.value"></span></p>
          <h2><span data-bind="text: $root.lang().b19"></h2>
	</div>
        <div data-bind="foreach: offerDetails">
        <table>
  	  <thead>
 	    <tr><th><span data-bind="text: $root.lang().b6"></th><th><span data-bind="text: $root.lang().b12"></th></tr>
  	  </thead>
  	  <tbody data-bind="foreach: $root.offerDetailsSkills">
   	    <tr>
       	     <td data-bind="text: $data.field.value"></td>
             <td data-bind="text: $data.weight.value"></td>
     	    </tr>
  	  </tbody>
	</table>
        </div>
        <!--COMPANY DETAILS MODAL-->
        <div data-bind="foreach: $root.companyDetails()">
          <h1><span data-bind="text: $root.lang().b21"></h1>
          <div class="logoContainer">
          <!-- ko if: $data.logo != undefined -->
          <img class="defaultLogo" src="images/default.png" data-bind="attr: {src: $data.logo.value()}"/>
          <!-- /ko -->
          <!-- ko if: $data.logo == undefined -->
          <img class="defaultLogo" src="images/default.png"/>
          <!-- /ko -->
          </div>
          <h2><span data-bind="text: $root.lang().b6"></h2>
          <p><span data-bind="text: $data.name.value"></span></p>
          <h2><span data-bind="text: $root.lang().b7"></h2>
          <p><span data-bind="text: $data.type.value"></span></p>
          <h2><span data-bind="text: $root.lang().b8"></h2>
          <p><span data-bind="text: $data.province.value"></span></p>
          <h2><span data-bind="text: $root.lang().b9"></h2>
          <p><span data-bind="text: $data.address.value"></span></p>
          <h2><span data-bind="text: $root.lang().b10"></h2>
          <p><span data-bind="text: $data.summary.value"></span></p>
          <h2><span data-bind="text: $root.lang().b11"></h2>
	</div>
        <div data-bind="foreach: companyDetails">
	<table>
  	  <thead>
 	    <tr><th><span data-bind="text: $root.lang().b6"></th><th><span data-bind="text: $root.lang().b12"></th></tr>
  	  </thead>
  	  <tbody data-bind="foreach: $root.companyDetailsSkills">
   	    <tr>
       	     <td data-bind="text: $data.skillname.value"></td>
             <td data-bind="text: $data.skilllevel.value"></td>
     	    </tr>
  	  </tbody>
	</table>
        </div>
    </div>
  </div>
</div>

<!--CONFIRM MODAL-->
<div id="confirmOverlay">
    <div id="confirmBox">

        <h1>Title of the confirm dialog</h1>
        <p>Description of what is about to happen</p>

        <div id="confirmButtons">
            <a class="button blue" href="#">Yes<span></span></a>
            <a class="button gray" href="#">No<span></span></a>
        </div>
    </div>
</div>

<!-- MODAL TRIGGER SELECTOR -->
<!-- ko if: selectingTrigger() -->
<div id="dialog-modal" data-bind="visible: false">
  <label class="triggerSelect">
  <select class="triggerSelect-box" data-bind="options: $root.selectedChannel(), value: $root.selectedTrigger, optionsCaption: '...', 
  optionsText: function (trigger){ return trigger['dcterms:title'] } "></select>
  </label>

  
  <!-- ko if: $root.selectedTrigger() != undefined -->
  <div data-bind="visible: $root.selectedTrigger()['@id']() != '' ">

    <div class="triggerBox">
      <p class="triggerEditor"><span style="font-weight: 900;" data-bind="text: $root.selectedTrigger()['dcterms:title']()"></span></p>
      <p class="triggerEditor"><span data-bind="text: $root.selectedTrigger()['dcterms:description']() "></span></p>
    </div>


      <!-- ko if: $root.selectedTrigger()['ewe:hasInputParameter'] != undefined && $root.selectedTrigger()['@type']() == 'ewe:Event' -->
      <p class="triggerEditor"><h5><span data-bind="text: $root.selectedTrigger()['ewe:hasInputParameter']['dcterms:title']() "></span></h5></p>
        <!-- ko if: $root.selectedTrigger()['ewe:hasInputParameter']['xsd:type']() == 'string_value' -->
        <p class="triggerEditor">  
          <input type="text" data-bind="value: $root.inputform.data ">
        </p>
        <!-- /ko -->
      <!-- /ko -->

      

  </div>
  <!-- /ko -->

</div>
<!-- ko if: $root.selectedTrigger() != undefined -->
<div id="dialog-output" data-bind="visible:false">
  <!-- ko if: $root.selectedLeftTrigger() && $root.selectingOutput() -->
      <div  data-bind="visible: $root.selectedLeftTrigger()">
        <div data-bind="foreach: $root.thenthatConfig['ewe:hasInputParameter']() ">
          <p class="triggerEditor" data-bind="text: $data['dcterms:title']() "></p>
          <!-- ko foreach: $root.ifthisConfig['ewe:hasOutputParameter']() -->
            <div class="triggerBox outputBox" data-bind="attr: {'id': 'outputBox' + $index()}, click: $root.selectedOutput.bind($data, $index())">
              <p class="triggerEditor"><span style="font-weight: 900;" data-bind="text: $data['dcterms:title']()"></span></p>
              <p class="triggerEditor"><span data-bind="text: $data['dcterms:description']() "></span></p>
            </div>
          <!-- /ko -->
          </div>
      </div>
      <!-- /ko -->

</div>
<!-- /ko -->


<!-- /ko -->

</body>

</html>





