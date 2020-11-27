<?php

/**
 * @OA\Schema(
 *      title="Order Request",
 *      description="Order request body data",
 *      type="object"
 * )
 */

class OrderRequest
{
  /**
   * @OA\Property(
   *      title="bus_name",
   *      description="Bus name",
   *      example="Sumber Selamat"
   * )
   *
   * @var string
   */
  public $bus_name;

  /**
   * @OA\Property(
   *      title="ticket_amount",
   *      description="Amount of the ticket",
   *      example=1
   * )
   *
   * @var integer
   */
  public $ticket_amount;

  /**
   * @OA\Property(
   *      title="seat_position",
   *      description="Seat position",
   *      example="A1"
   * )
   *
   * @var string
   */
  public $seat_position;

  /**
   * @OA\Property(
   *      title="departure_city",
   *      description="Departure city",
   *      example="Surabaya"
   * )
   *
   * @var string
   */
  public $departure_city;

  /**
   * @OA\Property(
   *      title="departure_bus_station",
   *      description="Departure bus station name",
   *      example="Purabaya"
   * )
   *
   * @var string
   */
  public $departure_bus_station;

  /**
   * @OA\Property(
   *      title="departure_date",
   *      description="Departure date time",
   *      example="2020-11-27 01:55:43"
   * )
   *
   * @var \DateTime
   */
  public $departure_date;

  /**
   * @OA\Property(
   *      title="arrived_city",
   *      description="Arrived city",
   *      example="Yogyakarta"
   * )
   *
   * @var string
   */
  public $arrived_city;

  /**
   * @OA\Property(
   *      title="arrived_bus_station",
   *      description="Arrived bus station name",
   *      example="Lempuyangan"
   * )
   *
   * @var string
   */
  public $arrived_bus_station;

  /**
   * @OA\Property(
   *      title="arrived_date",
   *      description="Arrived date time",
   *      example="2020-11-27 01:55:43"
   * )
   *
   * @var \DateTime
   */
  public $arrived_date;

  /**
   * @OA\Property(
   *      title="total_price",
   *      description="Total price",
   *      example=12000
   * )
   *
   * @var integer
   */
  public $total_price;
}