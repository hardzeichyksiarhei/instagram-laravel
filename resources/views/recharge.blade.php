@extends('layouts.app')

@section('content')

<main class="recharge">
  <section class="recharge-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="card">
            <span class="card__sup-title">{{ __('Only through PayPal') }} <i class="fab fa-cc-paypal"></i></span>
            <h3 class="card__title">{{ __('Recharge') }}</h3>
            <div class="card__body">
              @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
                <?php session()->forget('error'); ?>
              @endif
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                <?php session()->forget('success'); ?>
              @endif
              <form class="form" method="POST" action="{{ route('paypal') }}">
                @csrf
                <div class="form-group row">
                  <label for="amount" class="col-sm-2 col-form-label">{{ __("Amount") }}</label>
                  <div class="col-sm-10">
                    <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" id="amount" name="amount" placeholder="0">
                    @if ($errors->has('amount'))
                      <div class="valid-feedback">{{ $errors->first('amount') }}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-sm-10 offset-sm-2 d-flex flex-column align-items-start">
                    <button type="submit" class="btn btn--accent">{{ __('Top up') }}</button>
                    <a class="terms-use" href="#terms-use-popup" data-lity>{{ __('By making a payment, you agree to the terms of use of the service.') }}</a>
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