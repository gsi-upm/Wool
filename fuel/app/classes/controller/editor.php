<?php

class Controller_Editor extends Controller
{
	public function action_index()
	{
		$data = array();
		$data['thing'] = "Oly";
		
		// Assign current_user to the instance so controllers can use it
		if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
		{
			$this->current_user = Auth::check() ? Model\Auth_User::find_by_username(Auth::get_screen_name()) : null;
		}
		else
		{
			$this->current_user = Auth::check() ? Model_User::find_by_username(Auth::get_screen_name()) : null;
		}

		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);

		return View::forge('editor', $data);
	}
}

?>