$(function() {
	function AppViewModel() {
	self=this;
	self.test = ko.observable('');



	self.showCredits = function() {
		$("#dialog-modal").dialog({
                modal: true,
                draggable: false,
                resizable: false,
                autoReposition: true,
                show: { effect: 'clip', duration: 500 },
                hide: { effect: 'slideUp', duration: 500 },
                title: "Wool - GSI UPM",
                width: 400, 
                buttons: [{
                	text: "Ok",
                	click: function() {
                		$(this).dialog("close");
                	}
                }]
            });
	}

}

ko.applyBindings(new AppViewModel());
});

