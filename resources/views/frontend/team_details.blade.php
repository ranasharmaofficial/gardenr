@extends('frontend.layouts.master')

@section('title')
Team Details
@endsection

@section('description')
@endsection


@section('content')

<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="it-breadcrumb-shape-1 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-21.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-2 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-22.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-3 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-3.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-4 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-4.png')}}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Team</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{ url('') }}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Team Details</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->
    <div class="it-teacher-details-area pt-120 pb-120">
            <div class="container">
               <div class="it-teacher-details-wrap">
                  <div class="row">
                     <div class="col-xl-3 col-lg-3">
                        <div class="it-teacher-details-left">
                           <div class="it-teacher-details-left-thumb">
                              <img src="{{ static_asset($details->profile_pic) }}" alt="">
                           </div>
                           <div class="it-teacher-details-left-social text-center">
                              <a href="#"><i class="fab fa-facebook-f"></i></a>
                              <a href="#"><i class="fab fa-twitter"></i></a>
                              <a href="#"><i class="fab fa-skype"></i></a>
                              <a href="#"><i class="fab fa-linkedin-in"></i></a>
                           </div>
                           <div class="it-teacher-details-left-info">
                              <ul>
                                 <li>
                                    <i class="fa-light fa-phone-volume"></i>
                                    <a href="tel:{{ $details->mobile }}">{{ $details->email }}</a>
                                 </li>
                                 <li>
                                    <i class="fa-light fa-location-dot"></i>
                                    <a href="javascript:void(0);">{{ $details->address }}, {{ $details->city }}, {{ $details->state }} - {{ $details->pincode }}</a>
                                 </li>
                                 <li>
                                    <i class="fa-light fa-envelope"></i>
                                    <a href="mailto:{{ $details->email }}">{{ $details->email }}</a>
                                 </li>
                              </ul>
                           </div>
                           <div class="it-teacher-details-left-btn">
                              <a class="it-btn" href="{{ url('contact') }}">
                                 <span>
                                    Contact us teacher
                                    <svg width=17 height=14 viewBox="0 0 17 14" fill=none xmlns="http://www.w3.org/2000/svg">
                                       <path d="M11 1.24023L16 7.24023L11 13.2402" stroke=currentcolor stroke-width=1.5 stroke-miterlimit=10 stroke-linecap=round stroke-linejoin=round />
                                       <path d="M1 7.24023H16" stroke=currentcolor stroke-width=1.5 stroke-miterlimit=10 stroke-linecap=round stroke-linejoin=round />
                                    </svg>
                                 </span>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-9 col-lg-9">
                        <div class="it-teacher-details-right">
                           <div class="it-teacher-details-right-title-box">
                              <h4>{{ $details->first_name }}</h4>
                              <span>{{ $details->designation }}</span>
                               
                           </div>
                           <div class="it-teacher-details-right-content mb-40">
						   {!! $details->details !!}
                           </div>
                            
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="it-team-3-area it-team-3-style-2 p-relative z-index pb-90">
            <div class=container>
               <div class=row>
                  <div class=col-xl-12>
                     <div class="it-testimonial-5-title-box text-center mb-60">
                        <span class=it-section-subtitle-5><i class="fa-light fa-book"></i> teacher <i class="fa-light fa-book"></i></span>
                        <h4 class=it-section-title-5>meet our expert teacher</h4>
                     </div>
                  </div>
               </div>
               <div class=row>
                  @if($team_list)
					@foreach($team_list as $val)
						<div class="col-xl-3 col-lg-4 col-md-6 mb-30">
							 <div class="it-team-3-item text-center">
								<div class="it-team-3-thumb fix">
								   <img src="{{ static_asset($val->profile_pic) }}" alt="">
								</div>
								<div class="it-team-3-content">
								   <div class="it-team-3-social-box p-relative">
									  <button>
									  <i class="fa-light fa-share-nodes"></i>
									  </button>
									  <div class="it-team-3-social-wrap">
										 <a href="#"><i class="fa-brands fa-instagram"></i></a>
										 <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
										 <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
										 <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
									  </div>
								   </div>
								   <div class="it-team-3-author-box">
									  <h4 class="it-team-3-title"><a href="{{ url('team-details/'.$val->id) }}">{{ $val->first_name }}</a></h4>
									  <span>{{ $val->designation }}</span>
								   </div>
								</div>
							 </div>
						  </div>
					@endforeach
				@endif
                   
               </div>
            </div>
         </div>
</main>

@endsection
