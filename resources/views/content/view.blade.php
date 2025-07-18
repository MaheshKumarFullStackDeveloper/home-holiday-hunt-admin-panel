@extends('adminlte::page')

@section('title', 'Website Page Content')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3 class="w-100">Website Page Content</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form class="form_wrap">
              
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="{{ $pageContent->title }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>View</label>
                    <input class="form-control" placeholder="{{ ucfirst($pageContent->device_type) }}" readonly>
                  </div>
                </div>
              </div>
              
             

              
              
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Content</label>
                    {{-- <textarea  disabled="disabled"  style="height:300px;" class="form-control" id="content" name="content">{{ $pageContent->content }}</textarea> --}}
                    <div class="view_content" style="background-color: #f6f7fb; padding: 20px 20px 4px; border-radius: 5px; height: auto;">{!! $pageContent->content !!}<div>
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