
<?php
require_once('../vendor/autoload.php');
use App\Models\Avocat;
$j = new Avocat();
require_once('../app/core/router/router.php');

Router::get('dachbord','/../../views/admin_dashboard.php');
Router::get('create','/../../views/create.php');

Router::dispatsh($_GET['url']);