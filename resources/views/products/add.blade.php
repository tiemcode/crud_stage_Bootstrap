<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('product aanmaken') }}
        </h1>
    </x-slot>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea rows="8" cols="48" name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">voorraad</label>
                                <input type="number" name="stock" id="stock" class="form-control" />
                            </div>
                            <div class="mb-3 ">
                                <label for="title" class="form-label">prijs</label>
                                <input type="number" name="price" id="price" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="btw" class="from-label">btw</label>
                                <input type="number" name="vat" id="vat" class="form-control" />
                            </div>

                            <!-- //imgae upload -->
                            <div class="mb-3">
                                <label for="image" class="form-label">foto</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class=" form-control" />
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
