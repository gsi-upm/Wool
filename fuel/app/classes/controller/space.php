<?php
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