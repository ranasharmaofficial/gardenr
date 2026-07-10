
<style>
    .sliderr {
           position: relative;
           width: 100%;
           max-width: 100%;
           height: 100%;
           overflow: hidden;
           box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
           background-repeat:no-repeat;
           margin-top:100px;
       }

       .slides {
           display: flex;
           transition: transform 0.5s ease-in-out;
           height: 100%;
       }

       .slides img {
           width: 100%;
           height: 100%;
           object-fit: cover;
           transition: transform 3s ease;
           background-repeat:no-repeat;
       }

       .nav-button {
           position: absolute;
           top: 50%;
           transform: translateY(-50%);
           background-color: rgba(0, 0, 0, 0.5);
           color: white;
           border: none;
           padding: 10px;
           cursor: pointer;
           z-index: 1000;
       }

       .nav-button.left {
           left: 10px;
       }

       .nav-button.right {
           right: 10px;
       }

       @media (max-width: 768px) {
           .sliderr

           {

                 position: relative;
                width: 100%;
                max-width: 100%;
                height: 100%;
                overflow: hidden;
                /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
                background-repeat:no-repeat;


               /*height: 500px; /* Reduce height for smaller screens */
               margin-top:-200px;
           }

           .nav-button {
               padding: 8px;
           }


            .slides img {
           width: 100%;
           height: 100%;
           object-fit: contain !important;
           transition: transform 3s ease;
           background-repeat:no-repeat;
           /*margin-top:-100px !important;*/
       }


        .nav-button {
           position: absolute;
           top: 50%;
           transform: translateY(-50%);
           background-color: rgba(0, 0, 0, 0.5);
           color: white;
           border: none;
           padding: 10px;
           cursor: pointer;
           z-index: 1000;
       }



       }

       @media (max-width: 480px) {
           .sliderr {
               height: 100%; /* Further reduce height for very small screens */
               margin-top:0px;
           }

           .nav-button {
               padding: 6px;
           }
       }
</style>



<!--<section class="">



   <div class="sliderr">
       <button class="nav-button left" id="prevBtn">&#10094;</button>
       <div class="slides">
           <img src="{{ static_asset('assets/assets_web/images/sliderr1.jpg') }}" alt="Image 1">
           <img src="{{ static_asset('assets/assets_web/images/sliderr2.jpg') }}" alt="Image 2">
           <img src="{{ static_asset('assets/assets_web/images/sliderr3.jpg') }}" alt="Image 3">
           <img src="{{ static_asset('assets/assets_web/images/sliderr4.jpg') }}" alt="Image 3">

       </div>
       <button class="nav-button right" id="nextBtn">&#10095;</button>
   </div>-->




   <section class="project-detail">

           <div class="project-detail_image">
               <video src="{{ static_asset('assets/assets_web/video/Capital-Green.mp4') }}" id="autoplay" muted playsinline controls>
                           </video>





                   </div>


               </div>
           </div>


       </div>



   </section>





   <!--<div class="main-slider_three swiper-container">
               <div class="swiper-wrapper">




                       <div class="swiper-slide">
                       <div class="slider-three_image-layer" style="background-image:url({{ static_asset('assets/assets_web/images/slider02.jpg') }})">
                       </div>
                       <div class="auto-container">
                           <div class="slider-three_content">


                           </div>
                       </div>
                   </div>




                   <div class="swiper-slide">
                       <div class="slider-three_image-layer" style="background-image:url({{ static_asset('assets/assets_web/images/slider01.jpg') }})">
                       </div>
                       <div class="auto-container">
                           <div class="slider-three_content">

                           </div>
                       </div>
                   </div>





                   <div class="swiper-slide">
                       <div class="slider-three_image-layer" style="background-image:url({{ static_asset('assets/assets_web/images/sslider.jpg') }})">
                       </div>
                       <div class="auto-container">
                           <div class="slider-three_content">


                           </div>
                       </div>
                   </div>

               </div>
               <div class="slider-three-arrow">

                   <div class="slider-three_prev"><img src="{{ static_asset('assets/assets_web/images/slider-two-prev_arrow.png') }}" alt="" /></div>
                   <div class="slider-three_next"><img src="{{ static_asset('assets/assets_web/images/slider-two-next_arrow.png') }}" alt="" /></div>
               </div>

               <div class="slider-three_pagination"></div>
           </div>-->


       <!--</section>-->
