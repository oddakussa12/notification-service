

@extends('layout.master-mini')
@section('content')
<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_2.jpeg') }}); background-size: cover;">
  <div class="row w-100">
    
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <div class="text-center" style="margin-top:-20px;">
        <img width="60" height="60"src="{{ asset('/favicon.jpg') }}"/>
        </div>
     
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label class="label">Phone number</label>
            <div class="input-group">
              <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-cellphone-iphone"></i>
                </span>
              </div>
              @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            
          </div>
          <div class="form-group" style="margin-top:30px;">
            <label class="label">Password</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="*********">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-lock"></i>
                </span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group" style="margin-top:40px;">
            <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
          </div>
          <!-- <div class="form-group d-flex justify-content-between">
            <div class="form-check form-check-flat mt-0">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
            </div>
            <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
          </div> -->
          <!-- <div class="form-group">
            <button class="btn btn-block g-login">
              <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>
          </div> -->
          <!-- <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">Not a member ?</span>
            <a href="{{ url('/user-pages/register') }}" class="text-black text-small">Create new account</a>
          </div> -->
        </form>
      </div>
      <ul class="auth-footer">
        <li>
          <a href="#">Conditions</a>
        </li>
        <li>
          <a href="#">Help</a>
        </li>
        <li>
          <a href="#">Terms</a>
        </li>
      </ul>
      <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
    </div>
  </div>
</div>

@endsection
