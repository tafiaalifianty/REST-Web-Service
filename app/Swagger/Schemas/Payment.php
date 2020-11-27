<?php

/**
 * @OA\Schema(
 *     title="Payment",
 *     description="Payment model",
 *     @OA\Xml(
 *         name="Payment"
 *     )
 * )
 */

class Payment {
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
   *      title="Order ID",
   *      description="Order ID",
   *      example=1
   * )
   *
   * @var string
   */
  public $order_id; 

  /**
   * @OA\Property(
   *      title="Total amount",
   *      description="Total amount",
   *      example=12000,
   * )
   *
   * @var integer
   */
  public $payment_amount; 

  /**
   * @OA\Property(
   *      title="Payment proof",
   *      description="URL of image of payment proof",
   *      example="http://localhost/images/12345678.png"
   * )
   *
   * @var string
   */
  public $payment_proof; 

  /**
   * @OA\Property(
   *      title="Bank name",
   *      description="Bank name",
   *      example="Mandiri"
   * )
   *
   * @var string
   */
  public $bank_name; 

  /**
   * @OA\Property(
   *      title="Bank account",
   *      description="Bank account",
   *      example="123456789"
   * )
   *
   * @var string
   */
  public $bank_account; 

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