function OnloadFunction() {
    //DRAGGABLE COMPANIES/OFFERS
    $(".draggableCompanies").draggable({
        revert: "invalid",
        helper: "clone",
        start: function (event, ui) {
            startAction($(ui.helper), $(this));
        },
        stop: function (event, ui) {
            stopAction($(ui.helper), $(this));
        }
    });
    //CLICKABLE COMPANIES
    $(".clickableCompanies").click(function() {
      clickAction($(this));
    });
    $(".clickableRecommended").click(function() {
      clickAction($(this));
    });
    //DROPPABLE COMPANIES 
    
    $(".droppableCompany").droppable({
        accept: ".draggable",
        drop: function (event, ui) {
            dropAction($(ui.helper), $(this), undefined);
            console.log("company drop");
        }
    });
    
    $(".droppableContainerLeft").droppable({
        accept: ".draggable",
        drop: function(event, ui)  {
            dropAction($(ui.helper), $(this), 'left');
            console.log("Container left drop")
        }
    });
    $(".droppableContainerRight").droppable({
        accept: ".draggable",
        drop: function(event, ui)  {
            dropAction($(ui.helper), $(this), 'right');
            console.log("Container right drop")
        }
    })

    $.each($('.droppableCompany'), function () {
        if ($(this).hasClass('stateDisabled')) {
            $(this).droppable("disable");
        } else {
            $(this).droppable("enable");
        }
    });
    //WHEN A COMPANY IS DROPPED CAN BE DRAGGED
    $(".draggableCompany").draggable({
        helper: "clone",
        start: function (event, ui) {
            $(ui.helper).css('box-shadow', ' 0 0 40px #999');
            $(ui.helper).css('z-index', '999');
            $(ui.helper).addClass("dragged");
        },
        stop: function (event, ui) {
            stopCompanyAction($(ui.helper), $(this));
        }
    });

    $(".draggableContainerLeft").draggable({
        helper: "clone",
        start: function (event, ui) {
            $(ui.helper).css('box-shadow', ' 0 0 40px #999');
            $(ui.helper).css('z-index', '999');
            $(ui.helper).addClass("dragged");
        },
        stop: function (event, ui) {
            console.log("dragged from left container");
            stopCompanyAction($(ui.helper), $(this), 'left');
        }
    });

    $(".draggableContainerRight").draggable({
        helper: "clone",
        start: function (event, ui) {
            $(ui.helper).css('box-shadow', ' 0 0 40px #999');
            $(ui.helper).css('z-index', '999');
            $(ui.helper).addClass("dragged");
        },
        stop: function (event, ui) {
            console.log("dragged from right container");
            stopCompanyAction($(ui.helper), $(this), 'right');
        }
    });

    $.each($('.draggableCompany'), function () {
        if ($(this).hasClass('stateDisabled')) {
            $(this).draggable("disable");
        } else {
            $(this).draggable("enable");
        }
    });
    //WHEN A COMPANY IS DRAGGED FROM DROPPABLE

    function stopCompanyAction($helper, $original, side) {
        var dropIndex = 0; //There is only one element in the array of containers
        if(side == 'left'){
            self.containerLeft.container()[dropIndex].containerName('');
            self.containerLeft.container()[dropIndex].containerLogo('');
            self.cleanConfiguration(self.ifthisConfig);
        }
        if(side == 'right'){
            self.containerRight.container()[dropIndex].containerName('');
            self.containerRight.container()[dropIndex].containerLogo('');
            self.cleanConfiguration(self.thenthatConfig);
        }
        /*
        self.currentSearch.result()[dropIndex].entityLogo('');
        self.currentSearch.changed('true');
        self.currentSearch.completed('false');
        $original.removeClass("draggableCompany");
        */
    }
    //WHEN A COMPANY IS DROPPED

    function dropAction($drag, $drop, side) {
        self.currentSearch.changed('true');
        var channelName = $drag.find('.draggableText').text()
        var channelLogo = $drag.find('.defaultLogo').attr('src');
        var dropIndex = 0; //There is only one element in the array of containers
        if(side == 'left'){
            self.containerLeft.container()[dropIndex].containerName(channelName);
            self.containerLeft.container()[dropIndex].containerLogo(channelLogo);
            self.selectingLeftTrigger(true);
            self.showTriggers(channelName, self.containerLeft.container()[dropIndex]);
        }if(side == 'right'){
            self.containerRight.container()[dropIndex].containerName(channelName);
            self.containerRight.container()[dropIndex].containerLogo(channelLogo);
            self.selectingRightTrigger(true);
            self.showTriggers(channelName, self.containerRight.container()[dropIndex]);
        }
        
        OnloadFunction();
        
        //var dropIndex = /*$drop.attr('index')*/index;
        /*
        self.currentSearch.result()[dropIndex].entityName(compName);
        self.currentSearch.result()[dropIndex].entityLogo(compLogo);
        */
        /*
        var nextEntity = $('.draggableEmpty').attr('index')
        if (nextEntity == undefined) {
            self.currentSearch.completed('true');
            finalizeModal(function (result) {
                if (result) {
                    sammyPlugin.trigger('redirectEvent', {
                        url_data: '#/finalize'
                    });
                } else {
                    OnloadFunction();
                }
            });
            return;
        }

        self.currentSearch.completed('false');
        sammyPlugin.trigger('redirectEvent', {
            url_data: '#/composer' + '/' + self.currentSearch.name() + '/entity/' + nextEntity
        });
        */
    }

    //WHEN A COMPANY IS CLICKED

    function clickAction($drag) {
        var compName = $drag.find('.draggableText').text()
        var compLogo = $drag.find('.defaultLogo').attr('src');
        self.currentSearch.result()[0].entityName(compName);
        self.currentSearch.result()[0].entityLogo(compLogo);

        sammyPlugin.trigger('redirectEvent', {
                        url_data: '#/finalize'
        });

    }
    
    //WHEN A COMPANY IS DRAGGED

    function startAction($helper, $original) {
        $helper.css('box-shadow', ' 0 0 40px #999');
        $helper.css('z-index', '999');
        $helper.addClass("dragged");
        storedOpacity = $original.css('opacity');
        $original.css('opacity', ' 0.5');
        $helper.find(".companyMedal").removeClass('gold').removeClass('silver').removeClass('bronze');
    }
    //WHEN A COMPANY IS RELEASED AND NOT DROPPED

    function stopAction($helper, $original) {
        $helper.css('box-shadow', ' 0 0 40px #999');
        $helper.css('z-index', '999');
        $helper.addClass("dragged");
        $original.css('opacity', storedOpacity);
    }
};
$(document).ready(OnloadFunction);
//RESET DROPPABLE COMPANY STATE

function resetDroppables() {
    self.semanticOrder(false);
    $.each($('.droppableCompany'), function () {
        $(this).removeClass('no_selected');
        $(this).removeClass('selected');
        $(this).animate({
            opacity: 1
        }, 20);
        if (!$(this).hasClass('draggableCompany')) $(this).droppable("enable");
    });
}
