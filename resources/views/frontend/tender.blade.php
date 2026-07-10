@extends('frontend.layouts.master')
@section('title') Tender @endsection

@section('meta_tags')
@endsection

@section('content')
  <!-- Start Breadcrumb
    ============================================= -->
    <!--<div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url({{ static_asset('assets/assets_web/img/banner/3.jpg') }});" id="bg-fixedd">-->
        <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url({{ static_asset('assets/assets_web/img/inner-bannerr.jpg') }});" id="bg-fixedd">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1>Tender</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="{{ url('') }}" style="color:#fff;"><i class="fas fa-home"></i> Home</a></li>
                                <li class="active" style="color:#fff;">Tender</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Start Blog
        ============================================= -->




        <div class="services-details-area default-padding">
            <div class="container">
                <div class="services-details-items">
                    <div class="row">

                        <div class="col-md-8">





                              <!-- Start Blog Comment -->
                            <div class="blog-comments" id="commentss">
                                <div class="comments-area">
                                    <div class="comments-title">

                                        <div class="comments-list">
                                            @foreach ($tenderList as $item )
                                                <div class="comment-item">
													<div class="content">
                                                        <div class="title">
                                                            <p class="civill"><img src="{{ static_asset('assets/assets_web/img/dot (1).png') }}"> {{ $item->title }}</p>
                                                            <p class="tenderdetails"><u>Tender Details</u></p>
                                                            <h5 class="worktender">
																@if($item->details!=null)
																	{{ $item->details }}
																@endif
                                                            <span class="reply"><a href="{{ static_asset('uploads/tender/'.$item->upload) }}"><i class="fas fa-reply"></i> Download</a></span></h5>

                                                            <p class="dateee">Upload Date</p>
                                                            <p class="datee"><i class="fa fa-calendar"></i> {{ date('d M, Y', strtotime($item->uploaddate)) }}</p>
                                                        </div>
													</div>
                                                </div>
                                            @endforeach

                                            


                                        </div>
										 <div class="pagination">
											{{ $tenderList->appends(request()->input())->links() }}
										</div>
                                    </div>

                                </div>
                            </div>





                        </div>

                        <div class="col-md-4">
                      <div class="">
                                <img src="{{ static_asset('assets/assets_web/img/tenderr.jpg') }}" class="about-plantt" alt="Thumb">
                            </div>
                      </div>

                    </div>
                </div>
            </div>
        </div>

@endsection
