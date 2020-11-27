<?php

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */

class User {
  /**
   * @OA\Property(
   *     title="ID",
   *     description="ID",
   *     format="int64",
   *     example=1
   * )
   *
   * @var integer
   */
  private $id;

   /**
   * @OA\Property(
   *      title="Name",
   *      description="Name of the user",
   *      example="John Doe"
   * )
   *
   * @var string
   */
  public $name; 

  /**
   * @OA\Property(
   *      title="Email",
   *      description="Email of the user",
   *      example="johndoe@mail.com"
   * )
   *
   * @var string
   */
  public $email; 

  /**
   * @OA\Property(
   *      title="Email verified datetime",
   *      description="Email verified datetime of the user",
   *      example="2020-11-27 01:55:43",
   *      format="datetime",
   *      type="string"
   * )
   *
   * @var \DateTime
   */
  public $email_verified_at;

  /**
   * @OA\Property(
   *      title="Age",
   *      description="Age of the user",
   *      example="1",
   * )
   *
   * @var integer
   */
  public $age; 

  /**
   * @OA\Property(
   *      title="City",
   *      description="City of the user",
   *      example="Los Angeles"
   * )
   *
   * @var string
   */
  public $city; 

  /**
   * @OA\Property(
   *      title="Created at",
   *      description="Created at",
   *      example="2020-11-27 01:55:43",
   *      format="datetime",
   *      type="string"
   * )
   *
   * @var \DateTime
   */
  public $created_at;

  /**
   * @OA\Property(
   *      title="Updated at",
   *      description="Updated at",
   *      example="2020-11-27 01:55:43",
   *      format="datetime",
   *      type="string"
   * )
   *
   * @var \DateTime
   */
  public $updated_at;
}