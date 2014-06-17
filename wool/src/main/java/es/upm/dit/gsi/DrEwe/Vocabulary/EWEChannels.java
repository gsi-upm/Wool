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
    
    public static final Property Message = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Message" );
    public static final Property Fullname = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Fullname" );
    
    public static final Resource SendMeAnSms = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/SendMeAnSms" );
    public static final Resource NewFollower = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewFollower" );
    public static final Resource InitResource = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Init" );
}
