<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-paw"></i>
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Criar uma Conta') }}</a>
                        </li>
                    @endif
                @else
                    <div class="alert alert-secondary" role="alert">
                        @if(!empty($dados['total']))
                            R$ {{ number_format($dados['total'],2,",",".") }}
                        @else
                            ...
                        @endif
                    </div>
                    <li class="nav-item dropdown">
                        <a id="navbarAtivos" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="margin-right: 50px; font-size: 25px">
                            <i class="fas fa-hand-holding-usd"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarAtivos">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-ativo-modal">
                                <i class="fas fa-plus-circle" style="color: forestgreen"></i>
                                {{ __('Registrar compra') }}
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#buy-ativo-modal">
                                <i class="fas fa-minus-circle" style="color: tomato"></i>
                                {{ __('Registrar venda') }}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="margin-bottom: 15px;">
                            {{ ucfirst(Auth::user()->name) }}
                            <img src="{{ Auth::user()->avatar ? 'data:image/png;base64,'.Auth::user()->avatar : '/uploads/avatars/default.png' }}" alt="perfil" class="profile-small">
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ __('Trocar foto de perfil') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
