<?php

/**
* @site http://kohanaframework.org
* @title Example for Route of User profile example.com/felipebastosweb/controller/action/id
*/

//section of application/boostrap.php file

Route::set('profiles', '<profile>(/<controller>(/<action>(/<id>)))')
	->filter(function($route, $params, $request)
    {
        // Find Profile
		$user = ORM::factory('user')->where('username', '=', $params['profile'])->find();
		//if user loaded is a valid route
		return $user->loaded() ? $params : false;
    })
	->defaults(array(
		'controller' => 'Profile',
		'action'     => 'show',
	));

//Controller example
	
/*

class Controller_Profile extends Controller {

	public function action_show()
	{
		...
		$user = ORM::factory('User')
			->where('username', '=', $this->request->param('profile'))
			->find();
			
		$view->user = $user;
		...
	}

}

*/