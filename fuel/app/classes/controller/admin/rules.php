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
use \Model\RuleEdit;
use \Model\Channel;

class Controller_Admin_Rules extends Controller_Admin{

	public function before()
	{
		parent::before();
		$this->current_user = Model_User::find_by_username(Auth::get_screen_name());
	}

	public function action_index()
	{
		$username = $this->current_user->username;
		// $data['rules'] = RuleEdit::index_rules();
		$data['rules'] = RuleEdit::find_by_user($username);
		$data['logos'] = array();
		$data['logos2'] = array();

		// Searches the channels id from the rules and stores the logos from these channels
		$channel_ids = array();
		foreach ($data['rules'] as $rule => $rule_value) {
			$rule_channel_id = $data['rules'][$rule]['ifthis']['from_channel'];
			$rule_channel_id2 = $data['rules'][$rule]['thenthat']['from_channel'];
			if($rule_channel_id != '')
			{
				$result = Channel::get_channel_logo($rule_channel_id);
				$data['rules'][$rule]['ifthis']['logo'] = $result;
				array_push($data['logos'], $result);
			}
			if($rule_channel_id2 != '')
			{
				$result = Channel::get_channel_logo($rule_channel_id2);
				$data['rules'][$rule]['thenthat']['logo'] = $result;
				array_push($data['logos2'], $result);
			}
		}
		// Sorts the data in order to show it more naturally
		sort($data['rules']);
		arsort($data['logos']);
		arsort($data['logos2']);

		$data['language'] = Config::get('language');
		Lang::load('general.json');

		$this->template->title = Lang::get('titleBar.rules');
		$this->template->language = Config::get('language');
		$this->template->content = View::forge('admin/rules/index', $data);
	}

	public function action_view($id = null)
	{
		$data['rule'] = RuleEdit::find_rules($id);
		$this->template->title = "Rule";
		$this->template->language = Config::get('language');
		$this->template->content = View::forge('admin/rules/view', $data);

	}
	
	public function action_editor()
	{
		$this->template->title = "Rules";
		$this->template->language = Config::get('language');
		$this->template->content = View::forge('admin/rules/editor');
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Rule::validate('create');

			if ($val->run())
			{
				$rule = Model_Rule::forge(array(
					'title' => Input::post('title'),
					'summary' => Input::post('summary'),
					'user_id' => Input::post('user_id'),
				));

				if ($rule and $rule->save())
				{
					Session::set_flash('success', e('Added rule #'.$rule->id.'.'));

					Response::redirect('admin/rules');
				}

				else
				{
					Session::set_flash('error', e('Could not save rule.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Rules";
		$this->template->language = Config::get('language');
		$this->template->content = View::forge('admin/rules/create');

	}

	public function action_edit($id = null)
	{
		$rule = Model_Rule::find($id);
		$val = Model_Rule::validate('edit');

		if ($val->run())
		{
			$rule->title = Input::post('title');
			$rule->summary = Input::post('summary');
			$rule->user_id = Input::post('user_id');

			if ($rule->save())
			{
				Session::set_flash('success', e('Updated rule #' . $id));

				Response::redirect('admin/rules');
			}

			else
			{
				Session::set_flash('error', e('Could not update rule #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$rule->title = $val->validated('title');
				$rule->summary = $val->validated('summary');
				$rule->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rule', $rule, false);
		}

		$this->template->title = "Rules";
		$this->template->language = Config::get('language');
		$this->template->content = View::forge('admin/rules/edit');

	}

	public function action_delete($id = null)
	{
		// if ($rule = Model_Rule::find($id))
		// {
		// 	$rule->delete();

		// 	Session::set_flash('success', e('Deleted rule #'.$id));
		// }

		// else
		// {
		// 	Session::set_flash('error', e('Could not delete rule #'.$id));
		// }

		// Response::redirect('admin/rules');
		//$data['rule'] = RuleEdit::find_rules($id);
		$result = RuleEdit::delete_rule($id);
		Session::set_flash('success', e('Cosa: '.$result));
		Response::redirect('admin/rules');

	}


}