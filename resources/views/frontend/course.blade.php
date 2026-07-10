@extends('frontend.layouts.master')

@section('title')
Courses
@endsection

@section('description')
@endsection


@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Our Courses</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Our Courses </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<section id="ed-cc-cate-feed" class="ed-cc-cate-feed-sec pt-60 pb-130">
		<div class="container">
			<div class="ed-cc-cate-feed-top d-flex justify-content-between align-items-center flex-wrap">
				<div class="ed-view-btn-wrap ed-view-btns d-flex  flex-wrap align-items-center">
					<span>We Found <b>24 Courses</b> Available For You</span>
				</div>
				<div class="ed-cc-search">
					<form action="#" method="get">
						<input type="text" placeholder="Search Course here ...">
						<button><i class="fa-solid fa-magnifying-glass"></i></button>
					</form>
				</div>
			</div>
			<div class="ed-cc2-feed-area pt-40">
				<div class="row justify-content-center">
					 @foreach ($courses as $item)
                     <div class="col-lg-4 col-md-6">
						<div class="ed-program-item">
							<div class="item-inner">
								<div class="item-img position-relative">
									<div class="inner-img">
										<img src="{{ static_asset('uploads/courses/'.$item->courseImage) }}" alt="">
									</div>
									<span class="sale_tag">Admission Open</span>
								</div>
								<div class="item-text ul-li headline-2 pera-content">
									<h3 class="prog_title href-underline"><a href="{{ url('course/'.$item->slug) }}">{{ $item->courseTitle }}</a></h3>
									<a class="view_more d-block text-center" href="{{ url('course/'.$item->slug) }}"><span>View all Programs <i class="fa-solid fa-right-long"></i></span></a>
								</div>
							</div>
						</div>
					</div>
                    @endforeach



				</div>

			</div>
		</div>
	</section>
@if(false)
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Courses</h3>
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
    <div class="it-course-area ed-course-bg ed-course-style-3 p-relative pt-50 pb-90"
        data-background="{{ static_asset('assets/assets_web/images/ed-bg-1.jpg') }}">
        <div class="container">
            <div class="ed-course-title-wrap mb-65">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-7">
                        <div class="it-course-title-boxmb-70">
                            <span class="ed-section-subtitle">Top Popular Course</span>
                            <h4 class="ed-section-title">ICVT Course student can <br> join with us.
                            </h4>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-5">
                        <div class="ed-course-button text-md-end">
                            <a class="ed-btn-theme" href="#">
                                Load More Course
                                <i>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1.24023L16 7.24023L11 13.2402" stroke="currentcolor"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M1 7.24023H16" stroke="currentcolor" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($courses as $item)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="it-course-item ed-course-style-2">
                        <div class="it-course-thumb mb-25 p-relative">
                            <a href="{{ url('course/'.$item->slug) }}">
                                <img src="{{ static_asset('uploads/courses/'.$item->courseImage) }}"
                                    alt=""></a>
                        </div>
                        <div class="it-course-content p-relative">
                            <h4 class="it-course-title pb-15"><a href="{{ url('course/'.$item->slug) }}">{{ $item->courseTitle }}</a></h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ed-course-price-box">
                                    <a class="ed-course-btn" href="{{ url('course/'.$item->slug) }}">Know More
                                        <span>
                                            <svg width="21" height="8" viewBox="0 0 21 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z"
                                                    fill="currentcolor" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="ed-course-shape">
                                <img src="{{asset('public/front_assets/images/ed-item-shape.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</main>
@endif
@endsection
