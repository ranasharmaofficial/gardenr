
@extends('frontend.layouts.master')

@section('title')
    Popular Course
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
					<span>{{ $coursedetails->courseTitle }}</span>
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
					@foreach ($subcourseList as $item)
					<div class="col-lg-4 col-md-6">
						<div class="ed-program-item">
							<div class="item-inner">
								<div class="item-img position-relative">
									<div class="inner-img">
										<img src="{{ static_asset('uploads/courses/'.$item->image) }}" alt="">
									</div>
									<span class="sale_tag">Admission Open</span>
								</div>
								<div class="item-text ul-li headline-2 pera-content">
									<h3 class="prog_title href-underline"><a href="#">{{ $item->title }}</a></h3>
									<a class="view_more d-block text-center" href="#"><span>Read More <i class="fa-solid fa-right-long"></i></span></a>
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
        <div class="it-breadcrumb-shape-1 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-21.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-2 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-22.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-3 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-3.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-4 d-none d-md-block">
            <img src="{{ static_asset('assets/assets_web/images/shape-1-4.png')}}" alt="">
        </div>
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Popular Course</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{url('/')}}">home</a></span>
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
    <div class="it-course-area ed-course-bg ed-course-style-3 p-relative pt-120 pb-90"
        data-background="{{ static_asset('assets/assets_web/images/ed-bg-1.jpg') }}">
        <div class="container">
            <div class="ed-course-title-wrap mb-65">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-7">
                        <div class="it-course-title-boxmb-70">
							<span class="ed-section-subtitle">Top Popular Course</span>
                            {{--<h4 class="ed-section-title">{{ $coursedetails->courseTitle }}--}}
                                <span class="p-relative ed-title-shape  z-index">
                                    <svg width="168" height="65" viewBox="0 0 168 65" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M73.3791 8.52241C78.4861 6.03398 82.5735 4.26476 88.8944 3.31494C94.2074 2.51659 99.6315 2.08052 104.982 1.95274C120.428 1.5839 135.136 4.94481 146.513 9.7789C158.639 14.931 166.74 22.7171 166.094 31.8511C165.316 42.8363 151.375 52.0035 133.539 57.1364C110.286 63.8284 81.7383 64.1305 58.5896 61.1289C37.5299 58.3982 11.6525 51.9446 3.59702 40.1836C-3.42072 29.9382 12.0777 18.2085 27.5463 11.6691C40.3658 6.24978 55.7075 2.97602 70.8049 4.09034C81.9407 4.91227 93.2195 6.91079 102.467 10.0494C112.882 13.5844 120.151 18.7016 127.875 23.7722"
                                            stroke="#704FE6" stroke-width="3" stroke-linecap="round" />
                                    </svg>

                                </span>

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
                @foreach ($subcourseList as $item)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="it-course-item ed-course-style-2">
                        <div class="it-course-thumb mb-25 p-relative">
                            <a href="{{ url('sub-course/'.$item->slug) }}">
                                <img src="{{ static_asset('uploads/courses/'.$item->image) }}"
                                    alt=""></a>
                        </div>
                        <div class="it-course-content p-relative">
                            <h4 class="it-course-title pb-15"><a href="{{ url('sub-course/'.$item->slug) }}">{{ $item->title }}</a></h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ed-course-price-box">
                                    <a class="ed-course-btn" href="{{ url('sub-course/'.$item->slug) }}">Know More
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
                                <img src="{{ static_asset('assets/assets_web/images/ed-item-shape.png') }}" alt="">
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
