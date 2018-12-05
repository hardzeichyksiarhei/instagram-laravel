@extends('layouts.app')

@section('content')

<main class="password-email">
    <section class="password-email-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="card">
              <h3 class="card__title">{{ __('Reset Password') }}</h3>
              <div class="card__body">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form class="form" method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">{{ __('E-Mail Address') }}</label>
                    <div class="col-sm-9">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email">
                      @if ($errors->has('email'))
                        <div class="valid-feedback">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-sm-9 offset-sm-3 d-flex flex-column align-items-start">
                      <button type="submit" class="btn btn--accent">{{ __('Send Password Reset Link') }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-2 offset-lg-1 col-md-4 offset-md-4 mt-5 mt-lg-0 d-none d-md-flex align-items-center">
            <img class="instagram img-responsive img-width" src="{{ asset('assets/img/instagram.png') }}" alt="Instagram">
          </div>
        </div>
      </div>
    </section>
  </main>
  
@endsection
