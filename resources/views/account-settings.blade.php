@extends('layouts.app')

@section('content')

  <main class="account-settings">
    <section class="account-settings-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="card">
              <h3 class="card__title">Настройки аккаунта</h3>
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
                <form class="form" method="POST" action="{{ route('change-password') }}">
                  @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <h3 class="form-title">Смена пароля</h3>
                      <div class="form-group row">
                        <label for="current-password" class="col-sm-3 col-form-label">Текущий пароль</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control{{ $errors->has('current-password') ? ' is-invalid' : '' }}" id="current-password" name="current-password" placeholder="Ваш пароль" value="{{ old('current-password') }}">
                          @if ($errors->has('current-password'))
                            <div class="valid-feedback">{{ $errors->first('current-password') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new-password" class="col-sm-3 col-form-label">Новый пароль</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control{{ $errors->has('new-password') ? ' is-invalid' : '' }}" id="new-password" name="new-password" placeholder="Новый пароль" value="{{ old('new-password') }}">
                          @if ($errors->has('new-password'))
                            <div class="valid-feedback">{{ $errors->first('new-password') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new-password_confirmation" class="col-sm-3 col-form-label">Новый пароль</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="new-password_confirmation" name="new-password_confirmation" placeholder="Повторите новый пароль">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h3 class="form-title">Общая информация</h3>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Ваша почта</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="email" placeholder="{{ Auth::user()->email }}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Статус</label>
                        <div class="col-sm-9">
                          <input class="form-control" id="status" placeholder="{{ Auth::user()->is_admin ? 'Администратор' : 'Пользователь' }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group row">
                        <div class="col-lg-9 offset-lg-3 d-flex align-items-center">
                          <button type="submit" class="btn btn--accent">Сменить пароль</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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

