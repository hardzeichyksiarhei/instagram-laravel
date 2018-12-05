@extends('layouts.app')

@section('content')

  <main class="billing">
    <section class="billing-section">
      <div class="container">
        <div class="billing-title-wrapper">
          <h2 class="billing-title">Биллинг</h2>
        </div>
        <!--<div class="table-search">
          <form class="table-search-form" action="">
            <input class="table-search-control" placeholder="Поиск">
          </form>
        </div> -->
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Сумма</th>
                <th>Предварительный баланс</th>
                <th>Платёжная система</th>
                <th>Дата</th>
                <th>Время</th>
                <th>Статус</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($billings as $b)
                <tr>
                  <td>{{ $b->id }}</td>
                  <td>{{ $b->amount }} Руб</td>
                  <td>{{ Auth::user()->balans - $b->amount }}</td>
                  <td>{{ $b->payment_system }}</td>
                  <td>{{ $b->created_at->format('d.m.Y') }}</td>
                  <td>{{ $b->created_at->format('H:i') }}</td>
                  <td>
                    @if ($b->status == 'process')
                      <span class="status status--process">{{ __('Process') }}</span>
                    @elseif ($b->status == 'done')
                      <span class="status status--done">{{ __('Done') }}</span>
                    @else
                      <span class="status status--cancel">{{ __('Cancel') }}</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>
    
@endsection
