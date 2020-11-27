<?php

/**
 * @OA\Schema(
 *      title="Register Request",
 *      description="Register request body data",
 *      type="object",
 *      required={"email", "password", "password_confirmation", "age", "city"}
 * )
 */

class RegisterRequest
{
  /**
   * @OA\Property(
   *      title="email",
   *      description="Email",
   *      example="johndoe@mail.com"
   * )
   *
   * @var string
   */
  public $email;

  /**
   * @OA\Property(
   *      title="password",
   *      description="Password",
   *      example="yourpassword"
   * )
   *
   * @var string
   */
  public $password;

  /**
   * @OA\Property(
   *      title="password_confirmation",
   *      description="Password confirmation",
   *      example="yourpassword"
   * )
   *
   * @var string
   */
  public $password_confirmation;

  /**
   * @OA\Property(
   *      title="age",
   *      description="Age",
   *      example=18,
   *      type="integer"
   * )
   *
   * @var integer
   */
  public $age;

  /**
   * @OA\Property(
   *      title="city",
   *      description="City",
   *      example="Los Angeles"
   * )
   *
   * @var string
   */
  public $city;
}