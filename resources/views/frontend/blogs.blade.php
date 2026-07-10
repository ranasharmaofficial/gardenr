@extends('frontend.layouts.master')
@section('title') Blogs @endsection

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </div>
            </nav>

            <h1>Our Blogs</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            @if(isset($blogs) && count($blogs) > 0)
                @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="post">
                        <div class="post-media">
                            <a href="{{ route('blog.detail', $blog->slug) }}">
                                <img src="{{ static_asset($blog->image) }}" alt="{{ $blog->title }}" width="225" height="280">
                            </a>
                        </div>
                        <div class="post-body">
                            <h2 class="post-title">
                                <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                            </h2>
                            <div class="post-content">
                                <p>{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <i class="icon-calendar" style="font-size: 48px; color: #ccc;"></i>
                    <h3 class="mt-3 text-muted">No blogs found.</h3>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
