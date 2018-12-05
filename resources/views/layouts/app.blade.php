<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	<meta charset="utf-8">
	<!-- <base href="/"> -->

	<title>Instagram</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Template Basic Images Start -->
	<meta property="og:image" content="path/to/image.jpg">
	<link rel="icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon-180x180.png') }}">
	<!-- Template Basic Images End -->
	
	<!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#000">
	<!-- Custom Browsers Color End -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">

</head>

<body class="home-page">

  <!-- Custom HTML -->
  
  <div class="wrapper">
    <header class="top-line-wrapper">
      <div class="container">
        <div class="top-line-content">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Яркий и красочный<br>логотип</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              @auth
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('account-settings') }}">{{ __('Account') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('referral') }}">Партнерка</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('exercise-cheat') }}">{{ __('To order') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('all-orders') }}">{{ __('My orders') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('price') }}">{{ __('Price list') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('withdrawal-funds') }}">Вывод</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('billing') }}">История платежей</a>
                </li>
              </ul>
              @endauth
              <div class="navbar-info">
                @if (Auth::check())<a href="{{ route('recharge') }}" class="balans">{{ __('Balance') }}: {{ Auth::user()->balans }} Р</a>@endif
                <div class="dropdown dropdown-lang">
                  <a class="dropdown-toggle dropdown-lang-toggle" href="#" data-toggle="dropdown">{{ App::getLocale() }}</a>
                  <div class="dropdown-menu dropdown-lang-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item dropdown-lang-item" href="{{ route('setlocale', ['locale' => 'ru']) }}">RU</a>
                    <a class="dropdown-item dropdown-lang-item" href="{{ route('setlocale', ['locale' => 'en']) }}">EN</a>
                  </div>
                </div>
                @if (Auth::check())<a href="{{ route('logout') }}" class="logout">{{ __('Logout') }}</a>@endif
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>

    @yield('content')

    <footer class="main-footer">
      <div class="container">
        <div class="footer-content">
          <span>{{ now()->year }} / {{ __('All rights reserved.') }}</span>
          <span>{{ __('We accept payments via PayPal') }}</span>
          <div class="footer-paypal">
            <i class="fab fa-cc-paypal"></i>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <div id="terms-use-popup" class="terms-use-popup lity-hide">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam harum esse quaerat laboriosam sequi eius amet ab quia illo optio. Iusto sit doloremque voluptatum magnam, perferendis nulla labore impedit harum. Doloremque accusamus dolorum consequatur debitis dignissimos magnam cupiditate, tempore molestias ullam dolorem officia possimus dicta obcaecati quo at incidunt nam ipsa et voluptates! Odit neque ipsa fuga vero nihil vitae laudantium tempora quia, pariatur voluptatem laborum inventore modi iste quae libero odio id sequi quisquam itaque ad exercitationem optio commodi repellendus mollitia. A commodi, ad non enim, similique pariatur dolorem corporis harum, alias ea incidunt laboriosam. Consectetur pariatur tempore ipsa.
  </div>

	<script src="{{ asset('assets/js/scripts.min.js') }}"></script>

</body>
</html>
