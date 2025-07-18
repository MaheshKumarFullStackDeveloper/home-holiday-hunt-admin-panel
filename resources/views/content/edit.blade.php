@extends('adminlte::page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
@section('title', 'Edit Website Content')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3 class="w-100">Edit Website Content</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editContentForm" method="post" action="{{ route('content.mobilePage.update') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="page_title">Title</label>
                  <input type="hidden" name="id" value="{{ $pageContent->id }}" readonly>
                  <input type="title" name="title" class="form-control" id="page_title" value="{{ $pageContent->title }}" readonly>
                  @if($errors->has('title'))
                    <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>

                 @if($pageContent->id == '5')
                
                  <div class="form-group">
                    <label for="content">Set Time</label>
                    <input type="text" class="form-control" id="datetimepicker" name="datetimepicker" value="{{ $pageContent->content }}">
                    </div>
                 @elseif($pageContent->id == '6')
                    <div class="form-group">
                      <label for="content">Set Year</label>
                      <input type="text" class="form-control" id="datepicker" name="datepicker" value="{{ $pageContent->content }}">
                    </div>
                 @else
                  <div class="form-group">
                    <label for="content">Page Content</label>
                    <textarea  class="form-control" id="content" name="content">{{ $pageContent->content }}</textarea>
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="content" class="custom-control-input">
                    @if($errors->has('content'))
                      <div class="error">{{ $errors->first('content') }}</div>
                    @endif
                    </div>
                  </div>
                @endif
                
                
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


<script>
      $(document).ready(function() {
        $('#datetimepicker'). datetimepicker({
          format:'M d, Y H:00:00',
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years",
            startDate: "2022",
          endDate: "currentDate",
            maxDate: "currentDate"
        });
      });
     
</script>







  <script>
    $(document).ready(function() {
    CKEDITOR.replace( 'content', {
    allowedContent : true,
    customConfig: '',
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    extraPlugins: 'tableresize,uploadimage',
    height: 800,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css' ],
    bodyClass: 'document-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );

    CKEDITOR.replace( 'content_spanish', {
    allowedContent : true,
    customConfig: '',
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    extraPlugins: 'tableresize,uploadimage',
    height: 800,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css' ],
    bodyClass: 'document-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );


    CKEDITOR.replace( 'content_chinease', {
    allowedContent : true,
    customConfig: '',
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    extraPlugins: 'tableresize,uploadimage',
    height: 800,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css' ],
    bodyClass: 'document-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );


    CKEDITOR.replace( 'content_portuguese', {
    allowedContent : true,
    customConfig: '',
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    extraPlugins: 'tableresize,uploadimage',
    height: 800,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css' ],
    bodyClass: 'document-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );

    CKEDITOR.replace( 'content_arabic', {
    allowedContent : true,
    customConfig: '',
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    extraPlugins: 'tableresize,uploadimage',
    height: 800,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css' ],
    bodyClass: 'document-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );

    CKEDITOR.replace( 'content_hindi', {
    allowedContent : true,
    customConfig: '',
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    extraPlugins: 'tableresize,uploadimage',
    height: 800,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css' ],
    bodyClass: 'document-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );  


      $("#editContentForm").submit( function(e) {
            $(".text-danger").hide();
            var content = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
            if(!content){
                $("<span class='text-danger content_error'></span>").insertAfter($("#content"));
                $(".content_error").text('Content is required');
                e.preventDefault();
            }
            var content_spanish = CKEDITOR.instances['content_spanish'].getData().replace(/<[^>]*>/gi, '').length;
            if(!content_spanish){
                $("<span class='text-danger content_spanish_error'></span>").insertAfter($("#content_spanish"));
                $(".content_spanish_error").text('Content is required');
                e.preventDefault();
            }
            var content_chinease = CKEDITOR.instances['content_chinease'].getData().replace(/<[^>]*>/gi, '').length;
            if(!content_chinease){
                $("<span class='text-danger content_chinease_error'></span>").insertAfter($("#content_chinease"));
                $(".content_chinease_error").text('Content is required');
                e.preventDefault();
            }
            var content_portuguese = CKEDITOR.instances['content_portuguese'].getData().replace(/<[^>]*>/gi, '').length;
            if(!content_portuguese){
                $("<span class='text-danger content_portuguese_error'></span>").insertAfter($("#content_portuguese"));
                $(".content_portuguese_error").text('Content is required');
                e.preventDefault();
            }
            var content_hindi = CKEDITOR.instances['content_hindi'].getData().replace(/<[^>]*>/gi, '').length;
            if(!content_hindi){
                $("<span class='text-danger content_hindi_error'></span>").insertAfter($("#content_hindi"));
                $(".content_hindi_error").text('Content is required');
                e.preventDefault();
            }
            var content_arab = CKEDITOR.instances['content_arabic'].getData().replace(/<[^>]*>/gi, '').length;
            if(!content_arab){
                $("<span class='text-danger content_arab_error'></span>").insertAfter($("#content_arabic"));
                $(".content_arab_error").text('Content is required');
                e.preventDefault();
            }
        }); 
    }); 
  </script>
@stop
