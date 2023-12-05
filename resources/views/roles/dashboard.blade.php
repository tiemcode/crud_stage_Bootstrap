<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-weight-semibold text-xl text-gray-800 dark-text-gray-200">
                {{ __('Rolen') }}
            </h1>
            <div class="d-flex flex-row-reverse">
                <button type="button" class="btn btn-primary  font-weight-semibold" data-bs-toggle="modal" data-bs-target="#addModal">
                    Toevoegen
                </button>
            </div>
        </div>
    </x-slot>
    <div style="width: 85%;">
        <div class="my-2 ">
            <form action="{{ route('roles.search') }}" class="d-flex flex-row justify-content-between">
                <input type="text" name="search" id="search" class="form-control rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Zoeken">
                <input type="submit" value="Ga Zoeken" class="btn btn-primary ml-4 px-2.5 py-1.5 text-sm font-weight-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            </form>
        </div>
        <div>

            <table class="table table-striped table-bordered  ">
                <tbody class="text-white shadow-lg shadow-black">
                    <tr class="border-b border-gray-500">
                        <td class="p-2">
                            Naam &nbsp;
                        </td>

                        <td class="p-2">
                            <div class="d-flex justify-content-center">
                                Acties
                            </div>
                        </td>
                    </tr>
                    @foreach ($allcate as $cate)
                    <tr class="border-b border-gray-700">
                        <td class="w-40 p-2">
                            <h6>
                                {{ ucfirst($cate->name) }}
                            </h6>
                        </td>
                        <td class="w-20 col-4 p-2">
                            <div class="d-flex justify-content-evenly">
                                <a href="{{ route('roles.edit', ['id' => $cate->id]) }}">Edit</a>
                                <form method="POST" action="{{ route('category.delete', ['id' => $cate->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-danger " href="{ }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    </input>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Category -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Rol Toevoegen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.added') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" id="inputField" placeholder="Iets invoeren">
                        </div>
                        <button type="submit" class="btn btn-primary">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Category -->
</x-app-layout>