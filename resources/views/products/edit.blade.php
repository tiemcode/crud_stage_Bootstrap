<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit product') }}
        </h1>
    </x-slot>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page">aanpassen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.attribute', ['productId' => $product->id]) }}">attributen</a>
                    </li>
                </ul>
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('products.edited', ['id' => $product->id]) }}" method="post">
                            @csrf <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" />
                                @error('title')
                                <div>
                                    @foreach ($errors->get('title') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea rows="8" cols="48" name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                @error('description')
                                <div>
                                    @foreach ($errors->get('description') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">voorraad</label>
                                <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" />
                                @error('stock')
                                <div>
                                    @foreach ($errors->get('stock') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label for="title" class="form-label">prijs</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $product->price }}" />
                                @error('price')
                                <div>
                                    @foreach ($errors->get('price') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="btw" class="from-label">btw</label>
                                <input type="number" name="vat" id="vat" class="form-control" value="{{ $product->vat }}" />
                                @error('vat')
                                <div>
                                    @foreach ($errors->get('vat') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>

                            <!-- //imgae upload -->
                            <div class="mb-3">
                                <label for="image" class="form-label">foto</label>
                                <input type="file" name="image" id="image" accept="image/*" class=" form-control" value="{{ $product->img }}" />
                                @error('image')
                                <div>
                                    @foreach ($errors->get('image') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex flex-row-reverse ">
                                <input type="submit" class="btn btn-primary" value="Voeg Toe">
                                <a href="{{ route('products.index') }}" class="btn btn-link">Ga Terug</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        window.addEventListener('load', () => {
            for (const name of ['description']) {
                ClassicEditor
                    .create(document.getElementById(name))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
    @endsection
</x-app-layout>
