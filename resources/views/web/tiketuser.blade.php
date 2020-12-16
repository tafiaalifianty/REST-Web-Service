@extends('layouts.member')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ticket by User ID') }}</div>

                <div class="card-body">

                    <div class="text-center">
                        <span class="success text-success"></span>
                        <span class="error text-danger"></span>
                    </div>

                    <form id="form">
                        @csrf

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="text" class="form-control" name="user_id" required autocomplete="user_id">
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
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tickets
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Order ID</th>
                                <th>Bus Name</th>
                                <th>Ticket Amount</th>
                                <th>Seat Position</th>
                                <th>Departure City</th>
                                <th>Departure Bus Station</th>
                                <th>Departure Date</th>
                                <th>Arrived City</th>
                                <th>Arrived Bus Station</th>
                                <th>Arrived City</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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

        let user_id = $("input[name=user_id]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/api/v1/ticket/user/" + user_id,
          type:"GET",
          beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success:function(response){
            if(response) {
                results = '';
                $.each(response.data, function(id, row){
                    results += '<tr><td>' + row.user_id + '</td><td>' + row.order_id + '</td><td>' + row.bus_name + '</td><td>' + row.ticket_amount + '</td><td>' + row.seat_position + '</td><td>' + row.departure_city + '</td><td>' + row.departure_bus_station + '</td><td>' + row.departure_date + '</td><td>' + row.arrived_city + '</td><td>' + row.arrived_bus_station + '</td><td>' + row.arrived_date + '</td></tr>';
                });
                $('.table tbody').html(results);
                $('.success').text("Ticket ditemukan");
                $('.error').text("");
            }
          },
          error:function(xhr){
            $("input").val("");
            $('.error').text(xhr.responseJSON.message);
            $('.success').text("");
            $('.table tbody').html("");
          }
        });
    });
</script>
@endpush
