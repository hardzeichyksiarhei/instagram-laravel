@extends('layouts.app')

@section('content')
<main class="password-reset">
  <section class="password-reset-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card__title">{{ __('Reset Password') }}</h3>
                <div class="card__body">
                    <form class="form" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">{{ __('E-Mail Address') }}</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $email ?? old('email') }}" id="email" name="email" required autofocus>
                            @if ($errors->has('email'))
                              <div class="valid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">{{ __('Password') }}</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ $password ?? old('password') }}" id="password" name="password" required>
                            @if ($errors->has('password'))
                              <div class="valid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="password-confirm" class="col-sm-3 col-form-label">{{ __('Confirm Password') }}</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password-confirm" name="password_confirmation" required>
                            @if ($errors->has('password'))
                              <div class="valid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn--accent">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
