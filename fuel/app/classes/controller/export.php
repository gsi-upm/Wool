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

			// Template selection based on number of parameters needed
			$n_parameters = count($rule['thenthat']['ewe:hasInputParameter']);
			var_dump($n_parameters);
			$template = TemplateSpin::get_template($n_parameters);
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
					$rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);

					
					
				default:
					$rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?actionDescription', '"'.$rule['thenthat']['dcterms:description'].'"', $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
					$rule['ewe_spin'] = str_replace('?eventDescription', '"'.$rule['ifthis']['dcterms:description'].'"' , $rule['ewe_spin']);
					
					break;
			}

			// $rule['ewe_spin'] = $template['spin'];
			// $rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
			// $indexOfOutput = $rule['ifthisOutputs'][0];
			// $rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);
			// $rule['ewe_spin'] = str_replace('?actionID', '"http://gsi.dit.upm.es/wool/'.rand().'"', $rule['ewe_spin']);


			$saved = RuleEdit::save_rule($rule);

			// Export Rule to SPIN Motor module
			echo "Entered post rule in export<br>";
			$this->make_request();

		} catch (Exception $e) {
			return $this->response("ERROR. Rule not found.<br>".$e);
		} 
		
		return $this->response($rule['ewe_spin']);
		
	}

	private function make_request() 
	{
		echo "tree powers activated<br>";
		$curl = Request::forge( 'http://homer.gsi.dit.upm.es:8080/wool/rest/spin', 'curl');
		$curl->execute();
		$result = $curl->response();
		var_dump($result);
	}

}

?>