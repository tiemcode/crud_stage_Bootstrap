<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-row justify-content-between align-content-center ">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('order #' . $order->id) }}
            </h1>
        </div>
    </x-slot>
    <div style="width: 85%;">
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.edit', $order) }}" aria-current="page">Info</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.editAdress', $order) }}" class="nav-link">Adres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">Producten</a>
                </li>
            </ul>
            <div class="card mb-2">
                <div class="card-header">
                    <h3>Product toevoegen</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.addproduct', $order) }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="state">product</label>
                            <select id="state" class="js-example-basic-single form-control " name="product">
                                @foreach ($allproduct as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-field label="hoeveelheid" name="amount" :value=1 type="number"></x-input-field>
                        <div class="d-flex flex-row-reverse ">
                            <button type="submit" class="btn btn-primary mt-2">Toevoegen</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Product info</h3>
                </div>
                <div class="card-body">
                    <table class=" table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Naam</th>
                                <th scope="col">Prijs <sub class="fst-italic "> excl BTW</sub></th>
                                <th scope="col">BTW prijs</th>
                                <th scope="col">Aantal</th>
                                <th scope="col">totaal</th>
                                <th scope="col">Verwijder</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderProduct as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('products/' . $item->product->img) }} " alt="product image"
                                            style="height: 75px">
                                    </td>
                                    <td>
                                        <p>{{ $item->product->title }}

                                        </p>
                                    </td>

                                    <td>
                                        <p>€ {{ $item->price_excl * $item->amount }}</p>
                                    </td>
                                    <td>
                                        <p>€ {{ $item->vat * $item->amount }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->amount }}</p>
                                    </td>
                                    <td>
                                        <p> € {{ $item->price_incl * $item->amount }}</p>
                                    </td>
                                    <td>
                                        <form action="{{ route('orders.deleteproduct', $order) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger">verwijder</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</x-app-layout>
