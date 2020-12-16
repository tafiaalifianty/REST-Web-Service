@extends('layouts.member')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ticket by ID') }}</div>

                <div class="card-body">

                    <div class="text-center">
                        <span class="success text-success"></span>
                        <span class="error text-danger"></span>
                    </div>

                    <form id="form">
                        @csrf

                        <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Order ID') }}</label>

                            <div class="col-md-6">
                                <input id="order_id" type="text" class="form-control" name="order_id" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bus_name" class="col-md-4 col-form-label text-md-right">{{ __('Bus Name') }}</label>

                            <div class="col-md-6">
                                <input id="bus_name" type="text" class="form-control" name="bus_name" value="" required autocomplete="bus_name" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ticket_amount" class="col-md-4 col-form-label text-md-right">{{ __('Ticket Amount') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_amount" type="number" class="form-control" name="ticket_amount" value="" required autocomplete="ticket_amount" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seat_position" class="col-md-4 col-form-label text-md-right">{{ __('Seat Position') }}</label>

                            <div class="col-md-6">
                                <input id="seat_position" type="text" class="form-control" name="seat_position" value="" required autocomplete="seat_position" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departure_city" class="col-md-4 col-form-label text-md-right">{{ __('Departure City') }}</label>

                            <div class="col-md-6">
                                <input id="departure_city" type="text" class="form-control" name="departure_city" value="" required autocomplete="departure_city" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departure_bus_station" class="col-md-4 col-form-label text-md-right">{{ __('Departure Bus Station') }}</label>

                            <div class="col-md-6">
                                <input id="departure_bus_station" type="text" class="form-control" name="departure_bus_station" value="" required autocomplete="departure_bus_station" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departure_date" class="col-md-4 col-form-label text-md-right">{{ __('Departure Date') }}</label>

                            <div class="col-md-6">
                                <input id="departure_date" type="text" class="form-control" name="departure_date" value="" required autocomplete="departure_date" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrived_city" class="col-md-4 col-form-label text-md-right">{{ __('Arrived City') }}</label>

                            <div class="col-md-6">
                                <input id="arrived_city" type="text" class="form-control" name="arrived_city" value="" required autocomplete="arrived_city" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrived_bus_station" class="col-md-4 col-form-label text-md-right">{{ __('Arrived Bus Station') }}</label>

                            <div class="col-md-6">
                                <input id="arrived_bus_station" type="text" class="form-control" name="arrived_bus_station" value="" required autocomplete="arrived_bus_station" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrived_date" class="col-md-4 col-form-label text-md-right">{{ __('Arrived Date') }}</label>

                            <div class="col-md-6">
                                <input id="arrived_date" type="text" class="form-control" name="arrived_date" value="" required autocomplete="arrived_date" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary save-data">
                                    {{ __('View Ticket') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>

    $(".save-data").click(function(event){
        event.preventDefault();

        let order_id = $("input[name=order_id]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        console.log(order_id);

        $.ajax({
          url: "/api/v1/ticket/" + order_id,
          type:"GET",
          beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success:function(response){
            console.log(response);
            $("input[name=bus_name]").val(response.data.bus_name);
            $("input[name=ticket_amount]").val(response.data.ticket_amount);
            $("input[name=seat_position]").val(response.data.seat_position);
            $("input[name=departure_city]").val(response.data.departure_city);
            $("input[name=departure_bus_station]").val(response.data.departure_bus_station);
            $("input[name=departure_date]").val(response.data.departure_date);
            $("input[name=arrived_city]").val(response.data.arrived_city);
            $("input[name=arrived_bus_station]").val(response.data.arrived_bus_station);
            $("input[name=arrived_date]").val(response.data.arrived_date);
            if(response) {
              $('.success').text("Ticket ditemukan");
              $('.error').text("");
            }
          },
          error:function(xhr){
            $("input").val("");
            $('.error').text(xhr.responseJSON.message);
            $('.success').text("");
          }
        });
    });
</script>
@endpush
