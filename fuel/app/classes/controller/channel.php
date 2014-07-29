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
use \Model\Channel;

class Controller_Channel extends Controller_Rest
{
	// Response of the channels
	public function get_channels()
	{	
		$channels = Channel::index_channels();

		$channels_ids = array();
		$channels_urls = array();
		$count = 0;
		foreach ($channels as $index => $channel) 
		{
			$count++;
			/*
				The channel info is stored into the last array component.
				Thus, $position is used for extracting that last position
				into the array. With this, each channel info is stored into
				the new variables.
			*/
			$position = count($channels[$index]['@graph'])-1;

			$name = $channels[$index]['@graph'][$position]['dcterms:title'];
			$channels[$index]['name'] = $name;

			$logo = $channels[$index]['@graph'][$position]['foaf:logo'];
			$channels[$index]['logo'] = $logo;

			$space = $channels[$index]['@graph'][$position]['space'];
			$channels[$index]['space'] = $space;

			$channels[$index]['weight'] = 1;
			$channels[$index]['Ranking'] = '1';

			array_push($channels_ids, $channels[$index]['@graph'][$position]['@id']);
				
		}

		$response = array(
			'number_channels' => $count, 
			'id_channels' => $channels_ids,
			'channels' => $channels,
		);
		return Response::forge(json_encode($response));
	}

}

?>