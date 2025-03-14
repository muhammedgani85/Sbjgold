@extends('layouts/blankLayout')

@section('title', 'SJ Gold Finance - Login')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<!-- Content -->
<div class="authentication-wrapper authentication-cover">
  <!-- Logo -->
  <a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1" class="auth-cover-brand d-flex align-items-center gap-2">


  </a>
  <!-- /Logo -->
  <div class="authentication-inner row m-0">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
      <div class="w-100 d-flex justify-content-center">

        <img src="http://127.0.0.1:8000/assets/images/login.jpeg" class="img-fluid" alt="Login image" width="1200" data-app-dark-img="illustrations/boy-with-rocket-dark.png" data-app-light-img="illustrations/boy-with-rocket-light.png" style="border-radius: 25px;">
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">

      <div class="w-px-400 mx-auto mt-12 pt-5">

        <h4 class="mb-1">Welcome to SJ Gold Finance</h4>
        <p class="mb-6">Please sign-in to your account</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('login_verfication') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Username</label>
              <input type="text" class="form-control" id="email" name="username" id="username" placeholder="Enter your username" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <!--  <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Forgot Password?</small>
                </a> -->
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <!--  <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Remember Me
                </label>
              </div>
            </div> -->
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>




      </div>
    </div>
    <!-- /Login -->
  </div>
</div>
<!--/ Content -->
@endsection
