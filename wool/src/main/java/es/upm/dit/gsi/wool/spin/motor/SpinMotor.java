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
package es.upm.dit.gsi.wool.spin.motor;

import java.util.Date;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Properties;
import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.PrintStream;
import java.lang.reflect.Field;

import org.drools.repository.utils.IOUtils;
import org.topbraid.spin.arq.ARQ2SPIN;
import org.topbraid.spin.arq.ARQFactory;
import org.topbraid.spin.inference.SPINInferences;
import org.topbraid.spin.model.Construct;
import org.topbraid.spin.system.SPINModuleRegistry;
import org.topbraid.spin.util.JenaUtil;
import org.topbraid.spin.vocabulary.SPIN;

import com.hp.hpl.jena.ontology.OntModel;
import com.hp.hpl.jena.ontology.OntModelSpec;
import com.hp.hpl.jena.ontology.OntResource;
import com.hp.hpl.jena.query.Query;
import com.hp.hpl.jena.rdf.model.Model;
import com.hp.hpl.jena.rdf.model.ModelFactory;
import com.hp.hpl.jena.rdf.model.Property;
import com.hp.hpl.jena.rdf.model.ResIterator;
import com.hp.hpl.jena.rdf.model.Resource;
import com.hp.hpl.jena.shared.ReificationStyle;
import com.hp.hpl.jena.vocabulary.DCTerms;
import com.hp.hpl.jena.vocabulary.RDF;
import com.sun.jersey.spi.resource.Singleton;

import es.upm.dit.gsi.DrEwe.Vocabulary.EWEChannels;

@Singleton
public class SpinMotor {
	private static SpinMotor MOTOR;
	private static Properties properties;
	private static int eventsInserted;
	private static OntModel ontModel;
	private static OntModel newOntModel;
	private static Model m_model = ModelFactory.createDefaultModel();
	
	public SpinMotor() {
	}
	
	// Maintains a Singleton pattern
	private static void createMotor() {
		if(MOTOR == null){
			// Keeps the singleton runnning
			MOTOR = new SpinMotor();
			
			// Dates the creation of the SPIN Motor
			Date date = new Date();
			String nowDate = date.toString();
			System.out.println("Creating Spin Motor: " + nowDate);
			
			properties = new Properties();
			eventsInserted = 0;
			try {
				// Gets the some data from the properties file (resources in Maven)
				properties.load(SpinMotor.class.getResourceAsStream("/SPIN.properties"));
				String url = properties.getProperty("ewe-ontology");
				
				// Initialize system functions and templates
				SPINModuleRegistry.get().init();
				
				// Load main file
				System.out.println("Loading ontology from: " + url);
				Model baseModel = ModelFactory.createDefaultModel(ReificationStyle.Minimal);
				baseModel.read(url);
				
				// Create OntModel with imports
				ontModel = JenaUtil.createOntologyModel(OntModelSpec.OWL_MEM,baseModel);
				
				// Load init rule
				loadInitRule();
				
				
				// Create and add Model for inferred triples
				Model OntModel = ModelFactory.createDefaultModel(ReificationStyle.Minimal);
				newOntModel = JenaUtil.createOntologyModel(OntModelSpec.OWL_MEM, OntModel);
				
				// Sets the name spaces that will be places into the RDF of the inferred triples
				// as: "xmlns:dcterms" and "xmlns:ewe.channels"
				newOntModel.setNsPrefix("dcterms", DCTerms.NS);
				newOntModel.setNsPrefix("ewe.channels", EWEChannels.NS);
				
				ontModel.addSubModel(newOntModel);
				
				// Register locally defined functions
				SPINModuleRegistry.get().registerAll(ontModel, null);
				
				// Insert event and run init inferences
				System.out.println("Inserting init event");
				insertInitEvent();
//				System.out.println("Running init inferences");
//				runInferences();
				
				
				
				
				return;
			} catch (Exception ex) {
				ex.printStackTrace();
			}
		}
		System.out.println("The SPIN Motor has been already created");
	}
	
	/**
	 * <p></p>
	 * 
	 * @param 
	 * @param
	 * 
	 */
	public static String insertEvent(String event, HashMap<String, String> parameters) {
		createMotor();
		
		System.out.println("Inserting new event: " + event);
		
		//Creates the resource using the event that is being inserted
		Resource newEvent = ontModel.createResource(event);
//		
		Iterator<String> iteratorKey = parameters.keySet().iterator();		
		try {
			/* 
			 * Reflects the EWEIfttt fields, searching for the fields that are
			 * Property -Property class is from the Jena API- 
			 */
			Field[] fields = EWEChannels.class.getDeclaredFields();
			while(iteratorKey.hasNext()) {
				String parameter = iteratorKey.next();
				System.out.println("The key is: " + parameter);
				System.out.println("The value is :" + parameters.get(parameter));
		    	for (Field field : fields) {
		    		if(field.getType().getSimpleName().equals("Property")) {
		    			// If the field is a Property, downcasts the object into a Property
		    			Object property = field.get(EWEChannels.class);
		    			Property pro = (Property) property;
		    			String localName = pro.getLocalName();
		    			if (parameter.equals(localName)) {
		    				// If the parameter name is equal to the parameter to be added,
		    				// adds the parameter into the event
		    				System.out.println("Adding to " + pro.getLocalName() + " the parameter <" + parameters.get(parameter) + ">");
		    				newEvent.addProperty(pro, parameters.get(parameter));
		    			}
		    		}
		    	}	
		    }
		} catch (Exception ex) {
			ex.printStackTrace();
			return null;
		}
		
		// Adds the event into the ontology model
		newEvent.addProperty(RDF.type, ontModel.getResource(event));
		
		// Run inferences to test if the rule works 
		runInferences();
		long newTriples = newOntModel.size();

		ByteArrayOutputStream baos = new ByteArrayOutputStream();
		PrintStream ps = new PrintStream(baos);
		PrintStream ontoRDF = System.out;
		System.setOut(ps);
		newOntModel.write(System.out, "RDF/XML-ABBREV");
		System.out.flush();
		System.setOut(ontoRDF);
		String actionsXML = baos.toString();
		
		// Removes the event from the ontology model
		newEvent.removeProperties();
		ontModel.remove(newEvent, RDF.type, ontModel.getResource(event));
		// Removes all the resources form the ontology that is used for the inferences
		newOntModel.removeAll();
		
		// Rerun the inferences. The result must be only the init action
		runInferences();
		long standardTriple = newOntModel.size();
		
		long checkTest = newTriples - standardTriple;
		
		eventsInserted++;
		
		if(checkTest > 0) {
			System.out.println("------> The event has triggered actions");
			return actionsXML; 
		}		
		System.out.println("------> ERROR. The event has not triggered anny action");
		return null;
	}
	
	/*
	 *  Checks the status of the SPIN Motor
	 */
	public static boolean checkMotor() {
		getMOTOR();
		System.out.println("Running check inferences");
		newOntModel.removeAll();
		runInferences();
		long checkTriples = newOntModel.size();
		if(checkTriples > 0) {
			System.out.println("SPIN Motor is running normally");
			return true;
		}
		return false;
	}
	
	public static boolean insertNewRule(String rule) {
		System.out.println("Loading new received rule");
		SpinMotor.loadRule(rule);
		
		System.out.println("Inserting test event");
		boolean result = SpinMotor.insertTestEvent(rule);
		
		return result;
	}
	
	private static void loadInitRule() {
		try {
			// Gets the init rule 
			String initRule = getInitRule();
			
			System.out.println("Loading init rule");
			
			loadRule(initRule);
			
			System.out.println("Init rule loaded");
			
		} catch (Exception ex) {
			ex.printStackTrace();
		}
	}
	
	protected static void loadRule(String rule) {
		String eventsNs = properties.getProperty("events-ns");
		Resource originalEvent = ontModel.getResource(eventsNs);
		
		System.out.println("Loading rule: \n------------------------ \n" + rule + "\n------------------------");
		
		Query arqQuery = ARQFactory.get().createQuery(ontModel, rule);
		ARQ2SPIN arq2SPIN = new ARQ2SPIN(ontModel);
		Construct spinQuery=(Construct)arq2SPIN.createQuery(arqQuery, null);
		originalEvent.addProperty((Property)SPIN.rule,spinQuery);
		
		System.out.println("Rule has been loaded");
	}
	
	private static void insertInitEvent() {
		try {
			m_model = ModelFactory.createDefaultModel();
			
			// Gets the init rule from resources file
			String initRule = getInitRule();
			
			// Gets the namespace of the event 
			String event_ns = getEvent(initRule);
			
			// Creates the resource using the event namespace
			Resource myEvent = ontModel.createResource(event_ns);
			
			// Add the properties of the resource (event)
			myEvent.addProperty(EWEChannels.Fullname, "Oscar Araque");
			
			// Adds the event into the ontology model
			myEvent.addProperty(RDF.type, ontModel.getResource(event_ns));
//			myEvent.addProperty(RDF.type, ontModel.getResource("http://gsi.dit.upm.es/ontologies/ewe/ns/EEvent"));
			
			// Run the inferences once the init event resource has been added in the ontology 
			runInferences();
			
//			myEvent.removeAll(RDF.type);
			
			eventsInserted++;
		}catch (Exception ex) {
			ex.printStackTrace();
		}
		
		
		
	}
	
	// Inserts a test event when a new rule has been loaded
	public static boolean insertTestEvent(String rule) {
		// Gets the namespace of the event 
		String event_ns = getEvent(rule);
		
		// Creates the resource using the event namespace
		Resource myEvent = ontModel.createResource(event_ns);
		
		// Adds the event parameter. This is event is a test, so also is the parameter
		String parameter = getParameter(rule);
		String testParam = "test parameter";
		Property propertyToDelete = null;
		try {
			/* 
			 * Reflects the EWEIfttt fields, searching for the fields that are
			 * Property -Property class is from the Jena API- 
			 */
			Field[] fields = EWEChannels.class.getDeclaredFields();
	    	for (Field field : fields) {
	    		if(field.getType().getSimpleName().equals("Property")) {
	    			// If the field is a Property, downcasts the object into a Property
	    			Object property = field.get(EWEChannels.class);
	    			Property pro = (Property) property;
	    			String localName = pro.getLocalName();
	    			if (parameter.equals(localName)) {
	    				// If the parameter name is equal to the parameter to be added,
	    				// adds the parameter into the event
	    				System.out.println("Adding to " + pro.getLocalName() + " the parameter <" + testParam + ">");
	    				myEvent.addProperty(pro, testParam);
	    				propertyToDelete = pro;
	    			}
	    		}
	    	}
		} catch (Exception ex) {
			ex.printStackTrace();
			return false;
		}
		
		// Adds the event into the ontology model
		myEvent.addProperty(RDF.type, ontModel.getResource(event_ns));
		
		// Run inferences to test if the rule works 
		runInferences();
		long newTriples = newOntModel.size();
		
		// Removes the event from the ontology model
		myEvent.removeProperties();
		ontModel.removeAll(myEvent, RDF.type, ontModel.getResource(event_ns));
		ontModel.removeAll(myEvent, propertyToDelete, ontModel.getResource(event_ns));
		// Removes all the resources form the ontology that is used for the inferences
		newOntModel.removeAll();
		
		// Rerun the inferences. The result must be only the init action
		runInferences();
		long standardTriple = newOntModel.size();
		
		long checkTest = newTriples - standardTriple;
		
		eventsInserted++;
		
		if(checkTest > 0) {
			System.out.println("------> Rule has been successfully inserted into the motor");
			return true; 
		}		
		System.out.println("------> ERROR. Rule has NOT been inserted into the motor");
		return false;
	}
	// Run inferences when a event has been inserted
	private static void runInferences(){
		SPINInferences.run(ontModel, newOntModel, null, null, false, null);
		System.out.println("Inferred triples: " + newOntModel.size()+"\n========================");
		newOntModel.write(System.out,"RDF/XML-ABBREV");
		System.out.println("========================");
		
	}
	

	
	/* 
	* 	Gets the namespace of the event type 
	*/
	private static String getEvent(String rule) {
		// Defines the boundaries of the event namespace
		int begin = rule.indexOf("?event a <");
		int end = rule.indexOf("> .", begin);
		int usefulBegin = rule.indexOf("<", begin) + 1;
		
		// Gets the event namespace from the rule
		String event = rule.substring(usefulBegin, end);
		System.out.println("Event namespace is: " + event);
		
		return event;
	}
	
	/*
	 * Gets the parameter from a rule 
	 */
	private static String getParameter(String rule) {
		// Defines the boundaries of the parameter uri
		int begin = rule.indexOf("?event <");
		int end = rule.indexOf("> ", begin);
		int usefulBegin = rule.indexOf("<", begin) + 1;
		
		// Gets the parameter uri type from the rule
		String parameterUri = rule.substring(usefulBegin, end);
		
		
		// Gets the parameter type from the parameter uri
		int paramBegin = parameterUri.indexOf("ns/") + 3;
		String parameter = parameterUri.substring(paramBegin);
		System.out.println("Parameter is: " +  parameter);
		
		return parameter;
	}
	
	private static String getInitRule() {
		try {
			String ruleFile = properties.getProperty("spin-rules");
			InputStream stream = SpinMotor.class.getResourceAsStream(ruleFile);
			String initRule = IOUtils.toString(stream, "UTF-8");
			return initRule;
		} catch (Exception ex) {
			ex.printStackTrace();
		}
		return null;
	}

	public static SpinMotor getMOTOR() {
		createMotor();
		return MOTOR;
	}

	public static void setMOTOR(SpinMotor mOTOR) {
		MOTOR = mOTOR;
	}

	public Properties getProperties() {
		return properties;
	}

	public void setProperties(Properties properties) {
		this.properties = properties;
	}

	public int getEventsInserted() {
		return eventsInserted;
	}

	public void setEventsInserted(int eventsInserted) {
		this.eventsInserted = eventsInserted;
	}

	public OntModel getOntModel() {
		return ontModel;
	}

	public void setOntModel(OntModel ontModel) {
		this.ontModel = ontModel;
	}

	public OntModel getNewOntModel() {
		return newOntModel;
	}

	public void setNewOntModel(OntModel newOntModel) {
		this.newOntModel = newOntModel;
	}
		
		
	
	

}
