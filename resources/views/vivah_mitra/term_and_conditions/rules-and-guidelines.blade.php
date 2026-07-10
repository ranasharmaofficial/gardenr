@extends('vivah_mitra.layouts.master')
@section('title', 'Terms & Conditions')

@section('meta_tags')
@endsection

@section('content')

    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="{{ url()->previous() }}" class="back-btn">
                            <svg width="18" height="18" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z"
                                    fill="#a19fa8"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="mid-content">
                        <h5 class="mb-0">Terms & Conditions</h5>
                    </div>

                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z"
                                    fill="#a19fa8"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z"
                                    fill="#a19fa8"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @include('vivah_mitra.includes.sidebar')

    <style>
        .term-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .term-card-header {
            padding: 14px 14px 10px 14px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .term-card-title {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
            line-height: 1.3;
        }

        .term-type {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 50px;
            background: #f2f4ff;
            color: #3b5bdb;
            font-weight: 600;
            display: inline-block;
        }

        .term-card-body {
            padding: 12px 14px 14px 14px;
            font-size: 13.5px;
            color: #666;
        }

        .read-more-btn {
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            color: #2b59ff;
            border: 0;
            background: transparent;
            padding: 0;
        }

        .file-btn {
            font-size: 12px;
            padding: 8px 12px;
            border-radius: 10px;
        }
    </style>

    <div class="page-content">
        <div class="content-inner pt-0">
            <div class="container fb">

                <div class="dashboard-area m-b30">
                    <div class="features-box mt-3">

                        <div class="row g-3">

                            @forelse($terms as $key => $item)
                                <div class="col-12 col-sm-6">

                                    <div class="term-card">
                                        <div class="term-card-header">
                                            <span class="term-type">{{ ucfirst($item->type) }}</span>

                                            <h6 class="term-card-title mt-2">
                                                {{ $item->title }}
                                            </h6>
                                        </div>

                                        <div class="term-card-body">

                                            @php
                                                $shortContent = \Illuminate\Support\Str::limit(strip_tags($item->content), 65);
                                            @endphp

                                            <p class="mb-2">
                                                {{ $shortContent }}
                                            </p>

                                            <div class="collapse" id="termContent{{ $item->id }}">
                                                <div class="mt-2">
                                                    {!! nl2br(e($item->content)) !!}
                                                </div>
                                            </div>

                                            @if($item->content && strlen(strip_tags($item->content)) > 70)
                                                <button class="read-more-btn" data-bs-toggle="collapse"
                                                    data-bs-target="#termContent{{ $item->id }}">
                                                    Read More
                                                </button>
                                            @endif

                                            @if($item->file)
                                                <div class="mt-3">
                                                    <a href="{{ asset($item->file) }}" target="_blank"
                                                        class="btn btn-primary w-100 file-btn">
                                                        View / Download
                                                    </a>
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <h5 class="text-muted">No Terms & Conditions Found</h5>
                                </div>
                            @endforelse

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('vivah_mitra.includes.home_footer_menu')
@endsection