<nav class="navbar navbar-expand-md navbar-light bg-white">
    <a class="navbar-brand container-fluid mx-5 mt-2" href="{{ url('/') }}">
        <img src="{{ asset('img/header_icon.jpg') }}">
    </a>
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end container-fluid mx-5 mt-2" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav mt-2">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('company.index') }}">{{ __('Company') }}</a>
                    </li>
                @else
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('mypage') }}">{{ __('Mypage') }}</i></a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('mypage.favorite') }}">{{ __('Favorite') }}</i></a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('company.index') }}">{{ __('Company') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
