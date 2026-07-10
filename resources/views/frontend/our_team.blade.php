@extends('frontend.layouts.master')

@section('title')
Our Team
@endsection

@section('description')
@endsection


@section('content')

<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
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
                                <span>Our Team</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->
    <div class="it-course-area ed-course-bg ed-course-style-3 p-relative pt-50" data-background="{{ static_asset('assets/assets_web/images/ed-bg-1.jpg') }}">
        <div class="container">

            <div class="row mt-5">
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
									  <span>{{ $val->designation }}</span></br>
									  <a href="tel:{{ $val->mobile }}"><span>{{ $val->mobile }}</span></a>
									  <a href="tel:{{ $val->mobile }}"><span>{{ $val->email }}</span></a>
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
