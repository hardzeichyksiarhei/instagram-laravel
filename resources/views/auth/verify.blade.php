@extends('layouts.app')

@section('content')
<main class="verified">
  <section class="verified-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
              <h3 class="card__title">{{ __('Verify Your Email Address') }}</h3>

              <div class="card__body">
                  @if (session('resent'))
                      <div class="alert alert-success" role="alert">
                          {{ __('A fresh verification link has been sent to your email address.') }}
                      </div>
                  @endif

                  {{ __('Before proceeding, please check your email for a verification link.') }}
                  {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
              </div>
          </div>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection
