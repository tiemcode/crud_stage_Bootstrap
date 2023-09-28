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
                        {{ __('artikelen') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link class="text-light" :href="route('project.home')" :active="request()->routeIs('project.home')">
                        {{ __('projecten') }}
                    </x-nav-link>
                </li>
            </ul>
        </div>

        <div class="ml-auto">
            @auth
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link text-white" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
            @endauth
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
