<?php

namespace App\validators;

use Stag\Validator\Validator;

class LoginValidator extends Validator
{
  public function validate(array $data)
  {
    $rules = [
      'username' => 'required|min:3',
      'email' => 'required',
      'password' => 'required|max:255',
    ];

    return $this->make($data, $rules);
  }
}
