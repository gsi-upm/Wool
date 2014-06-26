$(function() {
	function AppViewModel() {
	self=this;
	// self.test = ko.observable('');
    self.outputMessage = ko.observable('');
    self.formAlert = ko.observable(false);
    self.n_outputs = ko.observable('');

    // self.light = ko.observable(false);
    self.dni = ko.observable('');
    self.tvText = ko.observable('');
    self.botText = ko.observable('');

    self.newAction = ko.mapping.fromJS({});
    self.interval = null;

    // URIs form EWE
    self.Message = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Message";
    self.lightURI = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/GSILight";
    self.dniURI = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/eDNI";

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

    self.lightOn = function(on) {
        if(on) {
            $("#map").removeClass("mapGSIOf").addClass("mapGSIOn");

        } else {
            $("#map").removeClass("mapGSIOn").addClass("mapGSIOff");
        }
    }

    self.dniEntered = function(n_dni) {
        console.log("DNI: "+n_dni)
        self.dni(n_dni);
        $(".dni").fadeIn();
    }

    self.tvMessage = function(message) {    
        self.tvText(message);
        $(".tv").fadeIn();
        // $('');
    }

    self.bot = function(message) {
        self.botText(message);
        $(".bot").fadeIn();
    }

    self.fadeOut = function() {
        $("#dni").fadeOut();
        $(".tv").fadeOut();
        $(".bot").fadeOut();
        $(".dni").fadeOut();
        self.lightOn(false);
        self.outputMessage('');
        self.n_outputs('');
        clearInterval(self.interval);
    }

    self.newActionTriggered = function(actions) {
        var nActions = Object.keys(actions).length;
        var actionsToTrigger = {};

        for (var i = 1; i < nActions+1; i++) {
            var actionID = actions[i]['@type'][0];
            var message = false;
            for(property in actions[i]) {
                if(property == self.Message) {
                    message = true;
                }
            }
            switch(actionID) {
                case "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/TV":
                    console.log("TV has triggered");
                    if(message) {
                        var property = actions[i][self.Message][0]['@value'];
                        self.tvMessage(property);
                    } else {
                        self.tvMessage('GSI');
                    }
                break;
                case "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/GSIBot":
                    console.log("GSIBot has triggered");
                    if(message) {
                        var property = actions[i][self.Message][0]['@value'];
                        self.bot(property);
                    } else {
                        self.bot("Hello!");
                    }
                break;
            }
        };
        self.interval = setInterval(function(){
            console.log("Interval expired");
            self.fadeOut();
        }, 3000);
    }

    self.triggerEvent = function(id, n_outputs) {
        var dniEvent = false;
        switch(id) {
            case self.lightURI:
                self.lightOn(true);
            break;
            case self.dniURI: 
                dniEvent = true;
            break;
        }


        console.log("Event triggered: " + id + " with " + n_outputs + " outputs");
        self.n_outputs(n_outputs);

        if(n_outputs >= 1) {
            $("#dialog-event").dialog({
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
                        if(self.outputMessage() == ''){
                            self.formAlert(true);
                            return;
                        }
                        self.formAlert(false);
                        if(dniEvent) {
                            self.dniEntered(self.outputMessage());
                        }
                        self.sendEvent(id, n_outputs);
                        $(this).dialog("close");
                    }
                }]
            });
        } else {
            self.sendEvent(id, n_outputs);
        } 
    }

    self.sendEvent = function(id, n_outputs) {
        var data = {};
        data['eventURI'] = id;
        data['n_outputs'] = n_outputs;
        data['params'] = {};
        for (var i = 0; i < n_outputs; i++) {
            data['params'][i] = {};
            data['params'][i]['type'] = "Message";
            data['params'][i]['value'] = self.outputMessage();
        }

        eventJSON = JSON.stringify(data);
        console.log(data);
        $.ajax({
                type: 'post',
                url: triggerEventEndPoint,
                data: eventJSON,
                dataType: 'json',
                ContentType: 'text/html; charset=UTF-8',
                success: function(data) {
                    console.log(data)
                    // var action =
                    ko.mapping.fromJS(data, self.newAction);

                    self.newActionTriggered(data);


                }
        });
    }

    $(".dni").hide();
    $(".tv").hide();
    $(".bot").hide();

}

ko.applyBindings(new AppViewModel());
});