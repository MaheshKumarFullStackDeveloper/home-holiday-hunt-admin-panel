@extends('adminlte::page')

@section('title', 'Payment Transaction Details')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Payment Transaction Details</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form class="form_wrap">
 
         

            <div class="row">
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Transaction ID</label>
                  <input class="form-control" placeholder="{{ $transactionView->txn_id }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Amount</label>
                  <input class="form-control" placeholder="{{ $transactionView->amount }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Status</label>
                  <input class="form-control" placeholder="{{ $transactionView->status }}" readonly>
                </div>
              </div>

                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Paid At</label>
                  <input class="form-control" placeholder="{!! date('Y/m/d H:i', strtotime($transactionView->created_at)) !!}" readonly>
                </div>
              </div>


                  <div class="col-sm-6 col-md-12 col-lg-12 col-xl-12 col-12">
                <div class="form-group">
                  <label>Description</label>
                  <input class="form-control" placeholder="{{ $transactionView->description }}" readonly>
                </div>
              </div>
           
 
 


                    
             
             
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</div>
@endsection

@section('css')
 

@stop

@section('js')
@stop
