package es.upm.dit.gsi.DrEwe.Vocabulary;

import com.hp.hpl.jena.rdf.model.*;
 
/**
 * Vocabulary definitions from ewe extracted from ifttt
 */
public class EWEChannels {
    /** <p>The RDF model that holds the vocabulary terms</p> */
    private static Model m_model = ModelFactory.createDefaultModel();
    
    /** <p>The namespace of the vocabulary as a string</p> */
    public static final String NS = "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/";
    
    /** <p>The namespace of the vocabulary as a string</p>
     *  @see #NS */
    public static String getURI() {return NS;}
    
    /** <p>The namespace of the vocabulary as a resource</p> */
    public static final Resource NAMESPACE = m_model.createResource( NS );
    
    /** <p>EWE Properties</p>**/
    public static final Property Message = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Message" );
    public static final Property Fullname = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Fullname" );
    public static final Property String = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/String" );
    
    public static final Resource InitResource = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Init" );
    
    /** <p>EWE Actions</p>**/
    public static final Resource SendMeAnSms = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/SendMeAnSms" );
    public static final Resource GSIBot = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/GSIBot" );
    public static final Resource SendAEmail = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/SendAEmail" );
    public static final Resource SendAChat = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/SendAChat" );
    public static final Resource TV = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/TV" );

    /** <p>EWE Events</p>**/
    public static final Resource NewFollower = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewFollower" );
    public static final Resource GSILight = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/GSILight" );
    public static final Resource Time = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Time" );
    public static final Resource eDNI = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/eDNI" );
    
    public static final Resource NewStarredEmail = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewStarredEmail" );
    public static final Resource AnyNewEmail = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/AnyNewEmail" );
    public static final Resource AnyNewAttachment = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/AnyNewAttachment" );
    public static final Resource NewEmailFrom = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewEmailFrom" );
    public static final Resource NewEmailFromSearch = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewEmailFromSearch" );
    public static final Resource NewEmailLabeled = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewEmailLabeled" );
    
}
