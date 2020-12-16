@extends('layouts.member')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Order') }}</div>

                <div class="card-body">

                    <div class="text-center">
                        <span class="success text-success"></span>
                    </div>

                    <form id="form">
                        @csrf

                        <div class="form-group row">
                            <label for="bus_name" class="col-md-4 col-form-label text-md-right">{{ __('Bus Name') }}</label>

                            <div class="col-md-6">
                                <input id="bus_name" type="text" class="form-control" name="bus_name" value="" required autocomplete="bus_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ticket_amount" class="col-md-4 col-form-label text-md-right">{{ __('Ticket Amount') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_amount" type="number" class="form-control" name="ticket_amount" value="" required autocomplete="ticket_amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seat_position" class="col-md-4 col-form-label text-md-right">{{ __('Seat Position') }}</label>

                            <div class="col-md-6">
                                <input id="seat_position" type="text" class="form-control" name="seat_position" value="" required autocomplete="seat_position">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departure_city" class="col-md-4 col-form-label text-md-right">{{ __('Departure City') }}</label>

                            <div class="col-md-6">
                                <input id="departure_city" type="text" class="form-control" name="departure_city" value="" required autocomplete="departure_city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departure_bus_station" class="col-md-4 col-form-label text-md-right">{{ __('Departure Bus Station') }}</label>

                            <div class="col-md-6">
                                <input id="departure_bus_station" type="text" class="form-control" name="departure_bus_station" value="" required autocomplete="departure_bus_station">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departure_date" class="col-md-4 col-form-label text-md-right">{{ __('Departure Date') }}</label>

                            <div class="col-md-6">
                                <input id="departure_date" type="date" class="form-control" name="departure_date" value="" required autocomplete="departure_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrived_city" class="col-md-4 col-form-label text-md-right">{{ __('arrived City') }}</label>

                            <div class="col-md-6">
                                <input id="arrived_city" type="text" class="form-control" name="arrived_city" value="" required autocomplete="arrived_city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrived_bus_station" class="col-md-4 col-form-label text-md-right">{{ __('arrived Bus Station') }}</label>

                            <div class="col-md-6">
                                <input id="arrived_bus_station" type="text" class="form-control" name="arrived_bus_station" value="" required autocomplete="arrived_bus_station">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrived_date" class="col-md-4 col-form-label text-md-right">{{ __('arrived Date') }}</label>

                            <div class="col-md-6">
                                <input id="arrived_date" type="date" class="form-control" name="arrived_date" value="" required autocomplete="arrived_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_price" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>

                            <div class="col-md-6">
                                <input id="total_price" type="number" class="form-control" name="total_price" value="" required autocomplete="total_price">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary save-data">
                                    {{ __('Create Order') }}
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

        let bus_name = $("input[name=bus_name]").val();
        let ticket_amount = $("input[name=ticket_amount]").val();
        let seat_position = $("input[name=seat_position]").val();
        let departure_city = $("input[name=departure_city]").val();
        let departure_bus_station = $("input[name=departure_bus_station]").val();
        let departure_date = $("input[name=departure_date]").val();
        let arrived_city = $("input[name=arrived_city]").val();
        let arrived_bus_station = $("input[name=arrived_bus_station]").val();
        let arrived_date = $("input[name=arrived_date]").val();
        let total_price = $("input[name=total_price]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/api/v1/pembelian/" + localStorage.getItem('id'),
          type:"POST",
          data:{
            bus_name:bus_name,
            ticket_amount:ticket_amount,
            seat_position:seat_position,
            departure_city:departure_city,
            departure_bus_station:departure_bus_station,
            departure_date:departure_date,
            arrived_city:arrived_city,
            arrived_bus_station:arrived_bus_station,
            arrived_date:arrived_date,
            total_price:total_price,
            _token: _token
          },
          beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success:function(response){
            console.log(response);
            if(response) {
              $('.success').text("Order berhasil");
            }
          },
        });
    });
</script>
@endpush
