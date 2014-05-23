<?php
use \Model\RuleEdit;

class Controller_Rules extends Controller_Rest
{
	// Response containing the rule with the $id
	public function get_rule($id = '')
	{	
		if($id == '')
		{
			return $this->response('ERROR: Rule ID not specified');
		}
		try {
			$result = RuleEdit::find_rules($id);
			return $this->response($result);
		} catch (Exception $e) {
			return $this->response("ERROR. Rule not found.<br>".$e);
		}
		
	}

}

?>