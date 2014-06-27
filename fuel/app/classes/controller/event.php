<?php

class Controller_Event extends Controller_Rest
{
		public function post_index()
		{
			$data = \Input::json();
			// var_dump($data);

			// return Response::forge(json_encode($response));

			// for ($i=1; $i < $request['n_parameters']; $i++) { 
			// 	echo $request['param'.$i];
			// }
			$n_out = $data['n_outputs'];
			switch($n_out) {
				case 3:
					$request['param3'] = $data['params'][2]['type'];
					$request['param3value'] = $data['params'][2]['value'];
				case 2:
					$request['param2'] = $data['params'][1]['type'];
					$request['param2value'] = $data['params'][1]['value'];
				case 1:
					$request['param1'] = $data['params'][0]['type'];
					$request['param1value'] = $data['params'][0]['value'];
				default:
					$request['type'] = 'ewe:event';
					$request['event'] = $data['eventURI'];
					for ($i=3; $i > 0 ; $i--) { 
						if($n_out < $i)
						{
							$request['param'.$i] = '';
							$request['param'.$i.'value'] = '';
						}
					}
				break;
			}
			// var_dump($request);
			// return Response::forge(json_encode(array('status'=>'ok')));
			// $request['type'] = 'ewe:event';
			// $request['event'] = 'http://gsi.dit.upm.es/ontologies/ewe/channels/ns/Time';
			// $request['param1'] = 'Message';
			// $request['param1value'] = 'this is a test parameter';
			$result = $this->make_SPIN_Motor_request($request);


			// Checks the response: searches if there are triggered actions
			if(!isset($result['description'])) {
				$response = array(
					'status' => 'rule_manager_no_actions',
					'description' => 'No new actions have been triggered',
				);
				return Response::forge(json_encode($response));
			}


			$response = $this->make_translator_request($result['description']);
			$json_response = json_decode($response, true);

			// Removes the uncessary Init action
			$key_to_remove = 0;
			foreach ($json_response as $key => $value) {
				if(isset($json_response[$key]['@id'])) 
				{
					if($json_response[$key]['@id'] == Config::get('spin-motor.init_action_URI'))
					{
						$key_to_remove = $key;
					}
				}
			}
			unset($json_response[$key_to_remove]);

			return Response::forge(json_encode($json_response));
		}

		private function make_SPIN_Motor_request($request)
		{
			Config::load('wool_config.json');
			$curl = Request::forge( Config::get('spin-motor.insert_event_endpoint'), 'curl');
			$curl->set_method('post');
			$curl->set_params(array('type'=>$request['type'], 'event'=>$request['event'], 
				'param1'=>$request['param1'], 'param1value'=>$request['param1value']));
			$curl->execute();

			$result = $curl->response()->body;
			return $result;		
		}

		private function make_translator_request($rdf)
		{
			$curl = Request::forge( Config::get('spin-motor.rest_rdf_translator_endpoint'), 'curl');
			$curl->set_method('post');
			$curl->set_params(array('content'=>$rdf));
			$curl->execute();

			$response = $curl->response()->body;

			return $response;
		}
}

?>