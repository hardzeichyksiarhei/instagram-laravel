@extends('layouts.app')

@section('content')

  <main class="exercise-cheat">
    <section class="exercise-cheat-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div id="exercise-cheat" class="card">
              <h3 class="card__title">Осуществление накрутки</h3>
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
                    <form class="form" method="POST" action="{{ route('order') }}">
                      @csrf
                      <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">Категория</label>
                        <div class="col-sm-9">
                          <!-- <select2 :options="optionsCategoryCheat" v-model="selectedCategoryCheat">
                            <option disabled value="0">Выберите категорию накрутки</option>
                          </select2> -->
                          <select class="form-control" v-model="selectedCategoryCheat">
                            <option value="0" disabled>Выберите категорию накрутки</option>
                            <option v-for="category in optionsCategoryCheat" :value="category.id">
                              @{{ category.name }}
                            </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">Вид накрутки</label>
                        <div class="col-sm-9">
                          <select class="form-control" v-model="selectedViewCheat">
                            <option value="0" disabled>Выберите вид накрутки</option>
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
                        <label for="link" class="col-sm-3 col-form-label">Ссылка на аккаунт</label>
                        <div class="col-sm-9">
                          <input class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" id="link" placeholder="Ссылка" name="link" v-model="link">
                          @if ($errors->has('link'))
                            <div class="valid-feedback">{{ $errors->first('link') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="count-people" class="col-sm-3 col-form-label">Кол-во человек</label>
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
                          <button type="submit" class="btn btn--accent">Заказать</button>
                          <span class="curent-price"><span class="text-accent-2">Стоимость:&nbsp;</span>@{{ price }} Р</span>
                        </div>
                      </div>
                      <input type="hidden" class="form-control" name="min" v-model="min">
                      <input type="hidden" class="form-control" name="max" v-model="max">
                    </form>
                  </div>
                  <div class="col-lg-5">
                    <div class="exercise-cheat-info-block">
                      <span class="current-balance"><span class="text-accent-2">Ваш баланс:&nbsp;</span>{{ Auth::user()->balans }} Р</span>
                      <div class="desc-service">
                        <span class="text-accent-2">Описание выбранной услуги:</span>
                        <span>Минимальный заказ: @{{ min }}</span>
                        <span>Максимум: @{{ max }}</span>
                        <p v-if="description">@{{ description }}</p>
                        <span v-else>Выберите интересующую услугу.</span>
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
    
