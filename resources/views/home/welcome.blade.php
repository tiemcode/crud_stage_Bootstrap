<x-guest-layout>
    <x-slot name="header">
        <h1 class="">
            {{ __('Artikelen') }}
        </h1>
    </x-slot>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center ">
            @if (Route::has('login'))
            <div class="position-fixed top-0 end-0 p-4 d-sm-block d-none">
                @auth
                <p></p>
                @else
                <a href="{{ route('login') }}" class="text-sm  text-black text-decoration-underline">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm  text-black text-decoration-underline">Register</a>
                @endif
                @endauth
            </div>
            @endif
            <!-- Your content here -->
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            @foreach ($allposts as $post)
            <div class="col-md-6 mb-4">
                <div class="card  shadow rounded">
                    <div class="card-body">
                        <h2 class="card-title">
                            {{ Str::ucfirst($post->title) }}
                        </h2>
                        <h3 class="card-subtitle font-weight-medium">
                            {{ Str::ucfirst($post->intro) }}
                        </h3>
                        <p class="card-text">
                            {{ Str::ucfirst($post->description) }}
                        </p>
                        @if ($post->file_name)
                        <img src="{{ asset($post->file_name) }}" class="img-fluid">
                        @endif
                        <p class="card-text fst-italic">Gepubliceerde op {{ date('d/m/Y', strtotime($post->date_posted)); }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    </div>
</x-guest-layout>
