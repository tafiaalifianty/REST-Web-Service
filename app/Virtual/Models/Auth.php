<?php 

/**
 * @OA\Schema(
 *     title="Auth",
 *     description="Auth model",
 *     @OA\Xml(
 *         name="Auth"
 *     )
 * )
 */
class Auth
{
  /**
   * @OA\Property(
   *      title="Access token",
   *      description="JWT access token",
   *      example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE2MDY0NTc2MDksImV4cCI6MTYwNjQ2MTIwOSwibmJmIjoxNjA2NDU3NjA5LCJqdGkiOiJBY29DeWJrRUN2dVdnRjA4Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.ImW2CEVjdNxEYaVA-bVUc5wFL5IyPbuXIxeIep_QzKo"
   * )
   *
   * @var string
   */
  public $access_token;

  /**
   * @OA\Property(
   *      title="Token type",
   *      description="Authentication token type",
   *      example="bearer"
   * )
   *
   * @var string
   */
  public $token_type;

  /**
   * @OA\Property(
   *      title="Expires in",
   *      description="Token expires duration",
   *      example=3600,
   *      type="integer"
   * )
   *
   * @var integer
   */
  public $expires_in;

  /**
   * @OA\Property(
   *      title="User",
   *      description="User data",
   * )
   *
   * @var \App\Virtual\Models\User
   */
  public $user;
}