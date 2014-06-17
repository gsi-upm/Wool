//package es.upm.dit.gsi.wool.spin.motor;
//
//import java.util.ArrayList;
//
//import com.hp.hpl.jena.ontology.OntModel;
//import com.sun.jersey.spi.resource.Singleton;
//
//import es.upm.dit.gsi.DrEwe.Beans.SPINEvent;
//import es.upm.dit.gsi.DrEwe.SPIN.SPINModule;
//
//@Singleton
//public class SpinMotor {
//
//	private static SpinMotor MOTOR;
//	private static SPINModule spinModule;
//	private static ArrayList<String> deployedRules;
//	
//	public SpinMotor() {
//	}
//	
//	private static void createMotor() {
//		if(MOTOR == null) {
//			System.out.println("Creating SPIN motor");
//			MOTOR = new SpinMotor();
//			System.out.println("We have a new SPIN Motor");
//			spinModule = new SPINModule();
//			MOTOR.setSpinModule(spinModule);
//			System.out.println("The motor has now a SPINModule");
//			OntModel ontmodel=MOTOR.getSpinModule().getOntModel();
//			boolean isEmpty=ontmodel.isEmpty();
//			if(isEmpty){
//				System.out.println("ERROR. Empty ontologies");
//			}
//			System.out.println("SPIN Module has ontology model");
//			deployedRules = new ArrayList<String>();
//			return;
//			
//		}
//		System.out.println("The motor has been already created");
//	}
//	
//	public boolean insertRule(String rule, String eventTitle, String eventDescription){
//		System.out.println("-- Inserting rule");
//		System.out.println(rule);
//		spinModule.loadRules(rule);
//		
//		System.out.println("-- Inserting new event");
//		SPINEvent event=new SPINEvent(eventTitle, eventDescription);
//		spinModule.insertEvent(event);
//		long triples = spinModule.runInferences();
//		if(triples < 1) {
//			System.out.println("SpinMotor: No new triples inferred.");
//			return false;
//		}
//		System.out.println("Adding rule to deployment list");
//		deployedRules.add(rule);
//		deployedRules.add("regla de prueba");
//		System.out.println("Rule added to deployment list: "+ deployedRules.toString());
//		return true;
//	}
//	
//
//	
//	 public static SpinMotor getMotor() {
//		 createMotor();
//		 return MOTOR;
//	 }
//
//	public SPINModule getSpinModule() {
//		return spinModule;
//	}
//
//	public void setSpinModule(SPINModule spinModule) {
//		this.spinModule = spinModule;
//	}
//
//	public ArrayList<String> getDeployedRules() {
//		return deployedRules;
//	}
//
//	public static void setDeployedRules(ArrayList<String> deployedRules) {
//		SpinMotor.deployedRules = deployedRules;
//	}
//	
//
//}
