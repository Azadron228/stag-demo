<?php

use App\controllers\auth\AuthController;
use App\middlewares\AuthMiddleware;
use Stag\Auth\Auth;
use Stag\Routing\Router;

return function (Router $router) {
  $router->post('/register', [AuthController::class, 'createUser']);
  $router->post('/login', [AuthController::class, 'login']);
  $router->post('/logout', [AuthController::class, 'logout']);

  $router->get('/user', function(){
    // echo "this is controllers";
    $user = Auth::id();
    return json_response(['User id is' . $user]);
  })->middleware([AuthMiddleware::class]);
};
