@extends('frontend.layouts.master')
@section('title') Gallery @endsection

@section('meta_tags')

@endsection

@section('content')
   <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
		<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">{{ $cat_details->title }}</h3>
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
	
		 
		<section class="project-three project-block_one">
			<div class="auto-container">
				<div class="container my-5">
					<div class="row">
					@foreach($gallery_details as $key => $val)
						<div class="col-md-4">
							<div class="more104 project-block_one-inner wow fadeInRight animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInRight;">
								<div class=" project-block_one-image">
									<a href="{{ static_asset('uploads/gallery/'.$val->image) }}" class="glightbox" data-gallery="floorplans">
										<img src="{{ static_asset('uploads/gallery/'.$val->image) }}" class="img-fluid" alt="Floor Plan 1">
									</a>
								</div>
							</div>
						 </div>
					@endforeach
						<!-- Add more items as needed -->
					</div>
				</div>
			</div>
		</section>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox',
        });
    </script>
	
@endsection
