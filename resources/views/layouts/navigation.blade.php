<nav class="navbar navbar-expand-lg navbar-light bg-primary ">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <x-application-logo class="d-block h-9 w-auto fill-current  " />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item text-light">
                    <x-nav-link class="text-light" :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Artikelen') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link class="text-light" :href="route('product.home')" :active="request()->routeIs('product.home')">
                        {{ __('Producten') }}
                    </x-nav-link>
                </li>
            </ul>
        </div>

        <div class="ml-auto">
            <div class="d-flex">
                @auth
                <div class="dropdown">
                    <button class="btn btn-primary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('project.home') }}">Mijn projecten</a></li>
                        <li><a class="dropdown-item" href="{{ route('order.home') }}">Mijn orders</a></li>
                        <li>
                            <!-- Authentication -->
                            <form method="POST" class="dropdown-it" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn text-danger  " :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Uitloggen') }}
                                </button>
                            </form>

                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-sm text-white text-decoration-none">Log in</a>
                <a href="{{ route('register') }}" class="ml-4 text-sm text-white text-decoration-none ">Register</a>
                @endauth
                <a class="align-content-center " href="{{ route('cart') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" style="color:white;" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                </a>
            </div>


        </div>
    </div>
</nav>

<!-- Responsive Navigation Menu -->
<div :class="{ 'block': open, 'hidden': !open }" class="collapse navbar-collapse">
    <ul class="navbar-nav">
        <li class="nav-item">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </li>
        <!-- Responsive Settings Options -->
    </ul>
</div>