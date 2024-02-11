<?php

namespace App\controllers\auth;

use App\models\User;
use App\validators\UserValidator;
use Psr\Http\Message\ResponseInterface;
use Stag\Auth\Auth;

class AuthController
{
  protected User $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function login(): ResponseInterface
  {
    $data = json_decode(request()->getBody()->getContents(), true);
    $user = $this->user->getUserByEmail($data['email']);

    if (Auth::attempt($user, $data['password'])) {;
      return json_response(['Succsefull']);
    }
    return json_response(['Invalid credentials']);
  }

  public function createUser(UserValidator $validator): ResponseInterface
  {
    $data = json_decode(request()->getBody()->getContents(), true);
    $isValid = $validator->validate($data);

    if ($isValid) {
      $user = $validator->getValidatedData();
      $this->user->createUser($user);

      Auth::login($user);
      return json_response(["User registered"]);
    } else {
      $errors = $validator->getErrors();
      return json_response($errors);
    }
  }

  public function logout(): ResponseInterface
  {
    Auth::logout();
    return json_response(['User logout']);
  }
}
