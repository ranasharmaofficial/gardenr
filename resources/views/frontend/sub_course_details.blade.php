@extends('frontend.layouts.master')

@section('title')
    {{ $subcourse->title }}
@endsection

@section('description')
@endsection


@section('content')
<main>
      <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg') }}">
         <div class="it-breadcrumb-shape-1 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-21.png') }}" alt="">
         </div>
         <div class="it-breadcrumb-shape-2 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-22.png') }}" alt="">
         </div>
         <div class="it-breadcrumb-shape-3 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-3.png') }}" alt="">
         </div>
         <div class="it-breadcrumb-shape-4 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-4.png') }}" alt="">
         </div>
         <div class="container">
            <div class="row ">
               <div class="col-md-12">
                  <div class="it-breadcrumb-content z-index-3 text-center">
                     <div class="it-breadcrumb-title-box">
                        <h3 class="it-breadcrumb-title">{{ $subcourse->title }}</h3>
                     </div>
                     <div class="it-breadcrumb-list-wrap">
                        <div class="it-breadcrumb-list">
                           <span><a href="{{ url('') }}">home</a></span>
                           <span class="dvdr">//</span>
                           <span>Courses</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- slider-area-end -->

<div class="it-course-details-area pt-20 pb-100">
         <div class="container">
            <div class="row">
               <div class="col-xl-9 col-lg-8">
                  <div class="it-course-details-wrap">
                     <div class="it-evn-details-thumb mb-35">
                        <img src="{{ static_asset('uploads/courses/'.$subcourse->image) }}" alt="">
                     </div>
                     <div class="it-evn-details-rate mb-15">
                        <span>
                           <i class="fa-sharp fa-solid fa-star"></i>
                           <i class="fa-sharp fa-solid fa-star"></i>
                           <i class="fa-sharp fa-solid fa-star"></i>
                           <i class="fa-sharp fa-solid fa-star"></i>
                           <i class="fa-regular fa-star"></i>
                           (4.7)
                        </span>
                     </div>
                     <h4 class="it-evn-details-title mb-0 pb-5">{{ $subcourse->title }}</h4>

                     <div class="it-course-details-nav pb-60">
                        <nav>
                           <div class="nav nav-tab" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                 aria-selected="true">overview</button>
								 {{--<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                 aria-selected="false">curriculum</button>
                              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                 aria-selected="false">instructor</button>
                              <button class="nav-link" id="nav-reviews-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-reviews" type="button" role="tab" aria-controls="nav-reviews"
                                 aria-selected="false">reviews</button>--}}
                           </div>
                        </nav>
                     </div>
                     <div class="it-course-details-content">
                        <div class="tab-content" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                              aria-labelledby="nav-home-tab">
                              <div class="it-course-details-wrapper">
                                 <div class="it-evn-details-text mb-40">
                                    <h6 class="it-evn-details-title-sm pb-5">Course Description</h6>
                                    {!! $subcourse->details !!}
                                 </div>
                                 
                              </div>
                           </div>
                            
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-4">
                  <div class="it-evn-sidebar-box it-course-sidebar-box">
                     <div class="it-evn-sidebar-thumb mb-30">
                        <img src="{{ static_asset('assets/assets_web/images/details-sm.jpg') }}" alt="">
                     </div>
                     <div class="it-course-sidebar-rate-box pb-20">
                        <div class="it-course-sidebar-rate d-flex justify-content-between align-items-center">
                           <span>course detail</span>
                        </div>
                    </div>
                     <a class="ed-btn-square radius purple-4 w-100 text-center mb-20" href="{{ url('contact') }}">
                        <span>
                          Apply Now
                        </span>
                     </a>
                     <div class="it-evn-sidebar-list">
                        <ul>
                           <li><span>Mode </span> <span>Offline</span></li>
                           <li><span>enrolled</span><span>100</span></li>
						   <li><span>skill level</span><span>Basic+Advanced</span></li>
                           <li><span>class day</span><span>Monday-Saturday</span></li>
                           <li><span>language</span><span>English,Hindi</span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <!-- newsletter-area-end -->
   </main>

@endsection
