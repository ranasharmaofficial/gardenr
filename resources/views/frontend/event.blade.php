@extends('frontend.layouts.master')
@section('title') Event @endsection

@section('meta_tags')
@endsection

@section('content')
  <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url({{ static_asset('assets/assets_web/img/inner-bannerr.jpg') }});" id="bg-fixedd">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Event Gallery</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('') }}" style="color:#fff;"><i class="fas fa-home"></i> Home</a></li>
                            <li class="active" style="color:#fff;">Event Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="gallery-area default-padding">
      
        <div class="container">
            <div class="row">
                <div class="col-md-12 gallery-content">
                    <div class="">
                        <div id="portfolio-grid" class="gallery-items colums-3">
                            @foreach($latest_event_cat as $val)
							<!-- Single Item -->
                            <div class="pf-item">
                                <div class="gallery-style-two">
                                    <img src="{{ static_asset($val->image) }}" alt="{{ $val->title }}">
                                    <div class="overlay">
                                      
                                        <h4><a href="">{{ $val->title }}</a></h4>
                                    </div>
                                    <a class="link" href=""><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <!-- End Single Item -->
							@endforeach
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
