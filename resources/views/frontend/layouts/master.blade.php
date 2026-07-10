<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title') - {{ env('APP_NAME') }}</title>
      {{-- @yield('meta_tags') --}}

	  @include('frontend.includes.link')
   </head>
   <body class="home-5">
            <!-- Preloader Start -->
            <div class="se-pre-con"></div>
            @include('frontend.includes.header')
            <!-- header end -->
            @yield('content')
            <!--footer-->
            @include('frontend.includes.footer')
            @include('frontend.includes.script')
        {{-- </div> --}}
    </body>
</html>

