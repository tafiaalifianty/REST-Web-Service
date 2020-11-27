<?php

/**
 * @OA\Schema(
 *      title="Payment Request",
 *      description="Payment request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */

class PaymentRequest
{
  /**
   * @OA\Property(
   *      title="payment_amount",
   *      description="Amount of payment",
   *      example=12000
   * )
   *
   * @var integer
   */
  public $payment_amount;

  /**
   * @OA\Property(
   *      title="payment_proof",
   *      description="Image of payment proof",
   *      example="base64:image"
   * )
   *
   * @var string
   */
  public $payment_proof;

  /**
   * @OA\Property(
   *      title="bank_name",
   *      description="Name of the bank",
   *      example="Mandiri"
   * )
   *
   * @var string
   */
  public $bank_name;

  /**
   * @OA\Property(
   *      title="bank_account",
   *      description="Bank account",
   *      example="123456789"
   * )
   *
   * @var string
   */
  public $bank_account;
}