<x-guest-layout>
    <x-slot name="header">
        <h3 class="">
            {{ __('Persoonsgegevens') }}
        </h3>
    </x-slot>
    <div class="container">
        <div class="d-flex justify-content-between ">
            <div class="card  col-8 p-3 ">
                <form enctype="multipart/form-data" action="{{ route('cart.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <h4>Bezorg adres</h4>
                        <x-input-array type="text" label="Voornaam" name="shipping.firstName" :value="session('shoping_info') ? session('shoping_info')['shipping']['firstName'] : ''"></x-input-array>
                        <x-input-array type="text" label="Achternaam" name="shipping.lastName" :value="session('shoping_info') ? session('shoping_info')['shipping']['lastName'] : ''"></x-input-array>
                        <x-input-array type="text" label="Straat" name="shipping.street" :value="session('shoping_info') ? session('shoping_info')['shipping']['street'] : ''"></x-input-array>
                        <x-input-array type="text" label="Postcode" name="shipping.postalcade" :value="session('shoping_info') ? session('shoping_info')['shipping']['postalcade'] : ''"></x-input-array>
                        <x-input-array type="text" label="Plaats" name="shipping.city" :value="session('shoping_info') ? session('shoping_info')['shipping']['city'] : ''"></x-input-array>
                        <x-input-array type="text" label="Telefoon" name="shipping.phone" :value="session('shoping_info') ? session('shoping_info')['shipping']['phone'] : ''"></x-input-array>
                        <x-input-array type="text" label="Email" name="shipping.email" :value="session('shoping_info') ? session('shoping_info')['shipping']['email'] : ''"></x-input-array>
                    </div>
                    <div class="mb-3 d-flex justify-content-between  ">
                        <div>
                            <label for="openWall">factuur adres hetzelfde</label>
                            <input type="checkbox" name="openbilling" id="openWall" checked onclick="openwall()">
                        </div>
                        <div>
                            <a href="{{ route('product.home') }}" class="btn btn-link">Teruggaan</a>
                            <input type="submit" class="btn btn-primary" value="Voeg Toe">
                        </div>
                    </div>
                    <div id="collapseWall">
                        <div class="mb-4">
                            <h4>Vactuur adres</h4>
                            <x-input-array type="text" label="Voornaam" name="billing.firstName" :value="session('shoping_info')
                                    ? session('shoping_info')['billing']['firstName']
                                    : ''"></x-input-array>
                            <x-input-array type="text" label="Achternaam" name="billing.lastName" :value="session('shoping_info')
                                    ? session('shoping_info')['billing']['lastName']
                                    : ''"></x-input-array>
                            <x-input-array type="text" label="Straat" name="billing.street" :value="session('shoping_info') ? session('shoping_info')['billing']['street'] : ''"></x-input-array>
                            <x-input-array type="text" label="Postcode" name="billing.postalcade" :value="session('shoping_info')
                                    ? session('shoping_info')['billing']['postalcade']
                                    : ''"></x-input-array>
                            <x-input-array type="text" label="Plaats" name="billing.city" :value="session('shoping_info') ? session('shoping_info')['billing']['city'] : ''"></x-input-array>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                $(document).ready(function() {
                    openwall();
                });

                function openwall() {
                    var checkbox = document.getElementById("openWall");
                    var state = checkbox.checked;
                    if (!state) {
                        $("#collapseWall").show(400);
                    } else {
                        $("#collapseWall").hide(400);
                    }
                }
            </script>
            <div style="height:  fit-content" class="col-3 card p-2">
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
                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>
