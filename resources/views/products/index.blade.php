<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Producten') }}
            </h2>

            <div class="d-flex flex-row-reverse">
                <a href="{{ route('products.add') }}">
                    <button type="button" class="btn btn-primary  font-weight-semibold">
                        Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>
    <div style="width: 85%;">
        <div class="my-2">
            <form action="{{ route('products.search') }}" class="d-flex flex-row flex-between">
                <input type="text" name="search" id="search" class="form-control rounded py-2.5 me-1 text-gray-900 shadow-sm" placeholder="Zoeken">
                <input type="submit" value="Ga Zoeken" class="btn btn-primary btn-sm font-weight-semibold ml-4">
            </form>
        </div>
        <table class="table shadow table-bordered table-striped ">
            <thead>
                <tr>
                    <th scope="col" class="p-2">Titel</th>
                    <th scope="col" class="p-2">Gepubliceerde Datum</th>
                    <th scope="col" class="p-2 "></th>
                    <th scope="col" class="p-2 "></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $post)
                <tr>
                    <td class="p-2">
                        <h6>{{ Str::ucfirst($post->title) }}</h6>
                    </td>
                    <td>{{ date('d/m/Y', strtotime($post->date_posted)) }}</td>
                    <td class="text-center ">
                        <a href='{{ route('products.edit', ['id' => $post->id]) }}'>Edit</a>
                    </td>
                    <td class="text-center">
                        <form method="POST" onsubmit=" alert('weet je zeker om deze te verwijderen')" action="{{ route('products.delete', ['id' => $post->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</x-app-layout>