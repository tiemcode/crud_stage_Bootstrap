<x-guest-layout>
    <x-slot name="header">
        <h1 class="">
            {{ __('producten') }}
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
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            @foreach ($allproduct as $item)
            <div class="col-md-4 mb-4">
                <div class="card" style="width:18em"">
                        <img src=" {{ asset('products/' . $item->img) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{!! $item->description !!}</p>
                        <p class="card-text">€{{ $item->price }} <sub class="fst-italic ">excl btw</sub></p>
                        <p class="card-text">voorraad: {{ $item->stock }}</p>
                        <p class="card-text">btw: {{ $item->vat }}%</p>
                        @forelse ($item->attribute_product as $attr)
                        <p class="fst-italic  ">
                            {{ $attr->attribute->title }} {{ $attr->value }}
                        </p>
                        @empty
                        <p>Geen attributen</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
