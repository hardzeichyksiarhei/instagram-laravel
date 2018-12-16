@extends('layouts.app')

@section('content')

  <main class="exercise-cheat">
    <section class="exercise-cheat-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div id="exercise-cheat" class="card">
              <h3 class="card__title">{{ __('Exercise cheat') }}</h3>
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
                <div class="row">
                  <div class="col-lg-7">
                    <form id="order-form" class="form order-form" method="POST" action="{{ route('order') }}">
                      @csrf
                      <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">{{ __('Category') }}</label>
                        <div class="col-sm-9">
                          <select class="form-control" v-model="selectedCategoryCheat">
                            <option value="0" disabled>{{ __('Select a category cheat') }}</option>
                            <option v-for="category in optionsCategoryCheat" :value="category.id">
                              @{{ category.name }}
                            </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">{{ __('View cheat') }}</label>
                        <div class="col-sm-9">
                          <select class="form-control" v-model="selectedViewCheat" :disabled="!optionsViewCheat.length">
                            <option value="0" disabled>{{ __('Select the type of cheating') }}</option>
                            <option v-for="view in optionsViewCheat" :value="view">
                              @{{ view.name }}
                            </option>
                          </select>
                          <input type="hidden" class="form-control{{ $errors->has('cheat_name') ? ' is-invalid' : '' }}" name="cheat_name" v-model="selectedViewCheat.name">
                          @if ($errors->has('cheat_name'))
                            <div class="valid-feedback">{{ $errors->first('cheat_name') }}</div>
                          @endif
                          <input type="hidden" class="form-control" name="cheat_id" v-model="selectedViewCheat.cheat_id">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="link" class="col-sm-3 col-form-label">{{ __('Link to account') }}</label>
                        <div class="col-sm-9">
                          <input class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" id="link" placeholder="{{ __('Link') }}" name="link" v-model="link">
                          @if ($errors->has('link'))
                            <div class="valid-feedback">{{ $errors->first('link') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="count-people" class="col-sm-3 col-form-label">{{ __('Number of people') }}</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control{{ $errors->has('count') ? ' is-invalid' : '' }}" id="count-people" placeholder="0" name="count" v-model="count">
                          @if ($errors->has('count'))
                            <div class="valid-feedback">{{ $errors->first('count') }}</div>
                          @endif
                          <input type="hidden" class="form-control" name="price" v-model="price">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-9 offset-lg-3 d-flex align-items-center">
                          <button type="submit" class="btn btn--accent">{{ __('To order') }}</button>
                          <span class="curent-price"><span class="text-accent-2">{{ __('Cost') }}:&nbsp;</span>@{{ price }} Р</span>
                        </div>
                      </div>
                      <input type="hidden" class="form-control" name="min" v-model="min">
                      <input type="hidden" class="form-control" name="max" v-model="max">
                    </form>
                  </div>
                  <div class="col-lg-5">
                    <div class="exercise-cheat-info-block">
                      <span class="current-balance"><span class="text-accent-2">{{ __('Your balance') }}:&nbsp;</span>{{ Auth::user()->balans }} Р</span>
                      <div class="desc-service">
                        <span class="text-accent-2">{{ __('Description of the selected service') }}:</span>
                        <span>{{ __('Minimum order') }}: @{{ min }}</span>
                        <span>{{ __('Maximum') }}: @{{ max }}</span>
                        <p v-if="description">@{{ description }}</p>
                        <span v-else>{{ __('Select the service of interest.') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 offset-lg-1 d-none d-sm-flex align-items-center">
            <img class="instagram img-responsive img-width" src="{{ asset('assets/img/instagram.png') }}" alt="Instagram">
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
    
