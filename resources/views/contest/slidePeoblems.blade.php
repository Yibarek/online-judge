@extends('layouts.app') 
{{-- @extends('layouts.contest') --}}

@section('content')
<style>
    * {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
</style>

<form action="c/schedule" method="get">
        <div class="container p-2"  style="width: 900px; margin: auto;">
            <div class="title justify-content-center d-flex" style="align-self: center; width: 400px; margin: auto;">
                <h3 >Create Contest </h3><h5 class="pt-2 pl-2"> -> Problem</h5> 
            </div>

            @php
                $no_of_problems = 1;
            @endphp

            <div class="pt-1 pb-1 d-flex ">     {{-- ///////////////\\\\\\\\\\\\\\\     break     //////////////\\\\\\\\\\\\\--}}
                <caption class="caption"><strong>Problems</strong></caption>
                <label for="" class="no_of_problems pr-4 pl-4">{{$no_of_problems}}</label>
                <input id="add" class="btn-success" style="height: 33px; width: 33px; max-width: 33px; 
                                        border-radius: 50%;
                                        border: 2px solid #aaa;
                                        background-color: #11cc11;
                                        color: white;
                                        font-weight: bold;
                                        margin-left: 10px;
                                        margin-bottom: 5px;
                                        font-size: 18px;"
                                        type="button"
                                      title="add new problem"
                                      value="+">
                
            </div>
            <div style="border: 1px solid gray; border-radius: 5px; width: 900px; margin: auto;">
                <div class="justify-content-between p-4 d-flex">
                    {{-- <div><h1 id="123" >123</h1><br></div> --}}
                    
                    <div class="slide d-flex">

                    </div>
                </div>
                
                <div class="slideshow-container">
                    <!-- Full-width images with number and caption text -->
                    @php
                        
                    @endphp

                    <div class="mySlides" id="123">
                        <div class="numbertext">1 / 3</div>
                        <img src="../image/bg1.jpg" style="width:100%; height: 280px; margin-top: 20px;">
                        <div class="text">Caption Text</div>
                    </div>
                
                    <div class="mySlides">
                        <div class="numbertext">2 / 3</div>
                        <img class="" src="../image/bg4.jpg" style="margin-left: 140px; width:65%; height: 350px;">
                        <div class="text">Caption Two</div>
                    </div>
                
                
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
            </div>
            

            
            <script src={{ asset('js/jquery.min.js') }}></script>

                <div class="save p-5 justify-content-between d-flex " style="width: 800px;">
                <div ></div>
                <input class="btn btn-primary " style="width: 80px;" type="submitt" id="finish" value="Finish" >
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $("#add").click(function(){
                $("#123").append(" <div class='mySlides'>
                        <div class='numbertext'>2 / 3</div>
                        <img class='' src='../image/bg4.jpg' style='margin-left: 140px; width:65%; height: 350px;'>
                        <div class='text'>Caption Two</div>
                    </div>");  
                <?php
    $no_of_problems++;
    ?>              
    //             document.getElementsByClassName('no_of_problems').innerHTML = {{$no_of_problems}};
    alert({{$no_of_problems}});
            });
            
        });
        </script>
        
        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            // Next/previous controls
            function plusSlides(n) {
              showSlides(slideIndex += n);
            }

            // Thumbnail image controls
            function currentSlide(n) {
              showSlides(slideIndex = n);
            }

            function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("dot");
              if (n > slides.length) {slideIndex = 1}
              if (n < 1) {slideIndex = slides.length}
              for (i = 0; i < slides.length; i++) {
                  slides[i].style.display = "none";
              }
              for (i = 0; i < dots.length; i++) {
                  dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";
              dots[slideIndex-1].className += " active";
            }
        </script>
        
@endsection