
<?php
require_once('../vendor/autoload.php');
use App\Models\Avocat;

require_once('../app/core/router/router.php');

Router::add('dashboard',['App\\Controller\\ControllerDachboard', 'index']);
Router::add('avocats',['App\\Controller\\ControllerAvocats', 'index']);
Router::add('create',['App\\Controller\\ControllerAvocats', 'create']);
Router::add('store',['App\\Controller\\ControllerAvocats', 'store']);
Router::add('edit',['App\\Controller\\ControllerAvocats', 'edit']);
Router::add('update',['App\\Controller\\ControllerAvocats', 'update']);
Router::add('destroy',['App\\Controller\\ControllerAvocats', 'destroy']);
Router::add('Huissiers',['App\\Controller\\ControllerAdminHuissiers', 'show']);
Router::add('create/Huissiers',['App\\Controller\\ControllerAddAvocat', 'addHuissiers']);

Router::dispatsh($_GET['url']);

