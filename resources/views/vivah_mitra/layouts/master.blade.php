<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      {{-- @yield('meta_tags') --}}

	  @include('vivah_mitra.includes.link')
   </head>
    <body>
        <div class="page-wraper">
            <!-- Preloader Start -->
            {{-- <div class="se-pre-con"></div> --}}
           
            <!-- header end -->
            @yield('content')
            <!--footer-->
            {{-- @include('vivah_mitra.includes.footer') --}}
            @include('vivah_mitra.includes.script')
        </div>
    </body>
</html>

