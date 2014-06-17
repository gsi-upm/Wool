//package es.upm.dit.gsi.DrEwe.SPIN;
//
//import java.io.BufferedReader;
//import java.io.FileInputStream;
//import java.io.FileReader;
//import java.io.IOException;
//import java.util.Properties;
//
//import org.topbraid.spin.arq.ARQ2SPIN;
//import org.topbraid.spin.arq.ARQFactory;
//import org.topbraid.spin.inference.SPINInferences;
//import org.topbraid.spin.model.Construct;
//import org.topbraid.spin.system.SPINModuleRegistry;
//import org.topbraid.spin.util.JenaUtil;
//import org.topbraid.spin.vocabulary.SPIN;
//
//import com.hp.hpl.jena.ontology.OntModel;
//import com.hp.hpl.jena.ontology.OntModelSpec;
//import com.hp.hpl.jena.ontology.OntResource;
//import com.hp.hpl.jena.query.Query;
//import com.hp.hpl.jena.rdf.model.Model;
//import com.hp.hpl.jena.rdf.model.ModelFactory;
//import com.hp.hpl.jena.rdf.model.Property;
//import com.hp.hpl.jena.rdf.model.ResIterator;
//import com.hp.hpl.jena.rdf.model.Resource;
//import com.hp.hpl.jena.shared.ReificationStyle;
//import com.hp.hpl.jena.vocabulary.DCTerms;
//import com.hp.hpl.jena.vocabulary.RDF;
//
//import es.upm.dit.gsi.DrEwe.Beans.EweAction;
//import es.upm.dit.gsi.DrEwe.Beans.SPINEvent;
//import es.upm.dit.gsi.DrEwe.Vocabulary.EWEIfttt;
//
//public class SPINModule {
//
//	private OntModel ontModel;
//	private int eventsInserted;
//	private Properties prop;
//	private OntModel newTriples;
//	private static Model m_model = ModelFactory.createDefaultModel();
//	public static final Property ewe_output = m_model.createProperty( "http://purl.org/ewe/hasOutputParameter" );
//	public static final Property ewe_value = m_model.createProperty( "http://purl.org/ewe/hasValue" );
//
//	public SPINModule() {
//		super();
//		this.eventsInserted=0;
//		this.prop=new Properties();
//		try{
//			this.prop.load(new FileInputStream("conf/SPIN.properties"));
//			String url=this.prop.getProperty("ewe-ontology");
//			// Initialize system functions and templates
//			SPINModuleRegistry.get().init();
//			// Load main file
//			Model baseModel = ModelFactory.createDefaultModel(ReificationStyle.Minimal);
//			System.out.println("Loading ontology from: "+url);
//			baseModel.read(url);
//
//			// Create OntModel with imports
//			this.ontModel = JenaUtil.createOntologyModel(OntModelSpec.OWL_MEM,baseModel);
//
//			this.loadRules();
//
//			Model newTriplesModel = ModelFactory.createDefaultModel(ReificationStyle.Minimal);
//			this.newTriples=JenaUtil.createOntologyModel(OntModelSpec.OWL_MEM,newTriplesModel);
//			this.newTriples.setNsPrefix("dcterms",DCTerms.NS);
//			this.ontModel.addSubModel(newTriples);
//
//			// Register locally defined functions
//			SPINModuleRegistry.get().registerAll(ontModel, null);
//
//		} catch(IOException ex){
//			ex.printStackTrace();
//		}
//
//	}
//	public SPINModule(OntModel ontModel,int eventsInserted, Properties prop) {
//		super();
//
//		this.eventsInserted=eventsInserted;
//		this.ontModel = ontModel;
//		this.prop=prop;
//	}
//	public void insertEvent(SPINEvent event){
//		String title=event.getTitle();
//		String description=event.getDescription();
//		eventsInserted++;
//		String eventsNs=this.prop.getProperty("events-ns");
//		Resource myEvent=this.ontModel.createResource(eventsNs+"_"+this.eventsInserted);
//		
//		myEvent.addProperty(DCTerms.title, title);
//		myEvent.addProperty(DCTerms.description, description);
//		
//		m_model = ModelFactory.createDefaultModel();
//		myEvent.addProperty(EWEIfttt.Fullname, "Miguel Coronado");
//
//		System.out.println("Inserting event: "+title+" , "+description);
//
//		
//		myEvent.addProperty(RDF.type, ontModel.getResource(eventsNs));
//
//
//	}
//
//	public void insertEventMail(String description, String title, String bodyOutput){
//		eventsInserted++;
//		String eventsNs=this.prop.getProperty("events-ns");
//		Resource myEvent=this.ontModel.createResource(eventsNs+"_"+this.eventsInserted);
//		
//		myEvent.addProperty(DCTerms.title, title);
//		myEvent.addProperty(DCTerms.description, description);
//		eventsInserted++;
//		Resource myOutput=this.ontModel.createResource(eventsNs + "_" + this.eventsInserted);
//		myOutput.addProperty(DCTerms.title, "BodyPlain");
//		myOutput.addProperty(ewe_value, bodyOutput);
//		myEvent.addProperty(ewe_output, myOutput.toString());
//		System.out.println("Inserting event: "+title+" , "+description);
//
//		myEvent.addProperty(RDF.type, ontModel.getResource(eventsNs));
//
//	}
//
//	private void loadRules(){
//
//		try{
//
//			String eventsNs=this.prop.getProperty("events-ns");
//			Resource originalEvent=this.ontModel.getResource(eventsNs);
//
//			String st=readFileAsString(this.prop.getProperty("spin-rules"));
//
//			String[] rules=st.split("-+");
//			System.out.println(rules.length+" rules detected");
//			for(String query : rules){
//				Query arqQuery = ARQFactory.get().createQuery(this.ontModel, query);
//				ARQ2SPIN arq2SPIN = new ARQ2SPIN(this.ontModel);
//				Construct spinQuery=(Construct)arq2SPIN.createQuery(arqQuery, null);
//				originalEvent.addProperty((Property)SPIN.rule,spinQuery);
//			}
//
//		} catch(IOException ex){
//			ex.printStackTrace();
//		}
//
//	}
//	private static String readFileAsString(String filePath) throws IOException {
//		StringBuffer fileData = new StringBuffer();
//		BufferedReader reader = new BufferedReader(
//				new FileReader(filePath));
//		char[] buf = new char[1024];
//		int numRead=0;
//		while((numRead=reader.read(buf)) != -1){
//			String readData = String.valueOf(buf, 0, numRead);
//			fileData.append(readData);
//		}
//		reader.close();
//		//System.out.println("Readed: \n"+fileData.toString());
//		return fileData.toString();
//	}
//
//	public void runInferences(){
//		SPINInferences.run(this.ontModel, this.newTriples, null, null, false, null);
//		System.out.println("Inferred triples: " + this.newTriples.size()+"    ------------------------");
//		this.newTriples.write(System.out,"RDF/XML-ABBREV");
//	}
//
//	public void checkActions(){
//
//		
//		ResIterator iter = this.newTriples.listResourcesWithProperty(DCTerms.title);
//		
//		if (iter.hasNext()) {
//
//			while (iter.hasNext()) {
//				Resource parent= iter.nextResource();
//				
//				String actionTitle=parent.getRequiredProperty(DCTerms.title).getString();
//				String actionDescription=parent.getRequiredProperty(DCTerms.description).getString();
//				EweAction action=new EweAction(actionTitle,actionDescription);
//				action.execute();
//				//remove action from model
//				OntResource ontParent=this.newTriples.getOntResource(parent);
//				ontParent.remove();
//				
//				this.newTriples.write(System.out);
//
//
//			}
//		} else {
//			System.out.println("No actions found");
//		}
//		//flush all events in model, even if they had not produced any actions
//		this.flushEvents();
//	}
//
//	private void flushEvents(){
//		int eventsToRemove=this.eventsInserted;
//		for(int i=eventsToRemove;i>0;i--){
//			Resource myEvent=this.ontModel.getResource("http://gsi.dit.upm.es/ontologies/ewe/ns/Event_"+this.eventsInserted);
//			OntResource ontEvent=this.ontModel.getOntResource(myEvent);
//			ontEvent.remove();
//			this.eventsInserted--;
//		}
//		
//	}
//	
//	public static void main (String [] args){
//		SPINModule SPNM =new SPINModule();
//		SPNM.runInferences();
//
//	}
//	public OntModel getOntModel() {
//		return ontModel;
//	}
//	public void setOntModel(OntModel ontModel) {
//		this.ontModel = ontModel;
//	}
//	public int getEventsInserted() {
//		return eventsInserted;
//	}
//	public void setEventsInserted(int eventsInserted) {
//		this.eventsInserted = eventsInserted;
//	}
//	public Properties getProp() {
//		return prop;
//	}
//	public void setProp(Properties prop) {
//		this.prop = prop;
//	}
//	public OntModel getNewTriples() {
//		return newTriples;
//	}
//	public void setNewTriples(OntModel newTriples) {
//		this.newTriples = newTriples;
//	}
//	
//
//}
