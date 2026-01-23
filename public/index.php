<?php

require_once('../vendor/autoload.php');
require_once('../app/core/router/router.php');

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

// routes des professionnelles


Router::add('professional/dashboard', ["callable" => 'App\\Controller\\ControllerProfessional@index', "auth" => true, "roles" => ["avocat", "huissier"]]);
Router::add('professional/demands', ["callable" => 'App\\Controller\\ControllerProfessional@demands', "auth" => true, "roles" => ["avocat", "huissier"]]);
Router::add('professional/update-status', ["callable" => 'App\\Controller\\ControllerProfessional@updateStatus', "auth" => true, "roles" => ["avocat", "huissier"]]);
Router::add('professional/demand-details', ["callable" => 'App\\Controller\\ControllerProfessional@getDemandDetails', "auth" => true, "roles" => ["avocat", "huissier"]]);
Router::add('professional/profile', ["callable" => 'App\\Controller\\ControllerProfessional@profile', "auth" => true, "roles" => ["avocat", "huissier"]]);

Router::dispatsh($_GET['url'] ?? "");