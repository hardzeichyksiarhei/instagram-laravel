@extends('layouts.app')

@section('content')

<main class="recharge">
    <section class="recharge-section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <h3 class="card__title">Партнерская программа</h3>
                <div class="card__body">
                    <h4>
                        Регистрация
                    </h4>
                    <code class="card__referral">
                        {{ auth()->user()->getReferral()->link }}
                    </code>
                    <p>
                        Количество привлеченных пользователей: {{ auth()->user()->getReferral()->relationships()->count() }}
                    </p>
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
                            @forelse($referral->relationships as $relation)
                              <tr>
                                <td>{{ $relation->id }}</td>
                                <td>{{ $relation->user_id }}</td>
                                <td>{{ $relation->referral_balans }}</td>
                                <td>{{ $relation->created_at }}</td>
                              </tr>
                            @endforeach
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