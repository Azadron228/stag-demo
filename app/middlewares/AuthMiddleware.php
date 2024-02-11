<?php

namespace App\middlewares;

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
      return json_response(['user is unauthrozed']);
    }

    return $handler->handle($request);
  }
}
