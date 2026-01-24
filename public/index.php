<?php

use App\Core\Middleware\AdminMiddleware;
use App\Core\Middleware\AuthMiddleware;
use App\Core\Middleware\VisitorMiddleware;
use Dotenv\Dotenv;

require_once('../vendor/autoload.php');
require_once('../app/core/router/router.php');

(Dotenv::createImmutable(__DIR__. "/.."))->load();

// Public routes
Router::add('/',["callable" => "App\\Controller\\ControllerVisiteur@index" , "middlewares" => []]);
Router::add('register',["callable" =>"App\\Controller\\ControllerVisiteur@register","middlewares" => [VisitorMiddleware::class]]);
Router::add('avocat/profile/{id}',["callable" =>"App\\Controller\\Professionnelle\\AvocatController@profile","middlewares" => []]);

// Public API routes
Router::add('api/v4/professionals',["callable" =>"App\\Controller\\Api\\ProfessionalsAPIController@getProfessionals","middlewares" =>[]]);

// Authntification routes
Router::add('auth/login',["callable" =>"App\\Controller\\Auth\\AuthController@login","middlewares" => [VisitorMiddleware::class]]);
Router::add('auth/client/register',["callable" =>"App\\Controller\\Auth\\AuthController@registerClient","middlewares" => [VisitorMiddleware::class]]);
Router::add('auth/huissier/register',["callable" =>"App\\Controller\\Auth\\AuthController@registerHuissier","middlewares" => [VisitorMiddleware::class]]);
Router::add('auth/avocat/register',["callable" =>"App\\Controller\\Auth\\AuthController@registerAvocat","middlewares" => [VisitorMiddleware::class]]);
Router::add('auth/logout',["callable" =>"App\\Controller\\Auth\\AuthController@logout","middlewares" => [AuthMiddleware::class]]);

Router::add('dashboard',["callable" => 'App\\Controller\\ControllerDachboard@index', "middlewares" => [AuthMiddleware::class]]);
Router::add('avocats',["callable" => 'App\\Controller\\Admin\\ControllerAvocats@index', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('avocat/create',["callable" => 'App\\Controller\\Admin\\ControllerAvocats@create', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('avocat/store',["callable" => 'App\\Controller\\Admin\\ControllerAvocats@store', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class],]);
Router::add('avocat/edit',["callable" => 'App\\Controller\\Admin\\ControllerAvocats@edit', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('avocat/update',["callable" =>'App\\Controller\\Admin\\ControllerAvocats@update', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('avocat/destroy',["callable" =>'App\\Controller\\Admin\\ControllerAvocats@destroy', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class],]);
Router::add('Huissiers',["callable" => 'App\\Controller\\Admin\\\ControllerHuissiers@index', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('Huissiers/create',["callable" => 'App\\Controller\\Admin\\\ControllerHuissiers@create',"middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('Huissiers/store',["callable" => 'App\\Controller\\Admin\\\ControllerHuissiers@store', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('Huissiers/edit',["callable" => 'App\\Controller\\Admin\\\ControllerHuissiers@edit', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('Huissiers/update',["callable" => 'App\\Controller\\Admin\\\ControllerHuissiers@update', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);
Router::add('Huissiers/destroy',["callable" => 'App\\Controller\\Admin\\\ControllerHuissiers@destroy', "middlewares" => [AuthMiddleware::class, AdminMiddleware::class]]);


(new Router())->dispatsh();