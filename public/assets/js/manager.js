/*
   Copyright 2014 Oscar Araque Iborra | Grupo de Sistemas Inteligentes (GSI)
                                                  DIT UPM

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */
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
    self.propertyString = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/String";
    self.lightURI = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/GSILight";
    self.dniURI = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/eDNI";
    self.clockURI = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Time";
    self.twitterNewFollowerURI = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewFollower";

    // Twitter new followers
    self.newFollowers = ['@telecoupm', '@gsiupm', '@La_UPM', '@dat_etsit', '@DIT_ETSIT_UPM'];

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
        $("#warning").fadeOut();
        self.lightOn(false);
        self.outputMessage('');
        self.n_outputs('');
        clearInterval(self.interval);
    }

    self.newActionTriggered = function(actions) {
        // var nActions = Object.keys(actions).length;
        var actionsToTrigger = {};

        for(i in actions) {
            var actionID = actions[i]['@type'][0];
            var message = false;
            var propertyString = false;
            for(property in actions[i]) {
                if(property == self.Message) {
                    message = true;
                }
                if(property == self.propertyString) {
                    propertyString = true;
                }
            }
            switch(actionID) {
                case "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/TV":
                    console.log("TV has triggered");
                    if(message) {
                        var property = actions[i][self.Message][0]['@value'];
                        self.tvMessage(property);
                    } else if(propertyString) {
                        var property = actions[i][self.propertyString][0]['@value'];
                        self.tvMessage(property);
                    } 
                    else {
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
        }
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

        switch(id) {
            case self.clockURI:
                var date = new Date();
                var time = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                self.outputMessage(time);
                self.sendEvent(id, n_outputs);
                return;
            break;
            case self.twitterNewFollowerURI:
                var arrayLength = self.newFollowers.length;
                var randomIndex = Math.floor(Math.random()*arrayLength);
                var message = self.newFollowers[randomIndex] + "\n has started following you!";
                self.outputMessage(message);
                self.sendEvent(id, n_outputs);
                return;
            break;
        }

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
                    if(data['status'] != undefined) {
                        $("#warning").fadeIn();
                        self.interval = setInterval(function(){
                            console.log("Interval expired");
                            self.fadeOut();
                        }, 3000);
                        return;
                    }

                    self.newActionTriggered(data);


                }
        });
    }

    $(".dni").hide();
    $(".tv").hide();
    $(".bot").hide();
    $("#warning").hide();

}

ko.applyBindings(new AppViewModel());
});
