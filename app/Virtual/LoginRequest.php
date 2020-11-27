<?php

/**
 * @OA\Schema(
 *      title="Login Request",
 *      description="Login request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */

class LoginRequest
{
  /**
   * @OA\Property(
   *      title="email",
   *      description="Email of the user",
   *      example="johndoe@mail.com"
   * )
   *
   * @var string
   */
  public $email;

  /**
   * @OA\Property(
   *      title="password",
   *      description="Password of the user",
   *      example="yourpassword"
   * )
   *
   * @var string
   */
  public $password;
}