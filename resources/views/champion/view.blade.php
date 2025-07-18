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
