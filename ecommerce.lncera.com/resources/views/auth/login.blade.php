@extends('layouts.main')


@section('content')

  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('index') }}">Account</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title">Account Login</h1>
          <div class="row">
            <div class="col-sm-6">
              <h2 class="subtitle">New Customer</h2>
              <p><strong>Register Account</strong></p>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
              <a href="{{ route('register') }}" class="btn btn-primary">Continue</a> </div>
            <div class="col-sm-6">
              <h2 class="subtitle">Returning Customer</h2>
              <p><strong>I am a returning customer</strong></p>
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="control-label" for="email">E-Mail Address</label>
                  <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" id="email" class="form-control" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="control-label" for="password">Password</label>
                  <input type="password" name="password" value="" placeholder="Password" id="password" class="form-control" required/>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                  <br />
                  <a class="btn btn-link" href="{{ route('password.request') }}">Forgotten Password</a></div>
                <input type="submit" value="Login" class="btn btn-primary" />
              </form>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        {{--<aside id="column-right" class="col-sm-3 hidden-xs">--}}
          {{--<h3 class="subtitle">Account</h3>--}}
          {{--<div class="list-group">--}}
            {{--<ul class="list-item">--}}
              {{--<li><a href="login.html">Login</a></li>--}}
              {{--<li><a href="register.html">Register</a></li>--}}
              {{--<li><a href="#">Forgotten Password</a></li>--}}
              {{--<li><a href="#">My Account</a></li>--}}
              {{--<li><a href="#">Address Books</a></li>--}}
              {{--<li><a href="wishlist.html">Wish List</a></li>--}}
              {{--<li><a href="#">Order History</a></li>--}}
              {{--<li><a href="#">Downloads</a></li>--}}
              {{--<li><a href="#">Reward Points</a></li>--}}
              {{--<li><a href="#">Returns</a></li>--}}
              {{--<li><a href="#">Transactions</a></li>--}}
              {{--<li><a href="#">Newsletter</a></li>--}}
              {{--<li><a href="#">Recurring payments</a></li>--}}
            {{--</ul>--}}
          {{--</div>--}}
        {{--</aside>--}}
        <!--Right Part End -->
      </div>
    </div>
  </div>

@endsection