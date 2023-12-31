<x-guest-layout>
    <x-slot name="header">
        <h3 class="">
            {{ __('Overzicht') }}
        </h3>
    </x-slot>
    <div class="container">
        <div class="d-flex justify-content-between ">
            <div class="col-8">
                <div class="card p-3">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="me-4">
                            <h3>Gegevens</h3>
                            <p>Naam:
                                {{ $shoping_info['shipping']['firstName'] . ' ' . $shoping_info['shipping']['lastName'] }}
                            </p>
                            <p>Email: {{ $shoping_info['shipping']['email'] }}</p>
                            <p>Adres: {{ $shoping_info['shipping']['street'] }}</p>
                            <p>Postcode: {{ $shoping_info['shipping']['postalcade'] }}</p>
                            <p>Woonplaats: {{ $shoping_info['shipping']['city'] }}</p>
                            <p>Telefoonnummer: {{ $shoping_info['shipping']['phone'] }}</p>
                        </div>
                        @if (!isset($shoping_info['openbilling']))
                        <div class="me-4">
                            <h3>Factuur gegevens</h3>
                            <p>Naam:
                                {{ $shoping_info['billing']['firstName'] . ' ' . $shoping_info['billing']['lastName'] }}
                            </p>
                            <p>Adres:
                                {{ $shoping_info['billing']['street'] }}
                            </p>
                            <p>Postcode: {{ $shoping_info['billing']['postalcade'] }}</p>
                            <p>Woonplaats: {{ $shoping_info['billing']['city'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card mt-3 ">
                    <table class=" table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Naam</th>
                                <th scope="col">Prijs <sub class="fst-italic "> excl BTW</sub></th>
                                <th scope="col">Aantal</th>
                                <th scope="col">BTW prijs</th>
                                <th scope="col">totaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('products/' . $item->img) }} " alt="product image" style="height: 75px">
                                </td>
                                <td>
                                    <p>{{ $item->title }}</p>
                                </td>
                                <td>
                                    <p>€ {{ $item->price }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->amount }}</p>
                                </td>
                                <td>
                                    <p>€ {{ round(($item->price * $item->vat) / 100, 2) }}</p>
                                </td>
                                <td>
                                    <p> €{{ round(($item->price + ($item->price * $item->vat) / 100) * $item->amount, 2) }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="height: fit-content;" class="col-3 card">
                <ul class="list-unstyled">
                    <li class="p-2">
                        <p>Aantal producten</p>
                        <p>{{ $totalAmount }}</p>
                    </li>
                    <li class="p-2">
                        <p>Subtotaal</p>
                        <p>€ {{ round($subtotal, 2) }}</p>
                    </li>
                    <li class="p-2">
                        <p>BTW</p>
                        <p>€{{ round($vatTotal, 2) }}</p>
                    </li>
                    <li class="p-2">
                        <p>totaale prijs</p>
                        <p>€ {{ round($totalPrice, 2) }}</p>
                    </li>
                    <li>
                        <form action="{{ route('cart.storeOrder') }}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="shoping_info" value="{{ json_encode($shoping_info) }}"> --}}
                            <a class="btn btn-link" href="{{ route('cart.checkout') }}">ga
                                terug</a>
                            <button type="submit" class="btn btn-primary">Bestellen</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>
