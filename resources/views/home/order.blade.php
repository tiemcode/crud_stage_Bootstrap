<x-guest-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mijn orders') }}
        </h1>
    </x-slot>


    <div class="container">
        <div class="row mt-4 ">
            {{-- @dd($orders) --}}
            @forelse($orders as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Order #{{ $item->id }}
                            </h5>
                            <p class="card-text">
                                <strong>Order geplaatst op:</strong> {{ $item->created_at }}
                            </p>
                            <p class="card-text">
                                <strong>Order totaal:</strong> €{{ $item->total_incl }}
                            </p>
                            <a href="{{ route('order.details', ['order' => $item]) }}" class="btn btn-primary">Bekijk
                                order</a>
                        </div>
                    </div>
                </div>
            @empty
                geen orders geplaats
            @endforelse
        </div>
    </div>
</x-guest-layout>
