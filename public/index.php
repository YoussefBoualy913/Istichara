
<?php

use App\Helper\Request;

require_once('../vendor/autoload.php');
require_once('../app/core/router/router.php');

$request = new Request();

<<<<<<< Updated upstream
=======

Router::add('register',["callable" =>"App\\Controller\\ControllerVisiteur@register","auth" =>false ,"roles" => []]);
Router::add('',["callable" => "App\\Controller\\ControllerVisiteur@index" , "auth" => false, "roles" => []]);
Router::add('dashboard',["callable" => 'App\\Controller\\ControllerDachboard@index', "auth" => true, "roles" => ["ADMIN"]]);
Router::add('avocats',["callable" => 'App\\Controller\\ControllerAvocats@index', "auth" => true, "roles" => ["ADMIN"]]);
Router::add('avocat/create',["callable" => 'App\\Controller\\ControllerAvocats@create', "auth" => true, "roles" => ["ADMIN"]]);
Router::add('avocat/store',["callable" => 'App\\Controller\\ControllerAvocats@store', "auth" => true, "roles"  => ["ADMIN"]]);
Router::add('avocat/edit',["callable" => 'App\\Controller\\ControllerAvocats@edit', "auth" => true, "roles"  =>  ["ADMIN"]]);
Router::add('avocat/update',["callable" =>'App\\Controller\\ControllerAvocats@update', "auth" => true, "roles"  =>  ["ADMIN"]]);
Router::add('avocat/destroy',["callable" =>'App\\Controller\\ControllerAvocats@destroy', "auth" => true, "roles"  => ["ADMIN"]]);
Router::add('Huissiers',["callable" => 'App\\Controller\\ControllerHuissiers@index', "auth" => true, "roles"  => ["ADMIN"]]);
Router::add('Huissiers/create',["callable" => 'App\\Controller\\ControllerHuissiers@create',"auth" => true, "roles"  => ["ADMIN"]]);
Router::add('Huissiers/store',["callable" => 'App\\Controller\\ControllerHuissiers@store', "auth" => true, "roles"  => ["ADMIN"]]);
Router::add('Huissiers/edit',["callable" => 'App\\Controller\\ControllerHuissiers@edit', "auth" => true, "roles"  => ["ADMIN"]]);
Router::add('Huissiers/update',["callable" => 'App\\Controller\\ControllerHuissiers@update', "auth" => true, "roles"  => ["ADMIN"]]);
Router::add('Huissiers/destroy',["callable" => 'App\\Controller\\ControllerHuissiers@destroy', "auth" => true, "roles"  => ["ADMIN"]]);
>>>>>>> Stashed changes

Router::add('',['App\\Controller\\ControllerVisiteur', 'index']);
Router::add('dashboard',['App\\Controller\\ControllerDachboard', 'index']);
Router::add('avocats',['App\\Controller\\ControllerAvocats', 'index']);
Router::add('avocat/create',['App\\Controller\\ControllerAvocats', 'create']);
Router::add('avocat/store',['App\\Controller\\ControllerAvocats', 'store']);
Router::add('avocat/edit',['App\\Controller\\ControllerAvocats', 'edit']);
Router::add('avocat/update',['App\\Controller\\ControllerAvocats', 'update']);
Router::add('avocat/destroy',['App\\Controller\\ControllerAvocats', 'destroy']);
Router::add('Huissiers',['App\\Controller\\ControllerHuissiers', 'index']);
Router::add('Huissiers/create',['App\\Controller\\ControllerHuissiers', 'create']);
Router::add('Huissiers/store',['App\\Controller\\ControllerHuissiers', 'store']);
Router::add('Huissiers/edit',['App\\Controller\\ControllerHuissiers', 'edit']);
Router::add('Huissiers/update',['App\\Controller\\ControllerHuissiers', 'update']);
Router::add('Huissiers/destroy',['App\\Controller\\ControllerHuissiers', 'destroy']);

Router::dispatsh($_GET['url']);
