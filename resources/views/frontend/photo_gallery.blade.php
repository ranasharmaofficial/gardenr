@extends('frontend.layouts.master')
@section('title') Photo Gallery | {{ env('APP_NAME') }} @endsection


@section('content')
<style>
.card:hover .card-img-overlay {
    opacity: 1 !important;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

</style>
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Photo Gallery</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{ url('') }}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Photo Gallery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

        <section class="gallery-one gallery-one--page it-about-area ed-about-style-2 p-relative pt-40 pb-40">
    <div class="container">
        <div class="row g-4">
            @foreach($gallery_category as $val)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden h-100">
                        <div class="position-relative">
                            <img src="{{ static_asset($val->image) }}" 
                                 alt="{{ $val->title }}" 
                                 class="card-img-top img-fluid" 
                                 style="height:250px; object-fit:cover;">

                            <!-- Overlay hover -->
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3" 
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0)); opacity:0; transition:0.3s;">
                                <h5 class="text-white fw-bold mb-2">{{ $val->title }}</h5>
                                <div>
                                    <a href="{{ url('gallery/'.$val->slug) }}" class="btn btn-sm btn-light fw-bold">
                                        View More
                                    </a>
                                    <a href="{{ static_asset($val->image) }}" class="btn btn-sm btn-outline-light img-popup">
                                        <i class="bi bi-zoom-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



@endsection
