<x-guest-layout>
    <x-slot name="header">
        <h3 class="">
            {{ __('Overzicht') }}
        </h3>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="alert alert-success col-12">
                <h1 class="text-center">Bedankt voor uw bestelling!</h1>
                <p class="text-center">Uw bestelling is succesvol geplaatst. U ontvangt een bevestiging per mail.</p>
                <p class="text-center">Hier onder kunt u ook een pdf van de bestelling downloaden</p>
            </div>
        </div>
        <div class="d-flex justify-content-between ">
            <div class="col-8">
                <div class="card p-3">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="me-4">
                            <h3>Gegevens</h3>
                            <p>Naam: {{ $order->fullName }}</p>
                            <p>Email: {{ $order->email }}</p>
                            <p>Adres: {{ $orderAddres[0]['address'] }}</p>
                            <p>Postcode: {{ $orderAddres[0]['zipCode'] }}</p>
                            <p>Woonplaats: {{ $orderAddres[0]['city'] }}</p>
                            <p>Telefoonnummer: {{ $order['phoneNumber'] }}</p>
                        </div>
                        @isset($orderaddres[1])
                            <div class="me-4">
                                <h3>Factuur gegevens</h3>
                                <p>Naam:
                                    {{ $orderAddres[0]['firstName'] . ' ' . $orderAddres[0]['lastName'] }}
                                </p>
                                <p>Adres:
                                    {{ $orderAddres[0]['address'] }}
                                </p>
                                <p>Postcode: {{ $orderAddres[0]['zipCode'] }}</p>
                                <p>Woonplaats: {{ $orderAddres[0]['city'] }}</p>
                            </div>
                        @endisset

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
                                <td>
                                    <img src="{{ asset('products/' . $item->img) }} " alt="product image"
                                        style="height: 75px">
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
                        <p>Subtotaal</p>
                        <p>€ {{ round($order->total_excl, 2) }}</p>
                    </li>
                    <li class="p-2">
                        <p>BTW</p>
                        <p>€{{ round($order->vat, 2) }}</p>
                    </li>
                    <li class="p-2">
                        <p>totaale prijs</p>
                        <p>€ {{ round($order->total_incl, 2) }}</p>
                    </li>
                </ul>
                <div class="d-flex flex-column p-3 ">
                    <a href="{{ route('product.home') }}" class="btn btn-primary">Terug naar home</a>
                    <a href="{{ route('cart.download', $order) }}" class="btn btn-link">Download PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
