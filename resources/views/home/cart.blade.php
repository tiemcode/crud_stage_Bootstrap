<x-guest-layout>
    <x-slot name="header">
        <h3 class="">
            {{ __('winkelwagen') }}
        </h3>
    </x-slot>
    <div class="container ">
        @if (session()->has('danger'))
            <div class="pt-4">
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" style="width:50px ;" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-danger">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>

                        <div class="ms-3">
                            <p class="text-danger ">{{ session()->get('danger') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class=" d-flex justify-content-between ">
            <div class="card col-8">
                <table class=" table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">naam</th>
                            <th scope="col">Prijs <sub class="fst-italic "> excl btw</sub></th>
                            <th scope="col">btw prijs</th>
                            <th scope="col">Aantal</th>
                            <th scope="col">Totaal</th>
                            <th scope="col">Verwijder</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('products/' . $item->img) }} " alt="product image"
                                        style="height: 75px">
                                </td>
                                <td>
                                    <p>{{ $item->title }}

                                    </p>
                                </td>

                                <td>
                                    <p>€ {{ $item->price }}</p>
                                </td>
                                <td>
                                    <p>€ {{ round(($item->price * $item->vat) / 100, 2) }}</p>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('cart.update') }}"
                                        class="row align-items-center">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <div class="col-auto">
                                            <button type="submit" name="btn" value="min"
                                                class="btn btn-sm  btn-outline-primary">-</button>
                                        </div>
                                        <div class="col-auto">
                                            <p>{{ $item->amount }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" name="btn" value="plus"
                                                class="btn  btn-sm btn-outline-primary">+</button>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <p> €
                                        {{ round(($item->price + ($item->price * $item->vat) / 100) * $item->amount, 2) }}
                                    </p>

                                </td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger">verwijder</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <p>geen producten in winkelwagen</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-3 card">
                <ul class="list-unstyled">
                    <li class="p-2">
                        <p>
                            Aantal producten
                        </p>
                        <p>
                            {{ $totalAmount }}
                        </p>
                    </li>
                    <li class="p-2">
                        <p>
                            Subtotaal
                        </p>
                        <p>
                            € {{ round($subtotal, 2) }}
                        </p>
                    </li>
                    <li class="p-2">
                        <p>
                            btw
                        </p>
                        <p>
                            €{{ round($vatTotal, 2) }}
                        </p>
                    </li>
                    <li class="p-2">
                        <p>
                            Totaal
                        </p>
                        <p>
                            € {{ round($totalPrice, 2) }}

                        </p>
                    </li>
                    <li class="p-2">
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Afrekenen</a>
                        <a href="{{ route('product.home') }}" class="btn btn-outline-primary ">verder winkelen</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>
