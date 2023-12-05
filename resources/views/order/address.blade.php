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
                    <a class="nav-link" href="{{ route('orders.edit', $order) }}" aria-current="page">info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active ">adres</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.editProduct', $order) }}" class="nav-link ">producten</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                    <h3>afleveradres</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.updateAdress_0', $order) }}" method="POST">
                        @csrf
                        <x-input-field type="text" label="voornaam" name="first_name_0" :value="$address[0]->firstName"></x-input-field>
                        <x-input-field type="text" label="achternaam" name="last_name_0" :value="$address[0]->lastName"></x-input-field>
                        <x-input-field type="text" label="straat" name="street_0" :value="$address[0]->address"></x-input-field>
                        <x-input-field type="text" label="postcode" name="postal_code_0" :value="$address[0]->zipCode"></x-input-field>
                        <x-input-field type="text" label="stad" name="city_0" :value="$address[0]->city"></x-input-field>
                        <div class="d-flex flex-row-reverse ">
                            <button type="submit" class="btn btn-primary mt-2">opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($address[1])
            <div class="card mt-2 ">
                <div class="card-header">
                    <h3>vactuuradres</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.updateAdress_1', $order) }}" method="POST">
                        @csrf
                        <x-input-field type="text" label="voornaam" name="first_name_1" :value="$address[1]->firstName"></x-input-field>
                        <x-input-field type="text" label="achternaam" name="last_name_1" :value="$address[1]->lastName"></x-input-field>
                        <x-input-field type="text" label="straat" name="street_1" :value="$address[1]->address"></x-input-field>
                        <x-input-field type="text" label="postcode" name="postal_code_1" :value="$address[1]->zipCode"></x-input-field>
                        <x-input-field type="text" label="stad" name="city_1" :value="$address[1]->city"></x-input-field>
                        <div class="d-flex flex-row-reverse ">
                            <button type="submit" class="btn btn-primary mt-2">opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
            @endisset
        </div>
</x-app-layout>
