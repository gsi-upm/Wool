<?php
namespace Model;

class Channel extends \Model
{
	
	public static function index_channels()
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->get('channels');
		return $result;
	}

	public static function find_channel($id)
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->where(array("_id"=>new \MongoId($id)))->get('channels');
		$channel = $result[0];
		return $channel;
	}

	public static function get_channel_logo($id_channel)
	{
		$mongodb = \Mongo_Db::instance();
		$channels = $mongodb->get('channels');

		foreach ($channels as $channel => $channel_value) {
			$channel_data = $channels[$channel]['@graph'][count($channels[$channel]['@graph'])-1];
			if($channel_data['@id'] == $id_channel)
			{
				$result = $channel_data['foaf:logo'];
			}
		}
		return $result;
	}

	public static function get_channel_space($id_channel)
	{
		$mongodb = \Mongo_Db::instance();
		$channels = $mongodb->get('channels');

		foreach ($channels as $channel => $channel_value) {
			$channel_data = $channels[$channel]['@graph'][count($channels[$channel]['@graph'])-1];
			if($channel_data['@id'] == $id_channel)
			{
				$result = $channel_data['space'];
			}
		}
		return $result;
	}


// 	public static function find_rules($id)
// 	{
// 		$mongodb = \Mongo_Db::instance();
// 		$result = $mongodb->where(array("_id"=>new \MongoId($id)))->get('rules');
// 		$rule = $result[0];
// 		return $rule;
// 	}

// 	public static function delete_rule($id)
// 	{
// 		if($id == null)
// 		{
// 			return false;
// 		}
// 		$mongodb = \Mongo_Db::instance();
// 		$result = $mongodb->where(array("_id"=>new \MongoId($id)))->delete('rules');
// 		return $result;
// 	}
}

?>