<?php

class App
{
	protected static $router;

	public static $db;

	public static function getRouter()
	{
		return self::$router;
	}
	public static function run($uri)
	{
		self::$router = new Router($uri);
		
		self::$db  =  new DB(Config::get('db.host'),Config::get('db.user') , Config::get('db.password'),Config::get('db.db_name'));

		Lang::load(self::$router->getLanguage());


		$controller_class = ucfirst(self::$router->getController()).'Controller';

		$controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());

		$layout = self::$router->getRoute();
		if($layout == 'admin' && Session::get('role') != 'admin')
		{
			if($controller_method != 'admin_login')
			{
				Router::redirect("/admin/users/login");
			}
		}

		//calling controller's method 

		$controller_object =  new $controller_class();

		if(method_exists($controller_object, $controller_method))
		{
			$view_path =  $controller_object->$controller_method();
			
			$view_object = new View($controller_object->getData(), $view_path);
			$content = $view_object->render();

		}else
		{
			throw new Exception("Method ". $controller_method. " of class" . $controller_class . "does not exists");
			
		}

		$layout = self::$router->getRoute();
		$layout_path = VIEWS_PATH.DS.$layout.'.html';
		$layout_view_object = new View(compact('content'), $layout_path);
		echo $layout_view_object->render();
	}

}