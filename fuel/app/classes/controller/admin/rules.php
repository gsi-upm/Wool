<?php
use \Model\RuleEdit;
use \Model\Channel;

class Controller_Admin_Rules extends Controller_Admin{

	public function action_index()
	{
		$data['rules'] = RuleEdit::index_rules();
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
				array_push($data['logos'], $result);
			}
			if($rule_channel_id2 != '')
			{
				$result = Channel::get_channel_logo($rule_channel_id2);
				array_push($data['logos2'], $result);
			}
		}
		// Sorts the data in order to show it more naturally
		arsort($data['rules']);
		arsort($data['logos']);
		arsort($data['logos2']);
		$this->template->title = "Rules";
		$this->template->content = View::forge('admin/rules/index', $data);
	}

	public function action_view($id = null)
	{
		$data['rule'] = RuleEdit::find_rules($id);
		$this->template->title = "Rule";
		$this->template->content = View::forge('admin/rules/view', $data);

	}
	
	public function action_editor()
	{
		$this->template->title = "Rules";
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