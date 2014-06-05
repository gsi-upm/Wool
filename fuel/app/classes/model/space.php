<?php
namespace Model;

class Space extends \Model
{
	public static function get_spaces()
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->get('spaces');
		$template = $result[0];
		return $template;		
	}
}
?>