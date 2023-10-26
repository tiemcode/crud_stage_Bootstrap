<x-guest-layout>
    <x-slot name="header">
        <h3 class="">
            {{ __('overzicht') }}
        </h3>
    </x-slot>


    <div class="container">
        <div class="d-flex justify-content-between ">
            <div class="col-8">
                <div class="card p-3">
                    <div class="d-flex justify-content-between flex-wrap">
                        {{-- @dd($addres[0]) --}}
                        <div class="col-6">
                            <h5>Verzendadres</h5>
                            <p>{{ $addres[0]->firstName }} {{ $addres[0]->lastName }}</p>
                            <p>{{ $addres[0]->email }}</p>
                            <p>{{ $order->phoneNumber }}</p>
                            <p>{{ $addres[0]->address }}</p>
                            <p>{{ $addres[0]->city }}</p>
                            <p>{{ $addres[0]->zipCode }}</p>
                        </div>
                        @isset($addres[1])
                            <div class="col-6">
                                <h5>Factuuradres</h5>
                                <p>{{ $addres[1]->firstName }} {{ $addres[1]->lastName }}</p>
                                <p>{{ $addres[1]->address }}</p>
                                <p>{{ $addres[1]->city }}</p>
                                <p>{{ $addres[1]->zipCode }}</p>
                            </div>
                        @endisset
                    </div>
                </div>

                <div class="card mt-3 ">
                    <table class=" table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">naam</th>
                                <th scope="col">Prijs <sub class="fst-italic "> excl btw</sub></th>
                                <th scope="col">Aantal</th>
                                <th scope="col">btw prijs</th>
                                <th scope="col">Totaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <?php
                                for ($i = 0; $i < count($orderProduct); $i++) {
                                    if ($orderProduct[$i]['product_id'] == $item->id) {
                                        $quantity = $orderProduct[$i]['quantity'];
                                    }
                                }
                                $vat = round(($item->price * $item->vat) / 100, 2);

                                $total = round($item->price * $quantity + $vat * $quantity, 2);

                                ?>

                                <tr>
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
                                        <p>{{ $quantity }}</p>

                                    </td>
                                    <td>
                                        <p>€ {{ $vat }}</p>
                                    </td>
                                    <td>
                                        <p>€ {{ $total }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-3 card">
                <div class="d-flex flex-column ">
                    <h4>Subtotaal</h4>
                    <p>€ {{ $order->total_excl }}</p>
                    <h4>btw bedrag</h4>
                    <p>€ {{ $order->vat }}</p>
                    <h4>totale</h4>
                    <p>€ {{ $order->total_incl }}</p>
                    <a href="{{ route('pdf.download', $order->id) }}" class="btn btn-primary mt-3">Download PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
