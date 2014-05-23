<?php
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

			$channels[$index]['weight'] = 1;
			$channels[$index]['Ranking'] = '1';

			array_push($channels_ids, $channels[$index]['@graph'][$position]['@id']);
				
		}
		return $this->response(array(
			'number_channels' => $count, 
			'id_channels' => $channels_ids,
			'channels' => $channels,
		));
	}

}

?>