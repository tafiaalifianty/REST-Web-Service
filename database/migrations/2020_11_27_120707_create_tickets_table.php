<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('bus_name');
            $table->unsignedInteger('ticket_amount')->default(1);
            $table->string('seat_position');
            $table->string('departure_city');
            $table->string('departure_bus_station');
            $table->dateTime('departure_date');
            $table->string('arrived_city');
            $table->string('arrived_bus_station');
            $table->dateTime('arrived_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
