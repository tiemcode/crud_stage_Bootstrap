<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('categorieën aanpassen') }}
        </h1>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('category.edited' ,['id' =>$id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{$data->title}}" />
                            </div>

                            @error('title')
                            <div>
                                @foreach ($errors->get('title') as $message)
                                <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            </div>
                            @enderror
                            <div class="d-flex justify-content-end ">
                                <a href="{{route('category.index')}}" class="btn btn-link btn-sm font-weight-medium ">Ga Terug</a>
                                <input type="submit" class="btn btn-primary btn-sm font-weight-bold" value="Voeg Toe">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
