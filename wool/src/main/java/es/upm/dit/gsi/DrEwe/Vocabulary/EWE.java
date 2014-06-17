package es.upm.dit.gsi.DrEwe.Vocabulary;

import com.hp.hpl.jena.rdf.model.*;
 
/**
 * Vocabulary definitions from ewe
 */
public class EWE {
    /** <p>The RDF model that holds the vocabulary terms</p> */
    private static Model m_model = ModelFactory.createDefaultModel();
    
    /** <p>The namespace of the vocabulary as a string</p> */
    public static final String NS = "http://gsi.dit.upm.es/ontologies/ewe/ns/";
    
    /** <p>The namespace of the vocabulary as a string</p>
     *  @see #NS */
    public static String getURI() {return NS;}
    
    /** <p>The namespace of the vocabulary as a resource</p> */
    public static final Resource NAMESPACE = m_model.createResource( NS );
    
    public static final Property generatesEvent = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/ns/generatesEvent" );
    public static final Property providesAction = m_model.createProperty( "http://gsi.dit.upm.es/ontologies/ewe/ns/providesAction" );
    
    public static final Resource Event = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/ns/Event" );
    public static final Resource Action = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/ns/Action" );
    public static final Resource Channel = m_model.createResource( "http://gsi.dit.upm.es/ontologies/ewe/ns/Channel" );
}
