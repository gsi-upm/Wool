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
use \Model\Space;

class Controller_Space extends Controller_Rest
{
	// Response of the channels
	public function get_spaces()
	{	
		$spaces = Space::get_spaces();

		foreach ($spaces['spaces'] as $key => $value) {
			$explosion = explode("/", $value);
			$space_value = $explosion[count($explosion)-1];
			$spaces['spaces'][$key] = $space_value;
		}
	
		$response = array(
			"number_spaces" => $spaces['number_spaces'],
			"spaces" => $spaces['spaces'],
		);
		return Response::forge(json_encode($response));
	}

}

?>