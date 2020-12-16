@extends('layouts.member')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Payment') }}</div>

                <div class="card-body">

                    <div class="text-center">
                        <span class="success text-success"></span>
                        <span class="error text-danger"></span>
                    </div>

                    <form id="form-payment" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Order ID') }}</label>

                            <div class="col-md-6">
                                <input id="order_id" type="text" class="form-control" name="order_id" value="" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_amount" class="col-md-4 col-form-label text-md-right">{{ __('Payment Amount') }}</label>

                            <div class="col-md-6">
                                <input id="payment_amount" type="text" class="form-control" name="payment_amount" value="" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_proof" class="col-md-4 col-form-label text-md-right">{{ __('Payment Proof') }}</label>

                            <div class="col-md-6">
                                <input id="payment_proof" type="file" class="form-control" name="payment_proof" value="" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control" name="bank_name" value="" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_account" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>

                            <div class="col-md-6">
                                <input id="bank_account" type="text" class="form-control" name="bank_account" value="" required autocomplete="order_id">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary save-data">
                                    {{ __('Pay Now') }}
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

    $('#form-payment').on('submit', function(event){
        event.preventDefault();

        let order_id = $("input[name=order_id]").val();

        $.ajax({
          url: "/api/v1/pembayaran/" + order_id,
          type:"POST",
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
          },
          success:function(response){
            if(response.status == 200) {
              $('.success').text("Payment berhasil");
              $('.error').text("");
            }
          },
          error:function(xhr){
            $('.error').text(xhr.responseJSON.message);
            $('.success').text("");
          }
        });
    });
</script>
@endpush
