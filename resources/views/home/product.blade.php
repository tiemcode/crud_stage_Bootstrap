<x-guest-layout>
    <x-slot name="header">
        <h1 class="">
            {{ __('producten') }}
        </h1>
    </x-slot>

    <div class="container">
        <div class="row mt-4">
            @if (session()->has('success'))
            <div class="pt-4">
                <div class="alert alert-success">
                    <div class="d-flex align-items-center">
                        <svg class="text-success" viewBox="0 0 20 20" style="width: 50px;" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        <div class="ms-3">
                            <p class="text-success">{{ session()->get('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @foreach ($allproduct as $item)
            <div class="col-md-4 mb-4">
                <div class="card" style="width:18em"">
                        <img src=" {{ asset('products/' . $item->img) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{!! $item->description !!}</p>
                        <p class="card-text">€{{ $item->price }} <sub class="fst-italic ">excl btw</sub></p>
                        <a href="{{ route('product.details', ['id' => $item->id]) }}" class="btn btn-primary">bekijk
                            product</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
