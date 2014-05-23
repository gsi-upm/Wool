<?php
namespace Model;

class RuleEdit extends \Model
{
	
	public static function index_rules()
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->get('rules');
		return $result;
	}

	public static function find_rules($id)
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->where(array("_id"=>new \MongoId($id)))->get('rules');
		$rule = $result[0];
		return $rule;
	}

	public static function save_rule($rule)
	{
		$mongodb = \Mongo_Db::instance();
		// Returns the id of mongo if the rule has been succesfully saved,
		// and false if not
		$insert_id = $mongodb->insert('rules', $rule);
		if($insert_id == false)
		{
			return false;
		}
		return true;
	}

	public static function delete_rule($id)
	{
		if($id == null)
		{
			return false;
		}
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->where(array("_id"=>new \MongoId($id)))->delete('rules');
		return $result;
	}
}

?>