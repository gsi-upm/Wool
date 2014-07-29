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