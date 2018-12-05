@extends('layouts.app')

@section('content')

  <main class="login">
    <section class="login-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="card">
              <h3 class="card__title">{{ __('Login to account') }}</h3>
              <div class="card__body">
                <form class="form" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="E-Mail" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                          <div class="valid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                          <div class="valid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group mb-0 flex-row">
                        <button type="submit" class="btn btn--accent">{{ __('Login') }}</button>
                        @if (Route::has('password.request'))
                          <div class="dropdown restore-password-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">{{ __('Forgot?') }}</a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                              </a>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="registration-info">
              <i class="registration-info-icon fas fa-book-reader"></i>
              <p class="registration-info-desc">Регистрация возможна только по пригласительным ссылкам наших пользователей. Не надо вводить свой пароль от инстаграм.</p>
              <img class="instagram img-responsive img-width d-none d-sm-flex" src="{{ asset('assets/img/instagram.png') }}" alt="Instagram">
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
