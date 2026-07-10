@extends('vivah_mitra.layouts.master')
@section('title') Training Video Category @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 5px;
		/*box-shadow: 0 6px 14px rgba(0,0,0,0.08);*/
		transition: 0.3s;
		text-align: center;
	}
	
	.video-col {
    padding: 10px;
}

.video_link {
    text-decoration: none;
}

.video_box {
    height: 110px;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    
    /* Gradient Background */
    background: linear-gradient(135deg, #800080, #ffc0cb);

    /* Text Style */
    color: #fff;
    font-weight: 600;
    text-align: center;

    /* Shadow */
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);

    /* Smooth Animation */
    transition: all 0.3s ease;
}

.video_box h3 {
    font-size: 16px;
    margin: 0;
	color:#fff;
}

/* Hover Effect */
.video_box:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

/* Pulse animation */
@keyframes pulse {
    0% {
        transform: scale(0.9);
        opacity: 0.9;
    }
    70% {
        transform: scale(1.2);
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}
	</style>

   <!-- Header -->
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewbox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"></path>
							</svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h5 class="mb-0">प्रशिक्षण विडिओ </h5>
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

     @include('vivah_mitra.includes.sidebar')

    <!-- Page Content -->
    <div class="page-content">

        <div class="content-inner pt-0">
			<div class="container fb">
                
                <div class="dashboard-area m-b30">
					<!-- Features -->
                    <div class="features-box  mt-3">
						<div class="row m-b20 g-3">
							<div class="container">
								<div class="row">
									@foreach($video_category as $item)
										<div class="col-12 video-col">
											<a href="{{ url('member/training-video-subcategory/'.$item->id) }}" class="video_link">
												<div class="video_box">
													<h3>{{ $item->name }}</h3>
												</div>
											</a>
										</div>
									@endforeach
								</div> 
								
								 
								
							</div>
						</div>
                    </div>
					<!-- Features End -->

					 

				</div>
			</div>
		</div>

    </div>
	
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame"
                        src=""
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>

		 
	</script>
	
	<script>
 

 function openVideoModal(videoId) {
        const iframe = document.getElementById('videoFrame');
        iframe.src = "https://www.youtube.com/embed/" + videoId + "?autoplay=1";

        const modalEl = document.getElementById('videoModal');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    // Stop video when modal closes
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('videoModal');
        modalEl.addEventListener('hidden.bs.modal', function () {
            document.getElementById('videoFrame').src = '';
        });
    });
	
</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
