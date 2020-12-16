@extends('layouts.member')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Get Order') }}</div>

                <div class="card-body">

                    <div class="text-center">
                        <span class="success text-success"></span>
                    </div>

                    <form id="form">
                        @csrf

                        <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Order ID') }}</label>

                            <div class="col-md-6">
                                <input id="order_id" type="text" class="form-control" name="order_id" value="" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="number" class="form-control" name="user_id" value="" required autocomplete="user_id" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_price" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>

                            <div class="col-md-6">
                                <input id="total_price" type="number" class="form-control" name="total_price" value="" required autocomplete="total_price" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control" name="status" value="" required autocomplete="status" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Created At') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" class="form-control" name="created_at" value="" required autocomplete="created_at" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="updated_at" class="col-md-4 col-form-label text-md-right">{{ __('Updated At') }}</label>

                            <div class="col-md-6">
                                <input id="updated_at" type="text" class="form-control" name="updated_at" value="" required autocomplete="updated_at" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary save-data">
                                    {{ __('Get Order') }}
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

        $.ajax({
          url: "/api/v1/pembelian/" + order_id,
          type:"GET",
          beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success:function(response){
            $("input[name=user_id]").val(response.data.user_id);
            $("input[name=total_price]").val(response.data.total_price);
            $("input[name=status]").val(response.data.status);
            $("input[name=created_at]").val(response.data.created_at);
            $("input[name=updated_at]").val(response.data.updated_at);
          },
        });
    });
</script>
@endpush
