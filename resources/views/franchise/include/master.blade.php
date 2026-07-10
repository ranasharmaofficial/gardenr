<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ static_asset('assets/favicon.png')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <!-- Sweet Alert Cdn -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="../assets/libs/sweetalert2/sweetalert2.min.css"> --}}
	<!-- Favicon -->
    <link rel="icon" href="{{ static_asset('assets/assets_admin/images/brand-logos/fav.ico') }}" type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ static_asset('assets/assets_admin/js/main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ static_asset('assets/assets_admin/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ static_asset('assets/assets_admin/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ static_asset('assets/assets_admin/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ static_asset('assets/assets_admin/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ static_asset('assets/assets_admin/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/@simonwep/pickr/themes/nano.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/sweetalert2/sweetalert2.min.css') }}">
    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/choices.js/public/assets/styles/choices.min.css') }}">
	<link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/jsvectormap/css/jsvectormap.min.css') }}">
	<link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/swiper/swiper-bundle.min.css') }}">
    <!-- Sweetalerts JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ static_asset('assets/assets_admin/js/sweet-alerts.js') }}"></script>
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('alert-danger'))
                // toastr.error('{{ Session::get('alert-danger') }}');
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: `{{ Session::get('alert-danger') }}`,
                    showConfirmButton: false,
                    timer: 3500
                });
            @elseif(Session::has('alert-success'))
                // toastr.success('{{ Session::get('alert-success') }}');
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: `{{ Session::get('alert-success') }}`,
                    showConfirmButton: false,
                    timer: 3500
                });
            @elseif(Session::has('alert-warning'))
                toastr.success('{{ Session::get('alert-warning') }}');
            @endif
        });

    </script>

	<style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }
        .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 20px;
}

.slider.round:before {
  border-radius: 50%;
}
.status{border-radius: 8px;
padding: 8px;
color:#fff;
text-transform: uppercase;}

    </style>

</head>
<body>
	@include('franchise.include.switch_canvas');
	<div class="page">
		@include('franchise.include.header');
		@include('franchise.include.left_sidebar');



		@yield('content')

		@include('franchise.include.footer');

	</div>



	<!-- Date & Time Picker JS -->
        <script src="{{ static_asset('assets/assets_admin/libs/moment/moment.js')}}"></script>
        <script src="{{ static_asset('assets/assets_admin/js/rightsidebar.js')}}"></script>

	<div class="scrollToTop">
        <a href="javascript:void(0);" class="arrow"><i class="las la-angle-double-up fs-20 text-fixed-white"></i></a>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Popper JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/@popperjs/core/umd/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Defaultmenu JS -->
    <script src="{{ static_asset('assets/assets_admin/js/defaultmenu.min.js')}}"></script>
    <!-- Node Waves JS-->
    <script src="{{ static_asset('assets/assets_admin/libs/node-waves/waves.min.js')}}"></script>
    <!-- Sticky JS -->
    <script src="{{ static_asset('assets/assets_admin/js/sticky.js')}}"></script>
    <!-- Simplebar JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ static_asset('assets/assets_admin/js/simplebar.js')}}"></script>
    <!-- Color Picker JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>
    <!-- Apex Charts JS -->
     <script src="{{ static_asset('assets/assets_admin/libs/apexcharts/apexcharts.min.js')}}"></script>
    <!-- Page Header JS -->
    <script src="{{ static_asset('assets/assets_admin/js/pageheader.js')}}"></script>
    <!-- JSVector Maps JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <!-- JSVector Maps MapsJS -->
    <script src="{{ static_asset('assets/assets_admin/libs/jsvectormap/maps/world-merc.js')}}"></script>
    <!-- Chartjs Chart JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/chart.js/chart.min.js')}}"></script>
    <!-- Apex Charts JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/apexcharts/apexcharts.min.js')}}"></script>
    <!-- Index JS -->
    <script src="{{ static_asset('assets/assets_admin/js/index.js')}}"></script>
    <!-- Custom-Switcher JS -->
    <script src="{{ static_asset('assets/assets_admin/js/custom-switcher.min.js')}}"></script>
    <!-- Custom JS -->
    <script src="{{ static_asset('assets/assets_admin/js/custom.js')}}"></script>
    <script src="{{ static_asset('assets/assets_admin/js/datatables.js') }}"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/ckeditor.js"></script>
	<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    {{-- datatable cdn --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script type="text/javascript">
		$textarea = $('textarea');
		$(document).ready(function() {
			$(function() {
				$.each($textarea, function(index, value) {
					let id = $(this).attr('id');
					let ckeditor = CKEDITOR.replace(id);
					CKEDITOR.config.extraPlugins = 'colorbutton';
				});
			});
		});
	</script>

	@yield('script')
</body>

</html>
