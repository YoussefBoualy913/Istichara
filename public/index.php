
<?php
require_once('../vendor/autoload.php');
use App\Models\Avocat;

require_once('../app/core/router/router.php');

Router::get('dashboard',['App\\Controller\\ControllerAdminDachboard', 'show']);
Router::get('avocats',['App\\Controller\\ControllerAdminAvocats', 'show']);
Router::get('Huissiers',['App\\Controller\\ControllerAdminHuissiers', 'show']);
Router::get('create',['App\\Controller\\ControllerAddPersonnes', 'show']);

Router::dispatsh($_GET['url']);

