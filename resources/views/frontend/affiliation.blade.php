@extends('frontend.layouts.master')

@section('title')
Affiliation
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
                            <h3 class="it-breadcrumb-title">Affiliation</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{ url('') }}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Affiliation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->
<div class="it-category-4-area p-relative pt-40 pb-40" style="background:#0dcaf0">
<div class="it-category-4-shape-1 d-none d-lg-block">
<img src="assets/img/category/shape-1-1.png" alt="">
</div>
<div class="container">
<div class="it-category-4-title-wrap mb-30">
<div class="row align-items-end">
<div class="col-xl-6 col-lg-6 col-md-6">
<div class="it-category-4-title-box">
<h4 class="it-section-title-3">Affiliation Accredition</h4>
</div>
</div>

</div>
</div>
<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1">
    @php
		$affiliation  = \App\Models\Affiliation::where('status', 1)->get();
	@endphp
	@foreach ($affiliation as $item)
        <div class="col mb-30 wow itfadeUp" data-wow-duration=.9s data-wow-delay=.3s>
            <div class="it-category-4-item text-center">
                <div class="it-category-4-icon">
                    <span>
                        <img style="height:150px;" src="{{ static_asset($item->image) }}" alt="">
                    </span>
                </div>
            </div>
        </div>
    @endforeach


</div>
</div>
</div>
</main>

@endsection
