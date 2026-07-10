@extends('frontend.layouts.master')
@section('title') My Wishlist @endsection

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </div>
            </nav>

            <h1>My Wishlist</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="icon-wishlist-2" style="font-size: 48px; color: #ccc;"></i>
                <h3 class="mt-3 text-muted">Your wishlist is currently empty.</h3>
                <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        </div>
    </div>
</main>
@endsection
