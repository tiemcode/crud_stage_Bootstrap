<x-guest-layout>
    <x-slot name="header">
        <h3 class="">
            {{ __('persoonsgegevens') }}
        </h3>
    </x-slot>
    {{-- @dd(session()) --}}
    <div class="container">
        <div class="d-flex justify-content-between ">
            <div class="card  col-8 p-3 ">
                <form enctype="multipart/form-data" action="{{ route('cart.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <div class="d-flex">
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">Voornaam</label>
                                <input type="text" name="first_name" id="voornaam" class="form-control
                                " />

                            </div>
                            @error('first_name')
                            <div>
                                @foreach ($errors->get('first_name') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                            <div class=" w-50 mb-3">
                                <label for="achternaam" class="form-label">Achternaam</label>
                                <input type="text" name="last_name" id="achternaam" class="form-control" @if (session()->has('last_name')) value="{!! $shoping_info['last_name'] !!}" @endif />
                            </div>
                            @error('last_name')
                            <div>
                                @foreach ($errors->get('last_name') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 ">
                            <label for="title" class="form-label">email</label>
                            <input type="text" name="email" id="price" @if (session()->has('email')) value="{!! $shoping_info['email'] !!}" @endif
                            class="form-control" />
                        </div>
                        @error('email')
                        <div>
                            @foreach ($errors->get('email') as $message)
                            <p class="text-danger">{{ $message }}</p>
                            @endforeach
                        </div>
                        @enderror
                        <div class="mb-3">
                            <label for="title" class="form-label">moblie nummer</label>
                            <input type="number" name="phone_number" id="stock" @if (session()->has('phone_number')) value="{!! $shoping_info['phone_number'] !!}" @endif
                            class="form-control" />
                        </div>
                        @error('phone_number')
                        <div>
                            @foreach ($errors->get('phone_number') as $message)
                            <p class="text-danger">{{ $message }}</p>
                            @endforeach
                        </div>
                        @enderror
                        <div class="d-flex">
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">straat</label>
                                <input type="text" name="street" id="voornaam" @if (session()->has('street')) value="{!! $shoping_info['street'] !!}" @endif
                                class="form-control " />
                            </div>
                            @error('street')
                            <div>
                                @foreach ($errors->get('street') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">postcode</label>
                                <input type="text" name="postalcade" @if (session()->has('postalcade')) value="{!! $shoping_info['postalcade'] !!}" @endif
                                class="form-control " />
                            </div>
                            @error('postalcade')
                            <div>
                                @foreach ($errors->get('postalcade') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex">

                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">plaats</label>
                                <input type="text" name="city" @if (session()->has('city')) value="{!! $shoping_info['city'] !!}" @endif
                                class="form-control " />
                            </div>
                            @error('city')
                            <div>
                                @foreach ($errors->get('city') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                        </div>
                        <div>
                            <input type="checkbox" name="openbilling" id="openWall" checked onclick="openwall()">
                            <label for="openWall">factuur address hetzelfde</label>
                        </div>
                    </div>
                    <div id="collapseWall">
                        <div class="d-flex">
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">Voornaam</label>
                                <input type="text" name="first_name_billing" @if (session()->has('first_name_billing')) value="{!! $shoping_info['first_name_billing'] !!}" @endif
                                class="form-control " />
                            </div>
                            @error('first_name_billing')
                            <div>
                                @foreach ($errors->get('first_name_billing') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                            <div class=" w-50 mb-3">
                                <label for="achternaam" class="form-label">Achternaam</label>
                                <input type="text" name="last_name_billing" class="form-control" @if (session()->has('last_name_billing')) value="{!! $shoping_info['last_name_billing'] !!}" @endif />
                            </div>
                            @error('last_name_billing')
                            <div>
                                @foreach ($errors->get('last_name_billing') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex">
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">straat</label>
                                <input type="text" name="street_billing" id="voornaam" class="form-control  " @if (session()->has('street_billing')) value="{!! $shoping_info['street_billing'] !!}" @endif />
                            </div>
                            @error('street_billing')
                            <div>
                                @foreach ($errors->get('street_billing') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex">
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">postcode</label>
                                <input type="text" name="postalcade_billing" id="voornaam" class="form-control  " @if (session()->has('postalcade_billing')) value="{!! $shoping_info['postalcade_billing'] !!}" @endif />
                            </div>
                            @error('postalcade_billing')
                            <div>
                                @foreach ($errors->get('postalcade_billing') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                            <div class="w-50 mb-3 me-3">
                                <label for="voornaam" class="form-label">plaats</label>
                                <input type="text" name="city_billing" id="voornaam" class="form-control" value="{{old('city_billing')}}" />

                            </div>
                            @error('city_billing')
                            <div>
                                @foreach ($errors->get('city_billing') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-row-reverse ">
                        <input type="submit" class="btn btn-primary" value="Voeg Toe">
                        <a href="{{ route('product.home') }}" class="btn btn-link">Ga Terug</a>
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
                    if (!state)
                        $("#collapseWall").show(400);
                    else
                        $("#collapseWall").hide(400);
                }
            </script>
            <div class="col-3 card">
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
                        <p>btw</p>
                        <p>€{{ round($vatTotal, 2) }}</p>
                    </li>
                    <li class="p-2">
                        <p>Totaale prijs</p>
                        <p>€ {{ round($totalPrice, 2) }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>
