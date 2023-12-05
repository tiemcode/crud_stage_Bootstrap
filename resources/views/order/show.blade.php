<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-row justify-content-between align-content-center ">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('order #' . $order->id) }}
            </h1>
            <div>
                <a class="btn btn-primary" href="{{ route('orders.edit', $order) }}">aanpassen</a>
            </div>
        </div>
    </x-slot>
    <div style="width: 85%;">
        <div class="container">
            <div class="d-flex justify-content-between ">
                <div class="col-8">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between flex-wrap">
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
                                    <th scope="col">Naam</th>
                                    <th scope="col">Prijs <sub class="fst-italic "> excl BTW</sub></th>
                                    <th scope="col">Aantal</th>
                                    <th scope="col">BTW prijs</th>
                                    <th scope="col">totaal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)

                                <?php
                                for ($i = 0; $i < count($orderProduct); $i++) {
                                    if ($orderProduct[$i]['product_id'] == $item->id) {
                                        $amount = $orderProduct[$i]['amount'];
                                    }
                                }
                                $vat = round(($item->price * $item->vat) / 100, 2);

                                $total = round($item->price * $amount + $vat * $amount, 2);

                                ?>

                                <tr>
                                    <td>
                                        <img src="{{ asset('products/' . $item->img) }} " alt="product image" style="height: 75px">
                                    </td>
                                    <td>
                                        <p>{{ $item->title }}</p>
                                    </td>
                                    <td>
                                        <p>€ {{ $item->price * $amount}}</p>
                                    </td>
                                    <td>
                                        <p>{{ $amount }}</p>

                                    </td>
                                    <td>
                                        <p>€ {{ $vat * $amount }}</p>
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
                    <div class="d-flex flex-column p-3 ">
                        <h4>Subtotaal</h4>
                        <p>€ {{ $order->total_excl }}</p>
                        <h4>BTW bedrag</h4>
                        <p>€ {{ $order->vat }}</p>
                        <h4>totaal </h4>
                        <p>€ {{ $order->total_incl }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>