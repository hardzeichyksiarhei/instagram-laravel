@extends('layouts.app')

@section('content')

<main class="price-list">
  <section class="price-list-section">
    <div class="container">
      <div class="price-list-title-wrapper">
        <h2 class="price-list-title">{{ __('Price list for services') }}</h2>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>{{ __('View cheat') }}</th>
              <th>{{ __('Description') }}</th>
              <th>{{ __('Minimum') }}</th>
              <th>{{ __('Maximum') }}</th>
              <th>{{ __('The cost is minimal') }}</th>
              <th>{{ __('Cost for 1000') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pricelists as $pricelist)
              <tr>
                <td>{{ $pricelist->cheat_id }}</td>
                <td>{{ $pricelist->name }}</td>
                <td>{{ $pricelist->desc }}</td>
                <td>{{ $pricelist->min }}</td>
                <td>{{ $pricelist->max }}</td>
                <td>{{ $pricelist->min_price }}p за {{ $pricelist->min }}</td>
                <td>{{ $pricelist->max_price }}p за 1000</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

@endsection