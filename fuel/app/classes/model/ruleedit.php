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

	public static function find_by_user($username)
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->where(array("user"=>$username))->get('rules');
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
		return $insert_id;
	}

	public static function modify_rule($id, $rule)
	{
		$mongodb = \Mongo_Db::instance();
		$result = $mongodb->where(array("_id"=>new \MongoId($id)))->update('rules', $rule);
		return $result;
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