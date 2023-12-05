<x-guest-layout>

    <div class="container">
        <div class="col mb-2">
            <form action="{{ route('product.cart', ['id' => $product->id]) }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Hoeveelheid</label>
                    <select class="form-select" id="inputGroupSelect01" name="amount">
                        @for ($i = 1; $i <= $product->stock; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary">Toevoegen aan winkelmand</button>`
                </div>
            </form>
        </div>
        <div class="card shadow ">
            <img src=" {{ asset('products/' . $product->img) }}" class="card-img-top" style="height: 400px"
                alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ ucfirst($product->title) }}</h5>
                <p class="card-text">{!! ucfirst($product->description) !!}</p>
                <div class="row mb-2">
                    <div class="col">
                        <p class="card-text">€{{ $product->price }} <sub class="fst-italic">excl BTW</sub></p>
                    </div>
                    <div class="col">
                        <p class="card-text">BTW: {{ $product->vat }}%</p>
                    </div>
                </div>
                <p class="card-text">Voorraad: {{ $product->stock }}</p>

                @forelse ($product->attribute_product as $attr)
                    <p class="fst-italic  ">
                        {{ $attr->attribute->title }} {{ $attr->value }}
                    </p>
                @empty
                    <p>Geen attribut </p>
                @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>
