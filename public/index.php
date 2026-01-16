
<?php
require_once('../vendor/autoload.php');
use App\Models\Avocat;

require_once('../app/core/router/router.php');

Router::add('dashboard',['App\\Controller\\ControllerAdminDachboard', 'show']);
Router::add('avocats',['App\\Controller\\ControllerAdminAvocats', 'show']);
Router::add('Huissiers',['App\\Controller\\ControllerAdminHuissiers', 'show']);
Router::add('avocat/create',['App\\Controller\\ControllerAddAvocat', 'addavocat']);
Router::add('create',['App\\Controller\\ControllerAddHuissiers', 'show']);
Router::add('create/Huissiers',['App\\Controller\\ControllerAddAvocat', 'addHuissiers']);
Router::add('avocat/delete',['App\\Controller\\ControlleDeleteAvocat', 'deleteavocat']);

Router::dispatsh($_GET['url']);

