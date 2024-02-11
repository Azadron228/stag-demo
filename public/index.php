<?php

use App\Kernel;
use App\middlewares\AuthMiddleware;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ServerRequestInterface;
use Stag\Auth\Auth;
use Stag\Container\Container;
use Stag\Routing\Dispatcher;
use Stag\Routing\Router;

require __DIR__ . '/../vendor/autoload.php';

define('APP_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

$kernel = new Kernel();
$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
  $psr17Factory, // ServerRequestFactory
  $psr17Factory, // UriFactory
  $psr17Factory, // UploadedFileFactory
  $psr17Factory  // StreamFactory
);

// $con = new Container();
$request = $creator->fromGlobals();

// $router = new Router($con);

// public function handleRequest(ServerRequestInterface $request)
// {
// $this->handleMiddleware($request);

// $router->get('/user/{name}', function(){
//     echo "this is controllers";
//     // $user = Auth::id();
//     // return json_response(['User id is' . $user]);
//     return response();
//   })->middleware([AuthMiddleware::class]);
//
// $controller = function (ServerRequestInterface $request) {
//     // Your controller logic here
// };

// $dispatcher = new Dispatcher($router, [], $controller);

// $response = $dispatcher->handle($request);


// $response = $router->dispatch($request);

    // (new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
  // }
$kernel->handleRequest($request);
