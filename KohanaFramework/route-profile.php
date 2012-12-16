<?php

/**
* @site http://kohanaframework.org
* @title Example for Route of User profile example.com/felipebastosweb/controller/action/id
*/

//section of application/boostrap.php file

Route::set('profiles', '<profile>(/<controller>(/<action>(/<id>(/<stuff>))))', array(
		'stuff' => '.*',
	))
	->filter(function($route, $params, $request)
    {
        // Find Profile
		$user = ORM::factory('user')->where('username', '=', $params['profile'])->find();
		
		if($params['controller'] == 'Welcome')
		{
			$params['controller'] = 'Profile';
			$params['action'] = 'show';
		}
		
		return $user->loaded() ? $params : false;
    })
	->defaults(array(
		'controller' => 'Welcome',
		'action'     => 'index',
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