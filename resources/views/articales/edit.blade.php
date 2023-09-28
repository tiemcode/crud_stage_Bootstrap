<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit post') }}
        </h1>
    </x-slot>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('edit.post', ['id' => $data->id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $data->title }}" />
                            </div>
                            <div class="mb-3">
                                <label for="intro" class="form-label">Intro</label>
                                <textarea rows="2" name="intro" id="intro" class="form-control">{{ $data->intro }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="date_publised" class="form-label">Gepubliceerde Datum</label>
                                <input name="date_publised" id="date_publised" class="form-control" type="date" value="{{ $data->date_posted }}" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea rows="8" cols="48" name="description" id="description" class="form-control">{{ $data->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cate" class="form-label">Categorieën</label>
                                <select name="cate" class="form-control">
                                    @foreach ($catedata as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
</x-app-layout>
