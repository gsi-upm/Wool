<?php
use \Model\RuleEdit;
use \Model\Channel;

class Controller_Admin_Field extends Controller_Admin
{
	public function before()
	{
		parent::before();
		$this->current_user = Model_User::find_by_username(Auth::get_screen_name());
	}

	public function action_index()
	{
		$username = $this->current_user->username;

		$rules = RuleEdit::find_by_user($username);
		$deployed = array();
		$located = array();
		$ids_in_use = array('');
		$data['rules'] = array();

		// Selects the rules already deployed into the SPIN Motor
		foreach ($rules as $key => $value) {
			if($rules[$key]['deployed'])
			{
				array_push($deployed, $rules[$key]);
			}
		}

		// Selects only the rules located in the GSILab
		foreach ($rules as $key => $value) {
			$rule_channel_id = $value['ifthis']['from_channel'];
			$rule_channel_id2 = $value['thenthat']['from_channel'];
			$space_channel1 = '';
			$space_channel2 = '';
			if($rule_channel_id != '')
			{
				$space_channel1 = Channel::get_channel_space($rule_channel_id);
			}
			if($rule_channel_id2 != '')
			{
				$space_channel2 = Channel::get_channel_space($rule_channel_id2);
			}
			if ($space_channel1 == $space_channel2) 
			{
				if($space_channel1 == "located/lab_gsi")
				{
					array_push($located, $rules[$key]);
				}
			}
		}

		// Selects only one event of each type
		foreach ($located as $key => $value) {
			$id_used = false;
			foreach ($ids_in_use as $key_id => $value_id) {
				if($located[$key]['ifthis']['@id'] ==  $value_id){	$id_used = true;	}
			}
			if(!$id_used)
			{
				array_push($data['rules'], $located[$key]);
				array_push($ids_in_use, $located[$key]['ifthis']['@id']);
				$id_used = false;
			}
		}

		// Saves the logos inte the corresponding rules
		foreach ($data['rules'] as $rule => $rule_value) {
			$rule_channel_id = $data['rules'][$rule]['ifthis']['from_channel'];
			$rule_channel_id2 = $data['rules'][$rule]['thenthat']['from_channel'];
			if($rule_channel_id != '')
			{
				$result = Channel::get_channel_logo($rule_channel_id);
				$data['rules'][$rule]['ifthis']['logo-event'] = $result;
				// array_push($data['logos'], $result);
			}
			if($rule_channel_id2 != '')
			{
				$result = Channel::get_channel_logo($rule_channel_id2);
				$data['rules'][$rule]['thenthat']['logo-action'] = $result;
				// array_push($data['logos2'], $result);
			}
		}


		Lang::load('general.json');

		$data['language'] = Config::get('language');
		$this->template->title = Lang::get('titleBar.field');
		$this->template->language = Config::get('language');
		$this->template->content = View::forge('admin/field/index', $data);
	}
}

?>