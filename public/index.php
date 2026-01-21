
<?php

use App\Helper\Request;

require_once('../vendor/autoload.php');
require_once('../app/core/router/router.php');

$request = new Request();


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
