<!DOCTYPE html>
<html class="fixed" lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="{{URL::asset('front/image/favicon.png')}}" rel="icon" />
<title>Marketshop - eCommerce HTML Template</title>
<meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="{{URL::asset('front/js/bootstrap/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('front/css/font-awesome/css/font-awesome.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('front/css/stylesheet.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('front/css/owl.carousel.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('front/css/owl.transitions.css')}}" />
@yield('product_page_css1_product')
<link rel="stylesheet" type="text/css" href="{{URL::asset('front/css/responsive.css')}}" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>
<!-- CSS Part End-->
</head>
<body>
<div class="wrapper-wide">

    @include('layouts.header_main')
    @yield('content')
    @include('layouts.footer_main')

</div>
<!-- JS Part Start-->
<script type="text/javascript" src="{{URL::asset('front/js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('front/js/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('front/js/jquery.easing-1.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('front/js/jquery.dcjqaccordion.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('front/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('front/js/custom.js')}}"></script>
<!-- JS Part End-->

@yield('product_page_js1')

@yield('product_page_js2')
</body>
</html>