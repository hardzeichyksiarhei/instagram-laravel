@extends('layouts.app')

@section('content')

  <main class="all-orders">
    <section class="all-orders-section">
      <div class="container">
        <div class="all-orders-title-wrapper">
          <h2 class="all-orders-title">{{ __('All orders') }}</h2>
        </div>
        <!--<div class="table-search">
          <form class="table-search-form" action="">
            <input class="table-search-control" placeholder="Поиск">
          </form>
        </div>-->
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>№</th>
                <th>{{ __('View cheat') }}</th>
                <th>{{ __('Cost') }}</th>
                <th>{{ __('Link to account') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Time') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Status') }}</th>
              </tr>
            </thead>
            <tbody>
              @if (count($orders))
                @foreach ($orders as $k=>$order)
                  <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $order->cheat_name }}</td>
                    <td>{{ $order->price }}</td>
                    <td><a href="{{ $order->link }}" target="_blank">{{ $order->link }}</a></td>
                    <td>{{ $order->created_at->format('d.m.Y') }}</td>
                    <td>{{ $order->created_at->format('H:i') }}</td>
                    <td>{{ $order->count }}</td>
                    <td><span class="status">{{ __($order->status) }}</span></td>
                  </tr>
                @endforeach
              @else
                <tr><td colspan="8">{{ __('Empty') }}</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

@endsection
