<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',  dirname(dirname(__FILE__)));
define('VIEWS_PATH',ROOT.DS.'views');


require_once(ROOT.DS.'lib'.DS.'init.php'); 

App::run($_SERVER['REQUEST_URI']);









