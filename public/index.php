<?php
  session_start();
  use TestTask\Http\Route;
  use TestTask\Http\Request;
  use TestTask\Http\Response;
  use TestTask\Database\Grammars\MySQLGrammar;
  use Dotenv\Dotenv;
  use App\Models\AllProduct;
  use App\Models\User;
  

  //require_once 'DB.php';
require_once  __DIR__ .'/../src/Support/helpers.php';

require_once  base_path() .'vendor/autoload.php';

require_once  base_path().'routes/web.php';

$env = Dotenv::createImmutable(base_path());

$env->load();

app()->run();



// User::create([
//   'id' => 1,
//   'name' => 'shaimaa',
//   'username' =>'shimo',
//   'email' => 'shaimaa_elfikky79@outlook.com',
//   'password' => '12345'
// ]);

// $dsn = "mysql:host=localhost;dbname=products";
// $username = "root";
// $password = "shaimaaelfikky79";

// try {
//     $pdo = new PDO($dsn, $username, $password);
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
// $route = new Route(new Request, new Response);

// $route->resolve();
// var_dump(app()->db->raw('SELECT* FROM allproducts'));
//var_dump(base_path());
//dump($route);
//var_dump(MySQLGrammar::buildSelectQuery(['username','code','email'],['username','=','shaimaa']));