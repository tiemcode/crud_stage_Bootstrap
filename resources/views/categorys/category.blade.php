<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-semibold text-xl leading-tight">
                {{ __('categorieën') }}
            </h1>
            <div class="d-flex flex-row-reverse">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Toevoegen
                </button>
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
        <table class="table table-bordered table-striped shadow">
            <tbody>
                <tr class="border-b border-gray-500">
                    <th class="p-2">
                        Naam &nbsp;
                    </th>
                    <th class="p-2">
                        <div class="d-flex justify-center">
                            <p>Voor het laast geedit</p>
                        </div>
                    </th>
                    <th class="p-2 text-center "></th>
                    <th class="p-2 text-center "></th>
                </tr>
                @foreach ($allcate as $cate)
                <tr class="border-b border-gray-700">
                    <td class=" p-2">
                        <h6>
                            {{ Str::ucfirst($cate->name) }}
                        </h6>
                    </td>
                    <td class=" p-2 ">
                        <div class="d-flex justify-center">
                            {{ date('d/m/Y', strtotime($cate->updated_at)) }}
                        </div>
                    </td>
                    <td class="p-2 text-center col-2 ">
                        <a href=" {{ route('category.edit', ['id' => $cate->id]) }}">Edit</a>
                    </td>
                    <td class=" p-2 text-center col-2">
                        <form method="POST" class="flex" action="{{ route('category.delete', ['id' => $cate->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">verwijderen</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end pt-2">
            {!! $allcate->links('pagination::bootstrap-5') !!}
        </div>
    </div>

    <!-- Add category modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Categorieën Toevoegen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.added') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" id="inputField" placeholder="Enter something">
                        </div>
                        <button type="submit" class="btn btn-primary">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add category modal -->
</x-app-layout>