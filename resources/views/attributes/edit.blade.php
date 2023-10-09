<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attributen aanpassen') }}
        </h1>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('attributes.edited' ,['id' =>$id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control rounded-0 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600" value="{{$attribute->title}}" />
                            </div>

                            @error('title')
                            <div>
                                @foreach ($errors->get('title') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary btn-sm font-weight-bold px-3 py-2 text-sm shadow-sm hover-bg-indigo-500 focus-visible-outline focus-visible-outline-2 focus-visible-outline-offset-2 focus-visible-outline-indigo-500" value="Voeg Toe">
                                <a href="{{route('attributes.index')}}" class="btn btn-link btn-sm font-weight-medium text-indigo-400 text-decoration-underline focus-visible-outline focus-visible-outline-2 focus-visible-outline-offset-2 focus-visible-outline-indigo-500">Ga Terug</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
