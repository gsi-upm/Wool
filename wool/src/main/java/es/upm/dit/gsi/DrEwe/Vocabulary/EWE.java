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
