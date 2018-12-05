@extends('layouts.app')

@section('content')

<main class="registration">
  <section class="registration-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="card">
            <h3 class="card__title">{{ __('Account registration') }}</h3>
            <div class="card__body">
              <form class="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input class="form-control" id="phone" name="phone" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
                      @if ($errors->has('password'))
                        <div class="valid-feedback">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="E-Mail" value="{{ old('email') }}">
                      @if ($errors->has('email'))
                        <div class="valid-feedback">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="repeat-password" name="password_confirmation" placeholder="{{ __('Repeat password') }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group mb-0">
                      <button type="submit" class="btn btn--accent">{{ __('To register') }}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-2 offset-lg-1 d-none d-sm-flex align-items-center">
          <img class="instagram img-responsive img-width" src="{{ asset('assets/img/instagram.png') }}" alt="Instagram">
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
