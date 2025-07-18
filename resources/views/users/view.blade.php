@extends('adminlte::page')
<style>
  #gallery {
    padding-top: 0px;
  }
  button.btn.btn-primary.common_btn {
    background: #1c355e !important;
    text-align: center;
}
.card-footer.text-left {
    display: flex;
    justify-content: center;
    align-items: center;
}
  @media screen and (min-width: 991px) {
#gallery {
    padding: 0px;
}
  }
  
  .img-wrapper {
    position: relative;
    margin-top: 15px;
  }
.img-wrapper img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
  
  .img-overlay {
    background: rgba(0, 0, 0, 0.7);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    cursor: pointer;
  }
.img-overlay i {
    color: #fff;
    font-size: 3em;
    width: 770px;
    height: 600px;
    display: none;
}
  div#nextButton, div#exitButton {
    cursor: pointer;
}
  
#overlay {
    background: rgb(173 165 165 / 70%);
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
  #overlay img {
    margin: 0;
    width: 80%;
    height: auto;
    -o-object-fit: contain;
       object-fit: contain;
    padding: 5%;
  }
  @media screen and (min-width: 768px) {
    #overlay img {
      width: 60%;
    }
  }
  @media screen and (min-width: 1200px) {
    #overlay img {
      width: 50%;
    }
  }
  
  #nextButton {
    color: #fff;
    font-size: 2em;
    transition: opacity 0.8s;
  }
  #nextButton:hover {
    opacity: 0.7;
  }
  @media screen and (min-width: 768px) {
    #nextButton {
      font-size: 3em;
    }
  }
  
  #prevButton {
    color: #fff;
    font-size: 2em;
    transition: opacity 0.8s;
  }
  #prevButton:hover {
    opacity: 0.7;
  }
  @media screen and (min-width: 768px) {
    #prevButton {
      font-size: 3em;
    }
  }
  
  #exitButton {
    color: #fff;
    font-size: 2em;
    transition: opacity 0.8s;
    position: absolute;
    top: 15px;
    right: 15px;
  }
  #exitButton:hover {
    opacity: 0.7;
  }
  @media screen and (min-width: 768px) {
    #exitButton {
      font-size: 3em;
    }
  }
      </style>
@section('title', 'View User')

@section('content_header')
 

@section('content')

 

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <div class="left d-flex align-items-center">
            <div class="icon_main">
              <i class="fas fa-user"></i>
            </div>
            <h3>User Details</h3>
          </div>         
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body inner_wrapper">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <form>
            <div class="row nominator_content_wrapper" style="pointer-events:none;">
              @if($users->homeowner == '1')
                  <h5><span class="nominator_content">Homeowner</span> Detail</h5>
                  @else
                  <h5><span class="nominator_content">Nominator</span> Detail</h5>
                  @endif
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>First Name</label>
                  @if($users->homeowner == '1')
                  <input type="text" class="form-control" placeholder="{{ $users->homeowner_first_name }}"  readonly>
                  @else 
                  <input type="text" class="form-control" placeholder="{{ $users->nominator_first_name }}"  readonly>
                  @endif
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Last Name</label>
                  @if($users->homeowner == '1')
                  <input type="text" class="form-control"  placeholder="{{ $users->homeowner_last_name }}" readonly>
                  @else 
                  <input type="text" class="form-control"  placeholder="{{ $users->nominator_last_name }}" readonly>
                  @endif
                </div>
              </div>

              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Email</label>
                  @if($users->homeowner == '1')
                  <input readonly  type="email" class="form-control" placeholder="{{ $users->homeowner_email }}"   >
                  @else 
                  <input readonly  type="email" class="form-control" placeholder="{{ $users->nominator_email }}"   >
                  @endif
                </div>
              </div>
             
              @if($users->homeowner == '1')
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                   <label>Location</label>
                   <input readonly  type="location" class="form-control" value="{{ $users->homeowner_location }}" name="location"  >
                </div>
             </div> 
             @endif
            
             @if($users->homeowner == '1')
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
              <div class="form-group">
                 <label>Phone Number</label>
                 <input readonly  type="number" class="form-control" value="{{ $users->homeowner_phone ?? 'N/A'}}" name="phone_number"  >
              </div>
           </div> 
           @else
           <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
            <div class="form-group">
              <label>Phone Number</label>
              <input readonly  type="email" class="form-control" placeholder="{{ $users->nominator_phone ?? 'N/A'}}"   >
            </div>
          </div>
             @endif

             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
              <div class="form-group">
                 <label>Home Key</label>
                 <input type="text" class="form-control" value="{{ $users->home_key_val }}" name="created_at"  readonly >
              </div>
           </div> 
             @if($users->homeowner == '1')
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control"  name="status" disabled>
                  @foreach( $md_dropdown as $dropdown) 
                  @if ($dropdown->slug == 'home_status')
                  <option {{ $users->status == $dropdown->values ? 'selected' : ' '}} value={{ $dropdown->values }}>{{ $dropdown->name }}</option>
                  @endif 
                  @endforeach
                 </select>
              </div>
           </div> 

           <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
            <div class="form-group">
               <label>Notes</label>
               <input type="text" class="form-control" placeholder="{{ $users->notes ?? 'N/A'}}" name="notes"  readonly >
            </div>
            </div> 
           <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
            <div class="form-group">
               <label>Created At</label>
                @php
                  $datetime = $users->created_at;
                  $datetime->format('m/d/Y');
                  $la_time = new DateTimeZone('America/Los_Angeles');
                  $last = $datetime->setTimezone($la_time);
                @endphp
               <input type="text" class="form-control" value="{!! date('m/d/Y', strtotime($last)) !!}" name="created_at"  readonly >
            </div>
         </div> 
         <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
          <div class="form-group">
             <label>Total Days on the site</label>
             @php
                         
                          
                         if( $users->approved_at){
                           $date_expire = date("Y/m/d",strtotime($users->approved_at));   
                           $date = new DateTime($date_expire);
                           $now = new DateTime();
                          
                           
                         }else{
                           $date = new DateTime();
                            $now = new DateTime();
                           
                           
                         }
                        @endphp
             <input type="text" class="form-control" placeholder="{!! $date->diff($now)->format("%d days") !!}"   readonly >
          </div>
         </div> 
         @endif
            {{--  @if($users->child)
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
              <div class="form-group">
                 <label>Phone number</label>
                 <input readonly  type="number" class="form-control" value="{{ $users->phone_number }}" name="phone_number"  >
              </div>
            </div> 
             @endif --}}
             
          
                 </div>
                  @if($users->homeowner == '2')
                 <div class="row homeowner_content_wrapper" style="pointer-events:none;">

                    
                     <div class="col-sm-12 col-md-12 col-lg12 col-xl-12 col-12">
                      <h5><span class="homeowner_content">Homeowner</span> Detail</h5>
                    </div>
                    
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" placeholder="{{ $users->homeowner_first_name  ?? 'N/A' }}"  readonly>
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control"  placeholder="{{ $users->homeowner_last_name ?? 'N/A'}}" readonly>
                          </div>
                        </div>
                      
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>Email</label>
                            <input readonly  type="email" class="form-control" placeholder="{{ $users->homeowner_email ?? 'N/A'}}"   >
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>Phone Number</label>
                            <input readonly  type="email" class="form-control" placeholder="{{ $users->homeowner_phone ?? 'N/A'}}"   >
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                             <label>Location</label>
                             @if($users->homeowner == '1')
                             <input readonly  type="location" class="form-control" value="{{ $users->homeowner_location }}" name="location"  >
                             @else 
                             <input readonly  type="location" class="form-control" value="{{ $users->nominator_location }}" name="location"  >
                             @endif
                          </div>
                       </div> 

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control"  name="status" disabled>
                              @foreach( $md_dropdown as $dropdown) 
                              @if ($dropdown->slug == 'home_status')
                              <option {{ $users->status == $dropdown->values ? 'selected' : ' '}} value={{ $dropdown->values }}>{{ $dropdown->name }}</option>
                              @endif 
                              @endforeach
                             </select>
                          </div>
                       </div> 
                       <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Notes</label>
                           <input type="text" class="form-control" placeholder="{{ $users->notes ?? 'N/A'}}" name="notes"  readonly >
                        </div>
                        </div> 
                       <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Created At</label>
                          @php
                            $datetime = $users->created_at;
                            $datetime->format('m/d/Y');
                            $la_time = new DateTimeZone('America/Los_Angeles');
                            $last = $datetime->setTimezone($la_time);
                          @endphp
                           <input type="text" class="form-control" value="{!! date('m/d/Y', strtotime($last)) !!}" name="created_at"  readonly >
                        </div>
                     </div> 
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group">
                         <label>Total Days on the site</label>

                         @php
                         
                          
                          if( $users->approved_at){
                            $date_expire = date("Y/m/d",strtotime($users->approved_at));   
                            $date = new DateTime($date_expire);
                            $now = new DateTime();
                           
                            
                          }else{
                            $date = new DateTime();
                             $now = new DateTime();
                            
                            
                          }
                         @endphp
                        
                         <input type="text" class="form-control" placeholder="{!! $date->diff($now)->format("%d days") !!}"   readonly >
                      </div>
                     </div> 
                     
      

                     
            </div>
                           @endif

            <row>
                <div class="col-sm-12 col-md-12 col-lg12 col-xl-12 col-12 pb-0">
                    <div class="form-group">
                         <h5>Home Images</h5>
                    </div>
                </div>
             </row>    
          {{--   <div class="row">
              @forelse ($users->userImages as $user)
              <div class="col-md-3 border p-3 m-3 view_images_wrapper">
                <img class="pop" data-type="image" src="{{ $user->image }}" id="profileImage" class="img-fluid w-100">
                </div>
                @empty
                <p>No Images</p>
              @endforelse 
            </div>
            <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">              
                                <div class="modal-body">
                                     <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
                                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                      <div class="carousel-inner">
                                        <div class="carousel-item active">
                                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <img src="{{ $user->image }}" class="imagepreview" style="width:100%;">
                                        </div>
                                        <div class="carousel-item">
                                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <img src="{{ $user->image }}" class="imagepreview" style="width:100%;">
                                        </div>
                                        <div class="carousel-item">
                                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <img src="{{ $user->image }}" class="imagepreview" style="width:100%;">
                                        </div>
                                      </div>
                                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                      </button>
                                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                      </button>
                                    </div>

                                  
                                </div>
                            </div>
                        </div>
                    </div> --}}

               
           {{-- reviews --}}
         {{--    @if($users->status == '1')
           <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
            <div class="form-group">
              <hr>
               <label>Reviews</label>
            </div>
            @forelse ($users->reviews as $reviews)
            <div class="row">
             
             
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="{{ $reviews->voter->first_name }}"  readonly>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>Comment</label>
                      <input type="text" class="form-control" placeholder="{{ $reviews->comment }}"  readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                       <label>Review Images</label>
                  </div>
                </div> 
                  @forelse ($reviews->voter_images as $voter_images)
                  <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-12">
                      <img width="100" height="100" src="{{ $voter_images->images }}">
                  </div>
                  @empty
                  <p>No Review Images</p>
                 @endforelse 
            </div>
            @empty
            <p>No Reviews yet</p>
           @endforelse 
           </div> 
           @endif --}}

           <section id="gallery">
            <div class="container">
              <div id="image-gallery">
                <div class="row">
                  @forelse ($users->userImages as $user)
                  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                      <a href="{{ $user->image }}"><img src="{{ $user->image }}" class="img-responsive"></a>
                      <div class="img-overlay">
                        <!-- <i class="fa fa-plus-circle" aria-hidden="true"></i> -->
                      </div>
                    </div>
                  </div>
                    @empty
                    <p>No Images</p>
                  @endforelse 

                </div>
              </div>
            </div>
          </section>


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


 <script>
  // Gallery image hover
$( ".img-wrapper" ).hover(
function() {
  $(this).find(".img-overlay").animate({opacity: 1}, 600);
}, function() {
  $(this).find(".img-overlay").animate({opacity: 0}, 600);
}
);

// Lightbox
var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

// Add overlay
$overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
$("#gallery").append($overlay);

// Hide overlay on default
$overlay.hide();

// When an image is clicked
$(".img-overlay").click(function(event) {
// Prevents default behavior
event.preventDefault();
// Adds href attribute to variable
var imageLocation = $(this).prev().attr("href");
// Add the image src to $image
$image.attr("src", imageLocation);
// Fade in the overlay
$overlay.fadeIn("slow");
});

// When the overlay is clicked
$overlay.click(function() {
// Fade out the overlay
$(this).fadeOut("slow");
});

// When next button is clicked
$nextButton.click(function(event) {
// Hide the current image
$("#overlay img").hide();
// Overlay image location
var $currentImgSrc = $("#overlay img").attr("src");
// Image with matching location of the overlay image
var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
// Finds the next image
var $nextImg = $($currentImg.closest(".image").next().find("img"));
// All of the images in the gallery
var $images = $("#image-gallery img");
// If there is a next image
if ($nextImg.length > 0) { 
  // Fade in the next image
  $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
} else {
  // Otherwise fade in the first image
  $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
}
// Prevents overlay from being hidden
event.stopPropagation();
});

// When previous button is clicked
$prevButton.click(function(event) {
// Hide the current image
$("#overlay img").hide();
// Overlay image location
var $currentImgSrc = $("#overlay img").attr("src");
// Image with matching location of the overlay image
var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
// Finds the next image
var $nextImg = $($currentImg.closest(".image").prev().find("img"));
// Fade in the next image
$("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
// Prevents overlay from being hidden
event.stopPropagation();
});

// When the exit button is clicked
$exitButton.click(function() {
// Fade out the overlay
$("#overlay").fadeOut("slow");
});
  </script>



<script type="text/javascript">


  $("#txtPhone").on('focusout',function(){
    var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
     $('#country_code').val(code);
  });

</script>
<script type="text/javascript">
  $(".pop").click(function(){
       var data=  $(this).attr('data-type');
      if(data=="image"){
        $('.imagepreview').attr('src', $(this).attr('src'));
        $('.videoparent').hide();
        $('.imagepreview').show();
      }else{

        $('.videopreview').attr('src',$(this).children().attr('src'));
       $('.imagepreview').hide();
       $('.videoparent').show();
       alert(jghii);
      
      }
  
    
     $('#imagemodal').modal('show');
 });

  $(".close").on("click",function(){
  $('#imagemodal').modal('hide');  
 });
</script>





 

@stop
