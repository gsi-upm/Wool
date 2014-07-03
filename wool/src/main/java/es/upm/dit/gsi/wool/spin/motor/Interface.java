package es.upm.dit.gsi.wool.spin.motor;

import java.util.ArrayList;
import java.util.HashMap;

import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.json.JSONArray;
import org.w3c.dom.Document;

import es.upm.dit.gsi.wool.spin.motor.Response;

@Path("/motor")
public class Interface {
	
	//private SpinMotor spinMotor = new SpinMotor();
	
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	@Path("/status")
	public Response hello() {
		Response response = new Response();
		
		boolean test = SpinMotor.checkMotor();
		if(test) {
			response.setStatus("OK");
			response.setDescription("SPIN Motor is running normally");
			return response;
		} else {
			response.setStatus("WARNING");
			response.setDescription("SPIN Motor is NOT running normally");
			return response;
		}
		
		
	}
	
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	@Path("/rules")
	public Response getRules() {
		Response response = new Response();
//		ArrayList<String> arrayRules = spinMotor.getDeployedRules();
		
		
		response.setStatus("OK");
		response.setDescription("Array of deployed rules");
//		response.setRules(arrayRules);		
		return response;
	}
	
	@POST
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes
	public Response post(@FormParam("type") String type, @FormParam("sentence")String sparql,
			@FormParam("event_title") String eventTitle, @FormParam("event_description") String eventDescription) {
		Response response = new Response();
		
		if(!type.equals("SPARQL")) {
			response.setStatus("SPIN Motor ERROR.");
			response.setDescription("The type of the request parameter is not SPARQL");
			return response;
		}
		
		try {
			SpinMotor spinMotor = SpinMotor.getMOTOR();
			
			boolean result = SpinMotor.insertNewRule(sparql);
			
			if(!result) {
				response.setStatus("SPIN Motore Error: RULE ERROR");
				response.setDescription("The rule is not valid. It has not been included into SPIN Motor");
				return response;
			}
		} catch (Exception e) {
			e.printStackTrace();
			response.setStatus("RULE EXCEPTION");
			response.setDescription("The rule is not valid. It has not been included into SPIN Motor");
			return response;
		}
			
		response.setStatus("OK");
		response.setDescription("Succes inserting the rule into SPIN Motor.");
		return response;
	}
	
	@POST
	@Produces(MediaType.APPLICATION_JSON)
	@Path("/event")
	@Consumes
	public Response event(@FormParam("type") String type, @FormParam("event") String event,
			@FormParam("param1")String param1, @FormParam("param1value")String param1value,
			@FormParam("param2")String param2, @FormParam("param2value")String param2value,
			@FormParam("param3")String param3, @FormParam("param3value")String param3value) {
		Response response = new Response();
		if(!type.equals("ewe:event")) {
			response.setStatus("SPIN Motor ERROR");
			response.setDescription("Type not valid for an event");
			return response;
		}
		
		HashMap<String, String> map = new HashMap<String, String>();
		if(param1 != null) {
			map.put(param1, param1value);
		} if(param2 != null) {
			map.put(param2, param2value);
		} if(param3 != null) {
			map.put(param3, param3value);
		}
		
		
		String result = SpinMotor.insertEvent(event, map);
		response.setDescription(result);
		return response;
	}
	
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	@Path("/test")
	public Response testevent() {
		Response response = new Response();
		
		String event = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Time";
		
		HashMap<String, String> map = new HashMap<String, String>();
		map.put("Message", "test added by Oscar Araque");
		
		String result = SpinMotor.insertEvent(event, map);
		response.setStatus("OK");
		response.setDescription(result);
		return response;
	}
	
}
