<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h3 class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h3>

            <div class="d-flex flex-row-reverse">
                <a href="{{ route('addpost') }}">
                    <button type="button" class="btn btn-primary  font-weight-semibold">
                        Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>
    <div style="width: 85%;">
        <div class="my-2">
            <form action="{{ route('search.post') }}" class="d-flex flex-row flex-between">
                <input type="text" name="search" id="search" class="form-control rounded py-2.5 me-1 text-gray-900 shadow-sm" placeholder="Zoeken">
                <input type="submit" value="Zoeken" class="btn btn-primary btn-sm font-weight-semibold ml-4">
            </form>
        </div>
        <table class="table shadow table-bordered table-striped ">
            <thead>
                <tr>
                    <th scope="col" class="p-2">Titel</th>
                    <th scope="col" class="p-2">Categorie</th>
                    <th scope="col" class="p-2">Gepubliceerde Datum</th>
                    <th scope="col" class="p-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td class="p-2">
                        <h6>{{ Str::ucfirst($post->title) }}</h6>
                    </td>
                    <td>{{ Str::ucfirst( $post->category->name) }}</td>
                    <td>{{ date('d/m/Y', strtotime($post->date_posted)) }}</td>
                    <td>
                        <div class="d-flex justify-content-evenly  ">
                            <a href='{{ route('index.edit', ['id' => $post->id]) }}'>Edit</a>
                            <form method="POST" action="{{ route('deletePost', ['id' => $post->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <div>
            {{ $posts->links("pagination::bootstrap-5") }}
        </div>
        <style>
            svg {
                width: 36px;
            }
        </style>
    </div>
</x-app-layout>