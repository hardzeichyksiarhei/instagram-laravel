@extends('layouts.app')

@section('content')

  <main class="all-orders">
    <section class="all-orders-section">
      <div class="container">
        <div class="all-orders-title-wrapper">
          <h2 class="all-orders-title">Все заказы</h2>
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
                <th>Вид накрутки</th>
                <th>Стоимость</th>
                <th>Ссылка на аккаунт</th>
                <th>Дата</th>
                <th>Время</th>
                <th>Количество</th>
                <th>Статус</th>
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
                    <td>19.10.2018</td>
                    <td>16:27</td>
                    <td>{{ $order->count }}</td>
                    <td><span class="status">{{ $order->status }}</span></td>
                  </tr>
                @endforeach
              @else
                  <tr><td colspan="8">Заказов нет</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

@endsection
