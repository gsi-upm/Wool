<?php
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