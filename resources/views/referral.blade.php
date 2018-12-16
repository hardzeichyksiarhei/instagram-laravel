@extends('layouts.app')

@section('content')

<main class="recharge">
    <section class="recharge-section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <h3 class="card__title">{{ __('Affiliate program') }}</h3>
                <div class="card__body">
                  <h4>{{ __('Register') }}</h4>
                  <code class="card__referral">
                      {{ auth()->user()->getReferral()->link }}
                  </code>
                  <p>
                    {{ __('The number of attracted users') }}: {{ auth()->user()->getReferral()->relationships()->count() }}
                  </p>
                  <h4>КАК ЭТО РАБОТАЕТ?</h4>
                  <p>Поделитесь партнерской ссылкой с друзьями, порекомендуйте сервис в соцсетях или запустите рекламу. 
                      Пользователь переходит по вашей ссылке и регистрируется в сервисе. 
                      Вы получаете пожизненный пассивный доход в виде 5% от суммы оплаченных им услуг. 
                      Вознаграждение будет зачисляеться на ваш баланс при каждой будущей оплате партнера. 
                      Возможен вывод заработанных средств на ваш кошелёк (от тысячи рублей).</p>
                </div>
              </div>
            </div>
          </div>
          @if ( $referral = auth()->user()->getReferral() )
            <div class="row mt-5">
              <div class="col-12">
                <div class="card">
                  <h3 class="card__title"></h3>
                  <div class="card__body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>ID партнера</th>
                              <th>Прибыль</th>
                              <th>Дата регистрации</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if (count($referral->relationships))
                              @forelse($referral->relationships as $relation)
                                <tr>
                                  <td>{{ $relation->id }}</td>
                                  <td>{{ $relation->user_id }}</td>
                                  <td>{{ $relation->referral_balans }}</td>
                                  <td>{{ $relation->created_at }}</td>
                                </tr>
                              @endforeach
                            @else
                              <tr><td align="center" colspan="4">{{ __('Empty') }}</td></tr>
                            @endif
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          @else   
            Нет рефералов
          @endif
        </div>
      </section>

</main>

@endsection