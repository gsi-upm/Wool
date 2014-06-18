package es.upm.dit.gsi.wool.spin.motor;

import java.util.ArrayList;

import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.json.JSONArray;

import es.upm.dit.gsi.wool.spin.motor.Response;
import es.upm.dit.gsi.DrEwe.SPIN.SpinMotor;

@Path("/motor")
public class Interface {
	
	//private SpinMotor spinMotor = new SpinMotor();
	
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	public Response hello() {
		Response response = new Response();
		
//		SpinMotor.getMOTOR();
		
		response.setStatus("OK");
		response.setDescription("Everything is OK");
		return response;
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
}
