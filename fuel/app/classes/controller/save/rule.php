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

class Controller_Save_Rule extends Controller
{
	public function action_index()
	{
		$current_user = Model_User::find_by_username(Auth::get_screen_name());

		if(Input::Method() == 'POST')
		{
			// Saves the received JSON in the request
			$value = Input::json();

			// Removes innecessary Knockout data
			unset($value['ifthis']['__ko_mapping__']);
			unset($value['thenthat']['__ko_mapping__']);

			// Checks if it is already edited, and if true, deletes the old rule
			// and saved the date at wich it is edited
			if($value['edited_ruleId'] != '') 
			{
				// Gets the old rule, and then deletes it
				$previous_rule = RuleEdit::find_rules($value['edited_ruleId']);
				$deleted = RuleEdit::delete_rule($value['edited_ruleId']);
				if($deleted != true) 
				{ 
					return Response::forge("ERROR. Previously created rule not found into server");
				}

				// Saves the useful info into the new rule and deletes the non useful data
				$value['created_at'] = $previous_rule['created_at'];
				$value['last_edited_at'] = date('Y/m/d H:i:s');
				unset($value['edited_ruleId']);
			} else 
			{
				// Saves the date at wich it is created
				$value['created_at'] = date('Y/m/d H:i:s');	
			}

			// Adds the doployed parameter
			$value['deployed'] = false;

			// Saves the user that has created the rule
			$value['user'] = $current_user->username;


			$saved = RuleEdit::save_rule($value);
			$saving_status = '';
			// If $saved is true, the rule has been succesfully saved
			if($saved)
			{
				$saving_status = "Rule has been succesfully saved";
			} else 
			{
				$saving_status = "ERROR. Rule is NOT saved";
			}
			$date = date('Y/m/d H:i:s');

			$status = array(
				'status' => $saving_status.' at '.$date ,
				'saved' => $saved,
			);

			return Response::forge(json_encode($status));
		}	
	}
}
?>