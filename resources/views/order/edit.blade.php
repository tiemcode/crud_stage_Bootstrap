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
                    <a class="nav-link active" aria-current="page">info</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.editAdress', $order) }}" class="nav-link">adres</a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.editProduct', $order) }}" class="nav-link">producten</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                    <h3>algemene informatie</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.edited', $order) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <x-input-field type="text" name="fullName" label="naam" :value="$order->fullName"></x-input-field>
                        </div>
                        <div class="mb-3">
                            <x-input-field type='text' name="email" label="email" :value="$order->email"></x-input-field>
                        </div>
                        <div class="mb-3">
                            <x-input-field type="number" name="phoneNumber" label="telefoonnummer" :value="$order->phoneNumber"></x-input-field>
                        </div>
                        <div class="mb-3 d-flex flex-row-reverse ">
                            <button type="submit" class="btn btn-primary">opslaan</button>
                            <a class="btn btn-link " href="{{ route('orders.show', $order) }}">teruggaan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
