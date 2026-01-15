
<?php
require_once('../vendor/autoload.php');
use App\Models\Avocat;

require_once('../app/core/router/router.php');

Router::get('dachbord',['App\\Controller\\ControllerAdminDachboard', 'show']);

Router::dispatsh($_GET['url']);

