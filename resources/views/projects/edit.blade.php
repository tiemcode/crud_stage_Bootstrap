<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl leading-tight">
            {{ __('project aanpasen') }}
        </h1>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page">aanpassen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.user', ['id' => $data->id]) }}">gebruiker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.task', ['id' => $data->id]) }}"
                            aria-current="page">taken</a>
                    </li>
                </ul>
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('project.added') }}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label for="title">tites</label>
                                <input type="text" value="{{ $data->name }}" name="name" id="title"
                                    class="form-control " />
                                @error('name')
                                    <div>
                                        @foreach ($errors->get('name') as $message)
                                            <p class="text-danger">{{ $message }}
                                            </p>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="intro">intro</label>
                                <textarea name="intro" id="intro"
                                    class="form-control intro rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6">{{ $data->intro }}</textarea>
                                @error('description')
                                    <div>
                                        @foreach ($errors->get('intro') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="description">description</label>
                                <textarea rows="8" cols="48" name="description" id="description"
                                    class="form-control rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6">{!! $data->description !!}</textarea>
                                @error('description')
                                    <div>
                                        @foreach ($errors->get('description') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <a href="{{ route('projects.index') }}" class="btn btn-link">Ga Terug</a>
                                <input type= "submit" class="btn btn-primary" value="toevoegen">
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
                for (const name of ['description', ]) {
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
