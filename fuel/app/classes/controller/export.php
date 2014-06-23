<?php
use \Model\RuleEdit;
use \Model\TemplateSpin;

class Controller_Export extends Controller_Rest
{

	public function get_rule($id = '')
	{
		if($id == '')
		{
			return $this->response('ERROR: Rule ID not specified');
		}
		try {
			$rule = RuleEdit::find_rules($id);
			// $deleted = RuleEdit::delete_rule($id);

			// // Template selection based on number of parameters needed
			$n_parameters = 0;
			if(isset($rule['thenthat']['ewe:hasInputParameter']))
			{
				$n1 = count($rule['thenthat']['ewe:hasInputParameter']);
				$n2 = count($rule['ifthis']['ewe:hasOutputParameter']);
				$n_parameters = min($n1, $n2);
			}	

			$template = TemplateSpin::get_template($n_parameters);
			$rule['ewe_spin'] = $template['spin'];

			switch ($n_parameters) {
				case 3:
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-2)];

				case 2:
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - ($n_parameters-1)];

				case 1: 
					$indexOfOutput = $rule['ifthisOutputs'][$n_parameters - $n_parameters];
					// $rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
					// $rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventParam1URI', $rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['ewe:Property'], $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?actionParam1URI', $rule['thenthat']['ewe:hasInputParameter'][$n_parameters-1]['ewe:Property'], $rule['ewe_spin']);

				default:
					// Inserts the event and action URIs into the corresponding variables
					$rule['ewe_spin'] = str_replace('?actionURI', $rule['thenthat']['@id'], $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventURI', $rule['ifthis']['@id'], $rule['ewe_spin']);

					// Inserts the action ID into the variable ?actionID. Adds a random unique identifier for the action
					$rule['ewe_spin'] = str_replace('?actionID', $rule['thenthat']['@id'].'_'.rand(), $rule['ewe_spin']);					
					break;
			}

			$composed = RuleEdit::modify_rule($id, array('ewe_spin'=>$rule['ewe_spin']));

			// Export Rule to SPIN Motor module
			$deploy = $this->make_request($rule['ewe_spin']);

			if($deploy['status'] == 'OK') {
				$rule['deployed'] = true;
				$updated = RuleEdit::modify_rule($id, array('deployed'=>true));
				Response::redirect('admin/rules');
			} else {
				echo "ERROR. Rule has not been deployed!";
			}

		} catch (Exception $e) {
			return $this->response("ERROR. Rule not found.<br>".$e);
		} 
	}

	// Makes a POST request to the SPIN Motor endpoint. In the request parameters is the SPARQL query
	private function make_request($sparql) 
	{
		Config::load('wool_config.json');
		$curl = Request::forge( Config::get('spin-motor.deploy_rule_endpoint'), 'curl');
		$curl->set_method('post');
		$curl->set_params(array('type'=>"SPARQL", 'sentence'=>$sparql));
		$curl->execute();

		$result = $curl->response()->body;
		return $result;
	}

}

?>