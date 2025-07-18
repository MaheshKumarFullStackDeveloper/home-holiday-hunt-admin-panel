@extends('adminlte::page')

@section('title', 'Feedback Details')

@section('content_header')
@stop
 
@section('content')
<div class="container">
   
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Feedback Details</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
           
        
            <form class="form_wrap">
              

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->email }}" readonly>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->user->first_name ?? '' }} {{ $contactUsMessage->user->last_name ?? '' }}" readonly>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input class="form-control" placeholder="(+{{ $contactUsMessage->user->country_code ?? '' }}) {{ $contactUsMessage->user->phone_number ?? ''}}" readonly>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Message</label>
                    <div style="background-color: #efefef; padding: 15px; border-radius: 5px;"> {{  $contactUsMessage->message }}<div>
                  </div>
                </div>
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


@section('js')
 
@stop