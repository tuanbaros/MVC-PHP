<?php

Config::set('site_name', ' your site name');
Config::set('languages', array('en','fr'));

//Router. Route name  => method prefix
Config::set('routes',array(

	'default' => '',
	'admin' => 'admin_',
	));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');

Config::set('db.host','localhost');
Config::set('db.user','root');
Config::set('db.password','');
Config::set('db.db_name','php-udemy');

Config::set('salt', 'lelinhisme');