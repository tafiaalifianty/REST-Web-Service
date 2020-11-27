<?php

/**
 * @OA\Schema(
 *     title="Order",
 *     description="Order model",
 *     @OA\Xml(
 *         name="Order"
 *     )
 * )
 */

class Order {
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
  public $id;

   /**
   * @OA\Property(
   *      title="User ID",
   *      description="User ID",
   *      example=1
   * )
   *
   * @var string
   */
  public $user_id; 

  /**
   * @OA\Property(
   *      title="Total price",
   *      description="Total price",
   *      example=12000,
   * )
   *
   * @var integer
   */
  public $total_price; 

  /**
   * @OA\Property(
   *      title="Status",
   *      description="Order status",
   *      example="waiting_payment"
   * )
   *
   * @var string
   */
  public $status; 

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