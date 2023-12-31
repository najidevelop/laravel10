<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email')  is-invalid  @enderror" placeholder="{{ __('Email') }}" value="{{old('email')}}" required autofocus autocomplete="username" id="email"  name="email"
          @error('email')  
          describedby="email-error" aria-invalid="true"  
          @enderror  >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')  
          <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
          @enderror 
        </div>
        
        <div class="input-group mb-3">
          <input type="password"  id="password"  class="form-control @error('password')  is-invalid  @enderror" placeholder="Password"  name="password"
                            required autocomplete="current-password"
                            @error('password')  
                            describedby="password-error" aria-invalid="true"  
                            @enderror  >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')  
          <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
          @enderror 
        </div>
       
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember_me" name="remember">
              <label for="remember_me">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
          </div>
          <!-- /.col -->
        </div>
           @if (Route::has('password.request'))
           <p class="mb-1"></p>
                <a class="text-center" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                 </p>
            @endif
      </form>
<p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
      </p>
      <!-- /.social-auth-links -->     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('admin/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
