<?php
require_once './vendor/autoload.php';
use Eclair\Session\DatabaseSessionHandler;
//use Eclair\Http\Request;
//use Eclair\Database\Adaptor;


//$_SERVER['REQUEST_METHOD'] = 'GET';
//$_SERVER['PATH_INFO'] = '/posts/write';
//var_dump(Request::getMethod());


//Adaptor::setup('mysql:dbname=newpinfactory','newpinfactory','XTpZskWuV+9Oh');


/*class Post
{

}
$posts = Adaptor::getAll('SELECT * FROM posts LIMIT 3');*/
//var_dump($posts);




//use Eclair\Routing\Route;
use Eclair\Database\Adaptor;

Adaptor::setup('mysql:dbname=newpinfactory','newpinfactory','XTpZskWuV+9Oh');

/*Route::add('get', '/', function () {
    echo 'Hello, world';
});

Route::add('get', '/posts/{id}', function ($id) {

    var_dump(Adaptor::getAll('select * from posts where `id` = ?', [ $id ]));
});

Route::run();*/

session_set_save_handler(new DatabaseSessionHandler());

session_start();

$_SESSION['message'] = 'Hello, wolrd';
$_SESSION['foo'] = new stdClass();

?>

