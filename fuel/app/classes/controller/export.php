<?php
use \Model\RuleEdit;
use \Model\TemplateSpin;

class Controller_Export extends Controller_Rest
{

	public function post_rule($id = '')
	{
		if($id == '')
		{
			return $this->response('ERROR: Rule ID not specified');
		}
		try {
			// $rule = RuleEdit::find_rules($id);
			// // $deleted = RuleEdit::delete_rule($id);

			// // Data that the SPIN Motor will need
			// $rule_data = array();

			// // Template selection based on number of parameters needed
			// $n_parameters = 0;
			// if(isset($rule['thenthat']['ewe:hasInputParameter']))
			// {
			// 	$n_parameters = count($rule['thenthat']['ewe:hasInputParameter']);
			// }			
			// $template = TemplateSpin::get_template($n_parameters);
			// $rule['ewe_spin'] = $template['spin'];
			// switch ($n_parameters) {
			// 	case 4:
			// 		$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-3)];

			// 	case 3:
			// 		$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-2)];

			// 	case 2:
			// 		$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-1)];

			// 	case 1: 
			// 		$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - $n_parameters];
			// 		$rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
			// 		$rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);

			// 	default:
			// 		$rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
			// 		$rule['ewe_spin'] = str_replace('?actionDescription', '"'.$rule['thenthat']['dcterms:description'].'"', $rule['ewe_spin']);
			// 		$rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
			// 		$rule['ewe_spin'] = str_replace('?eventDescription', '"'.$rule['ifthis']['dcterms:description'].'"' , $rule['ewe_spin']);

			// 		// Insert data for SPIN Motor
			// 		$rule_data['event_title'] = $rule['ifthis']['dcterms:title'];
			// 		$rule_data['event_description'] = $rule['ifthis']['dcterms:description'];
					
			// 		break;
			// }

			// $rule['ewe_spin'] = $template['spin'];
			// $rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
			// $indexOfOutput = $rule['ifthisOutputs'][0];
			// $rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?actionID', '"http://gsi.dit.upm.es/wool/'.rand().'"', $rule['ewe_spin']);


			// $saved = RuleEdit::save_rule($rule);
			// var_dump($rule['ewe_spin']);
			// Export Rule to SPIN Motor module
			$this->make_request('CONSTRUCT {
			    ?action a <http://gsi.dit.upm.es/ontologies/ewe/channels/ns/SendMeAnSms> .
			    ?action <http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Message> ?message .
			}
			WHERE {
			    ?event a <http://gsi.dit.upm.es/ontologies/ewe/channels/ns/NewFollower> .
			    ?event <http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Fullname> ?name .
			    BIND ( URI("http://example.org/action3") as ?action )
			    BIND( fn:concat(?name, " is testing you !") AS ?message )
			}',' $rule_data' );

		} catch (Exception $e) {
			return $this->response("ERROR. Rule not found.<br>".$e);
		} 
		
		// return $this->response($rule['ewe_spin']);
		
	}

	private function make_request($sparql, $rule_data) 
	{
		$curl = Request::forge( 'http://homer.gsi.dit.upm.es:8080/wool/spin/motor', 'curl');
		$curl->set_method('post');
		$curl->set_params(array('type'=>"SPARQL", 'sentence'=>$sparql, 
			/*'event_title'=>$rule_data['event_title'], 'event_description'=>$rule_data['event_description']*/)
		);
		$curl->execute();

		$result = $curl->response()->body;
		var_dump($result);
	}

}

?>