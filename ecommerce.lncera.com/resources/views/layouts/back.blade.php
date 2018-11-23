<!doctype html>
<html class="fixed header-dark" lang="{{ app()->getLocale() }}">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Dark Header Layout | Porto Admin - Responsive HTML5 Template 2.0.0</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{URL::asset('back/vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('back/vendor/animate/animate.css')}}">

		<link rel="stylesheet" href="{{URL::asset('back/vendor/font-awesome/css/font-awesome.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('back/vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('back/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

		@yield('specific_page_vendor_css')

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{URL::asset('back/css/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{URL::asset('back/css/skins/default.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{URL::asset('back/css/custom.css')}}">

        <script src="{{URL::asset('back/vendor/jquery/jquery.js')}}"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
              </script>
		<!-- Head Libs -->
		<script src="{{URL::asset('back/vendor/modernizr/modernizr.js')}}"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
            @include('layouts.header_back')
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
                @include('layouts.sidebar_left_back')
				<!-- end: sidebar -->
                @yield('content')
			</div>

            @include('layouts.sidebar_right_back')


		</section>

		<!-- Vendor -->

		<script src="{{URL::asset('back/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
		<script src="{{URL::asset('back/vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/bootstrap/js/bootstrap.js')}}"></script>
		<script src="{{URL::asset('back/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
		<script src="{{URL::asset('back/vendor/common/common.js')}}"></script>
		<script src="{{URL::asset('back/vendor/nanoscroller/nanoscroller.js')}}"></script>
		<script src="{{URL::asset('back/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
		<script src="{{URL::asset('back/vendor/jquery-placeholder/jquery-placeholder.js')}}"></script>

        @yield('specific_page_vendor_js')

		<!-- Theme Base, Components and Settings -->
		<script src="{{URL::asset('back/js/theme.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{URL::asset('back/js/custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{URL::asset('back/js/theme.init.js')}}"></script>

        @yield('example')

	</body>
</html>