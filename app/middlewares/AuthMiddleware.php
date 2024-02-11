<?php

namespace App\middlewares;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stag\Auth\Auth;

class AuthMiddleware implements MiddlewareInterface
{
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    if (!Auth::isAuthenticated()) {
      // return response(302, ['Location' => '/'])->getBody()->write('User is unauthrozed');
      // return new Response(302, ['Location' => '/']);
      return json_response(['user is unauthrozed']);
    }

    // echo "User is Authorized ";
      // return new Response(302, ['Location' => '/']);
    return $handler->handle($request);
  }
}
