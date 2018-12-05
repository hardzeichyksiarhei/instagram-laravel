@extends('layouts.app')

@section('content')

  <main class="home">
    <section class="preview-section">
      <div id="preview-carousel" class="owl-carousel owl-theme preview-carousel">
        <div class="item" style="background-image: url({{ asset('assets/img/zoltan-tasi-1174549-unsplash.jpg') }});"></div>
        <div class="item" style="background-image: url({{ asset('assets/img/syd-sujuaan-293256-unsplash.jpg') }});"></div>
        <div class="item" style="background-image: url({{ asset('assets/img/zoltan-tasi-1174549-unsplash.jpg') }});"></div>
        <div class="item" style="background-image: url({{ asset('assets/img/syd-sujuaan-293256-unsplash.jpg') }});"></div>
      </div>
      <div class="mask"></div>
      <div class="container">
        <div class="preview-content">
          <h3 class="preview-suptitle">БЫСТРО, КАЧЕСТВЕННО, С ГАРАНТИЕЙ!</h3>
          <h1 class="preview-title">Накрутка вcего что угодно в INSTAGRAM</h1>
          <div class="preview-btn-set">
            @guest
              <a href="{{ route('login') }}" class="btn btn--accent">Войти</a>
              <a href="{{ url('/password/reset') }}" class="btn">Забыли пароль?</a>
            @endguest
          </div>
          <img class="preview-arrow-down" src="{{ asset('assets/img/right-arrow-circular-button.svg') }}" alt="Arrow Down">
        </div>
      </div>
    </section>
    <section class="options-section">
      <div class="container">
        <div class="options-content">
          <ul class="nav nav-tabs nav-tabs-options">
            @foreach ($services as $k=>$service)
              <li class="nav-item">
                <a class="nav-link {{ $k == 0 ? 'active' : '' }}" data-toggle="tab" href="#{{ 'service-' . $k }}">
                  <div class="icon"></div>
                  <span>{{ $service->name }}</span>
                </a>
              </li>
            @endforeach
          </ul>
          <div class="tab-content tab-content-options">
            @foreach ($services as $k=>$service)
              <div class="tab-pane fade {{ $k == 0 ? 'show active' : '' }}" id="{{ 'service-' . $k }}">
                <div class="row">
                  <div class="col-md-4">
                    <div class="tab-options-meta">
                      <h3 class="tab-options-meta__title">{{ $service->name }}</h3>
                      <p class="tab-options-meta__desc">{{ $service->excerpt }}</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="tab-options-desc">
                      {!! $service->desc !!}
                      <a href="{{ route('price') }}" class="more">Перейти к полному списку услуг<i class="fas fa-angle-double-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <section class="skills-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div id="skills-carousel" class="skills-carousel owl-carousel owl-theme">
              <div class="skills-carousel-item">
                <img src="{{ asset('assets/img/phone-message.svg') }}" alt="" class="skills-carousel-icon">
                <h3 class="skills-carousel-title">Мы всегда рядом</h3>
                <span class="skills-carousel-desc">Пока вы отдыхаете мы работаем</span>
              </div>
              <div class="skills-carousel-item">
                <img src="{{ asset('assets/img/time_management.svg') }}" alt="" class="skills-carousel-icon">
                <h3 class="skills-carousel-title">Мы ценим время</h3>
                <span class="skills-carousel-desc">Скорость очень важна для нас</span>
              </div>
              <div class="skills-carousel-item">
                <img src="{{ asset('assets/img/idea.svg') }}" alt="" class="skills-carousel-icon">
                <h3 class="skills-carousel-title">Мы кративны</h3>
                <span class="skills-carousel-desc">Находим для вас лучшие идеи</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="contacts-section">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2 class="contacts-title">Наши контакты</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="card">
              <div class="card__item">
                <i class="card__icon fas fa-user-tie"></i>
                <p class="card__desc">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне.</p>
              </div>
              <div class="card__item">
                <i class="card__icon fas fa-user-tie"></i>
                <p class="card__desc">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне.</p>
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