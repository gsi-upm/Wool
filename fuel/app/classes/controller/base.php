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
class Controller_Base extends Controller_Template {

	public function before()
	{
		parent::before();

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
	}

}