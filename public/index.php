
<?php
require_once('../vendor/autoload.php');
use App\Models\Avocat;

require_once('../app/core/router/router.php');

Router::get('dashboard',['App\\Controller\\ControllerAdminDachboard', 'show']);
Router::get('avocats',['App\\Controller\\ControllerAdminAvocats', 'show']);
Router::get('Huissiers',['App\\Controller\\ControllerAdminHuissiers', 'show']);
Router::get('create/avocat',['App\\Controller\\ControllerAddAvocat', 'addavocat']);
Router::get('create',['App\\Controller\\ControllerAddHuissiers', 'show']);
Router::get('create/Huissiers',['App\\Controller\\ControllerAddAvocat', 'addHuissiers']);

Router::dispatsh($_GET['url']);

