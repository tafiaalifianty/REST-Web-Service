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

  
}