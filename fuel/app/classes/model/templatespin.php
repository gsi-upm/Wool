<?php
namespace Model;

class TemplateSpin extends \Model
{
	public static function get_template($parameters = '')
	{
		if(is_numeric($parameters))
		{
			if($parameters <= 3)
			{
				$mongodb = \Mongo_Db::instance();
				$result = $mongodb->where(array("number_parameters"=>$parameters))->get('templates_spin');
				$template = $result[0];
				return $template;
			}
		}	
	}
}
?>