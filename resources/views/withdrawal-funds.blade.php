@extends('layouts.app')

@section('content')

  <main class="withdrawal-funds">
    <section class="withdrawal-funds-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="card">
              <h3 class="card__title">{{ __('Withdrawal of funds') }}</h3>
              <div class="card__body">
                @if (session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                @endif
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif
                <form class="form" method="POST" action="{{ route('store-billing') }}">
                  @csrf
                  <div class="withdrawal-funds-select">
                    <h4 class="withdrawal-funds-select-title" data-count="1">{{ __('Choose output method') }}</h4>
                    <ul class="withdrawal-funds-list{{ $errors->has('payment_system') ? ' is-invalid' : '' }}">
                      <li class="withdrawal-funds-item">
                        <input type="radio" name="payment_system" id="paypal" value="PayPal">
                        <label for="paypal"><img src="{{ asset('assets/img/paypal.svg') }}" alt=""></label>
                      </li>
                      <li class="withdrawal-funds-item">
                        <input type="radio" name="payment_system" id="visa" value="Visa/MasterCard">
                        <label for="visa"><img src="{{ asset('assets/img/visa.svg') }}" alt=""></label>
                      </li>
                      <li class="withdrawal-funds-item">
                        <input type="radio" name="payment_system" id="bitcoin" value="Bitcoin">
                        <label for="bitcoin"><img src="{{ asset('assets/img/bitcoin.svg') }}" alt=""></label>
                      </li>
                      <li class="withdrawal-funds-item">
                        <input type="radio" name="payment_system" id="webmoney" value="WebMoney">
                        <label for="webmoney"><img src="{{ asset('assets/img/webmoney.svg') }}" alt=""></label>
                      </li>
                      <li class="withdrawal-funds-item">
                        <input type="radio" name="payment_system" id="yandex" value="Yandex">
                        <label for="yandex"><img src="{{ asset('assets/img/yandex.svg') }}" alt=""></label>
                      </li>
                      <li class="withdrawal-funds-item">
                        <input type="radio" name="payment_system" id="qiwi" value="QiWi">
                        <label for="qiwi"><img src="{{ asset('assets/img/qiwi.svg') }}" alt=""></label>
                      </li>
                    </ul>
                    @if ($errors->has('payment_system'))
                      <div class="valid-feedback">{{ $errors->first('payment_system') }}</div>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <h4 class="withdrawal-funds-select-title" data-count="2">{{ __('Enter amount') }}</h4>
                      <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label">{{ __('Amount') }}</label>
                        <div class="col-sm-10">
                          <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" id="amount" name="amount" placeholder="0" value="{{ old('amount') }}">
                          @if ($errors->has('amount'))
                            <div class="valid-feedback">{{ $errors->first('amount') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4 class="withdrawal-funds-select-title" data-count="3">{{ __('Your wallet number') }}</h4>
                      <div class="form-group row">
                        <label for="score" class="col-sm-1 col-form-label">№</label>
                        <div class="col-sm-11">
                          <input class="form-control{{ $errors->has('score') ? ' is-invalid' : '' }}" id="score" name="score" placeholder="{{ __('Example') }}: 410012259662254" value="{{ old('score') }}">
                          @if ($errors->has('score'))
                            <div class="valid-feedback">{{ $errors->first('score') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group row mb-0">
                        <div class="col-sm-10 offset-sm-2 d-flex flex-column align-items-start">
                          <div class="d-flex align-items-center">
                            <button class="btn btn--accent mr-3">{{ __('Withdraw') }}</button>
                            <span>{{ __('The commission fee is') }} - {{ $withdrawal_commission }}%</span>
                          </div>
                          <a class="terms-use" href="#terms-use-popup" data-lity>{{ __('By making a payment, you agree to the terms of use of the service.') }}</a>
                        </div>
                      </div>
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