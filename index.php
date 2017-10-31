<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

use \RedBeanPHP\R as R;

$app = new Silex\Application();
/*
$pizzas = array(
      1 => array('id' => 1, 'name' => 'fromage', 'status' => ''),
      2 => array('id' => 2, 'name' => 'anchois', 'status' => ''),
      3 => array('id' => 3, 'name' => '4 fromage', 'status' => ''),
      4 => array('id' => 4, 'name' => 'jambon', 'status' => '')
);
*/
R::setup( 'mysql:host=localhost;dbname=pizzastore', 'root', '' );

$app->POST('/v2/pizzas', function(Application $app, Request $request) {
            $data = json_decode($request->getContent());
            $pizza = R::dispense('pizza');
            $pizza->name = $data->name;
            $pizza->status = $data->status;
            $id = R::store($pizza);
            return new Response('{"pizzaId":"'.$id.'","state":"added"}');
            });


$app->DELETE('/v2/pizzas/{pizzaId}', function(Application $app, Request $request, $pizzaId) {
            $pizza = R::load('pizza',$pizzaId);
            R::trash($pizza);
            return new Response('{"pizzaId":"'.$pizzaId.'","state":"deleted"}');
            });

/*
$app->GET('/v2/pizzas/findByStatus', function(Application $app, Request $request) {
            $status = $request->get('status');
            return new Response('How about implementing findPizzasByStatus as a GET method ?');
            });
*/
/*
$app->GET('/v2/pizzas/findByTags', function(Application $app, Request $request) {
            $tags = $request->get('tags');
            return new Response('How about implementing findPizzasByTags as a GET method ?');
            });
*/
$app->GET('/v2/pizzas', function(Application $app, Request $request) {
            $pizzas = R::findAll('pizza');
            $data = json_encode($pizzas);
            return new Response($data);
            });

$app->GET('/v2/pizzas/{pizzaId}', function(Application $app, Request $request, $pizzaId) {
            $pizza = R::load( 'pizza', $pizzaId );
            $data = json_encode($pizza);
            return new Response($data);
            });

/*
$app->PUT('/v2/pizzas', function(Application $app, Request $request) {
            return new Response('How about implementing updatePizza as a PUT method ?');
            });

*/
$app->POST('/v2/pizzas/{pizzaId}', function(Application $app, Request $request, $pizzaId) {
            $data = json_decode($request->getContent());
            $pizza = R::load( 'pizza', $pizzaId );
            $pizza->name = $data->name;
            $pizza->status = $data->status;
            $id = R::store( $pizza );
            return new Response('{"pizzaId":"'.$id.'","state":"updated"}');
            });

/*
$app->POST('/v2/pizzas/{pizzaId}/uploadImage', function(Application $app, Request $request, $pizzaId) {
            $additional_metadata = $request->get('additional_metadata');
            $file = $request->get('file');
            return new Response('How about implementing uploadFile as a POST method ?');
            });
*/
/*
$app->DELETE('/v2/store/orders/{orderId}', function(Application $app, Request $request, $orderId) {
            return new Response('How about implementing deleteOrder as a DELETE method ?');
            });


$app->GET('/v2/store/inventory', function(Application $app, Request $request) {
            return new Response('How about implementing getInventory as a GET method ?');
            });


$app->GET('/v2/store/orders/{orderId}', function(Application $app, Request $request, $orderId) {
            return new Response('How about implementing getOrderById as a GET method ?');
            });


$app->POST('/v2/store/orders', function(Application $app, Request $request) {
            return new Response('How about implementing placeOrder as a POST method ?');
            });
*/
/*
$app->POST('/v2/user', function(Application $app, Request $request) {
            return new Response('How about implementing createUser as a POST method ?');
            });


$app->POST('/v2/user/createWithArray', function(Application $app, Request $request) {
            return new Response('How about implementing createUsersWithArrayInput as a POST method ?');
            });


$app->POST('/v2/user/createWithList', function(Application $app, Request $request) {
            return new Response('How about implementing createUsersWithListInput as a POST method ?');
            });


$app->DELETE('/v2/user/{username}', function(Application $app, Request $request, $username) {
            return new Response('How about implementing deleteUser as a DELETE method ?');
            });


$app->GET('/v2/user/{username}', function(Application $app, Request $request, $username) {
            return new Response('How about implementing getUserByName as a GET method ?');
            });


$app->GET('/v2/user/login', function(Application $app, Request $request) {
            $username = $request->get('username');
            $password = $request->get('password');
            return new Response('How about implementing loginUser as a GET method ?');
            });


$app->GET('/v2/user/logout', function(Application $app, Request $request) {
            return new Response('How about implementing logoutUser as a GET method ?');
            });


$app->PUT('/v2/user/{username}', function(Application $app, Request $request, $username) {
            return new Response('How about implementing updateUser as a PUT method ?');
            });

*/
$app->run();
