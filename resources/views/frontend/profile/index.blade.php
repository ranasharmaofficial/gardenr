@extends('frontend.layouts.master')
@section('title') My Profile @endsection

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </div>
            </nav>

            <h1>My Account</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <h2>My Dashboard</h2>
                <div class="alert alert-success alert-intro" role="alert">
                    Thank you for registering with Rich Money.
                </div>
                
                <div class="mb-4"></div>

                <h3>Account Information</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Contact Information
                                <a href="#" class="card-edit">Edit</a>
                            </div>
                            <div class="card-body">
                                <p>
                                    @if(Auth::check())
                                        {{ Auth::user()->name }}<br>
                                        {{ Auth::user()->email }}<br>
                                    @else
                                        Guest User
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">My Account</h3>

                    <ul class="list">
                        <li class="active"><a href="{{ route('profile') }}">Account Dashboard</a></li>
                        <li><a href="#">Account Information</a></li>
                        <li><a href="#">Address Book</a></li>
                        <li><a href="#">My Orders</a></li>
                        <li><a href="{{ url('wishlist') }}">My Wishlist</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
