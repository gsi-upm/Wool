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
			$rule = RuleEdit::find_rules($id);
			$deleted = RuleEdit::delete_rule($id);
			var_dump($rule);
			// // Template selection based on number of parameters needed
			$n_parameters = 0;
			if(isset($rule['thenthat']['ewe:hasInputParameter']))
			{
				$n1 = count($rule['thenthat']['ewe:hasInputParameter']);
				$n2 = count($rule['ifthis']['ewe:hasOutputParameter']);
				$n_parameters = min($n1, $n2);
			}			
			$template = TemplateSpin::get_template($n_parameters);
			var_dump($template);
			$rule['ewe_spin'] = $template['spin'];
			switch ($n_parameters) {
				case 4:
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-3)];

				case 3:
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-2)];

				case 2:
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-1)];

				case 1: 
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - $n_parameters];
					// $rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
					// $rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventParam1URI', $rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['ewe:Property'], $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?actionParam1URI', $rule['thenthat']['ewe:hasInputParameter'][$indexOfOutput]['ewe:Property'], $rule['ewe_spin']);

				default:
					// $rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
					// $rule['ewe_spin'] = str_replace('?actionDescription', '"'.$rule['thenthat']['dcterms:description'].'"', $rule['ewe_spin']);
					// $rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
					// $rule['ewe_spin'] = str_replace('?eventDescription', '"'.$rule['ifthis']['dcterms:description'].'"' , $rule['ewe_spin']);

					// Inserts the event and action URIs into the corresponding variables
					$rule['ewe_spin'] = str_replace('?actionURI', $rule['thenthat']['@id'], $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventURI', $rule['ifthis']['@id'], $rule['ewe_spin']);

					// Inserts the action ID into the variable ?actionID. Adds a random unique identifier for the action
					$rule['ewe_spin'] = str_replace('?actionID', $rule['thenthat']['@id'].'_'.rand(), $rule['ewe_spin']);

					// Insert data for SPIN Motor
					// $rule_data['event_title'] = $rule['ifthis']['dcterms:title'];
					// $rule_data['event_description'] = $rule['ifthis']['dcterms:description'];
					
					break;
			}
			var_dump($rule['ewe_spin']);
			// $rule['ewe_spin'] = $template['spin'];
			// $rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
			// $indexOfOutput = $rule['ifthisOutputs'][0];
			// $rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?actionID', '"http://gsi.dit.upm.es/wool/'.rand().'"', $rule['ewe_spin']);


			$saved = RuleEdit::save_rule($rule);

			// Export Rule to SPIN Motor module
			$this->make_request($rule['ewe_spin']);

		} catch (Exception $e) {
			return $this->response("ERROR. Rule not found.<br>".$e);
		} 
		
		// return $this->response($rule['ewe_spin']);
		
	}

	private function make_request($sparql) 
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