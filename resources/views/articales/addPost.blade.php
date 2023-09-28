<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Artikel toevoegen') }}
        </h1>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('addedpost') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" />
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="intro" class="form-label">Intro</label>
                                <textarea name="intro" id="intro" class="form-control intro @error('intro') is-invalid @enderror"></textarea>
                                @error('intro')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_posted" class="form-label">Gepubliceerde Datum</label>
                                <input name="date_publised" require id="date_publised" class="form-control @error('date_posted') is-invalid @enderror" type="date" />
                                @error('date_posted')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea rows="8" cols="48" name="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cate" class="form-label">Categorieën</label>
                                <select name="cate" class="form-control @error('cate') is-invalid @enderror">
                                    @foreach ($catedata as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('cate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="file_input">Upload bestand</label>
                                <input name="file" class="form-control-file @error('file') is-invalid @enderror" id="file_input" type="file">
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 d-flex flex-row-reverse ">
                                <input type="submit" class="btn btn-primary" value="Voeg Toe">
                                <a href="{{route('dashboard')}}" class="btn btn-link">Ga Terug</a>
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
