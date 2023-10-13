<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('product attribuut aanpassen') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('products.attribute.edited', ['productId' => $id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="attribuut" class="form-label">attribuut</label>
                                <select name="attribuut" id="attribuut" class="form-control">
                                    <option selected value="{{ $attribute->attribute_id }}">
                                        {{ $attribute->attribute->title }}
                                    </option>
                                    @foreach ($allattri as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="value" class="form-label">waarde</label>
                                <input value="{{$attribute->value}}" type="text" class="form-control" id="value" name="value">
                            </div>
                            <div class="mb-3 d-flex flex-row-reverse ">
                                <input type="submit" class="btn btn-primary" value="Voeg Toe">
                                <a href="{{ route('products.attribute', ['productId' => $id]) }}" class="btn btn-link">Ga
                                    Terug</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
