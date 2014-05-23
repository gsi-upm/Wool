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
			$template = TemplateSpin::get_template(1);

			$rule['ewe_spin'] = $template['spin'];
			$rule['ewe_spin'] = str_replace('?actionTitle', '"'.$rule['thenthat']['dcterms:title'].'"', $rule['ewe_spin']);
			$rule['ewe_spin'] = str_replace('?actionP1Title', '"'.$rule['thenthat']['ewe:hasInputParameter'][0]['dcterms:title'].'"', $rule['ewe_spin']);
			$rule['ewe_spin'] = str_replace('?eventTitle', '"'.$rule['ifthis']['dcterms:title'].'"' , $rule['ewe_spin']);
			$indexOfOutput = $rule['ifthisOutputs'][0];
			$rule['ewe_spin'] = str_replace('?eventP1Title', '"'.$rule['ifthis']['ewe:hasOutputParameter'][$indexOfOutput]['dcterms:title'].'"' , $rule['ewe_spin']);
			$rule['ewe_spin'] = str_replace('?actionID', '"http://gsi.dit.upm.es/wool/'.rand().'"', $rule['ewe_spin']);


			$saved = RuleEdit::save_rule($rule);
		} catch (Exception $e) {
			return $this->response("ERROR. Rule not found.<br>".$e);
		} 
		
		return $this->response("SUCCESS! Rule has been exported succesfully.");
		
	}

}

?>