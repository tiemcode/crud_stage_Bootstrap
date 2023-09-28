<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('rolen') }}
            </h1>
            <div class="flex flex-row-reverse">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <button type="button">
                        rol toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="w-1/2">

        <div class="my-2 ">
            <form action="{{route('roles.search')}}" class="flex flex-row flex-between ">
                <input type="text" name="search" id="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="zoeken">
                <input type="submit" value="ga zoeken" class="rounded-md ml-4 bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold  shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            </form>
        </div>

        <table class="w-full rounded  dark:bg-gray-800">
            <tbody class=" shadow-lg shadow-black ">
                <tr class="border-b border-gray-500">
                    <td class="p-2">
                        naam &nbsp
                    </td>
                    <td class="p-2">
                        <div class="flex justify-center">
                            <p>voor het laast geedit</p>
                        </div>
                    </td>
                    <td class="p-2">
                        <div class="flex justify-center">
                            acties
                        </div>
                    </td>
                </tr>
                @foreach ($allcate as $cate )
                <tr class="border-b border-gray-700">
                    <td class="w-[40%] p-2">
                        <h6>
                            {{ Str::ucfirst($cate->name) }}
                        </h6>
                    </td>
                    <td class="w-[20%] p-2 ">
                        <div class="flex justify-center">
                            {{ date('d/m/Y', strtotime($cate->updated_at)) }}
                        </div>
                    </td>
                    <td class="w-[20%] p-2">
                        <div class="flex justify-evenly">
                            <a class=" no-underline" href="/id={{$cate->id}}" data-bs-toggle="modal" data-bs-target="#editModal">edit</a>
                            <form method="POST" action="{{ route('category.delete', ['id' => $cate->id]) }}">
                                @csrf
                                <div class="text-red-500 hover:cursor-pointer" :href="route('deletePost')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    {{ __('delete') }}
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- add category -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">rol toevoegen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.added') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" id="inputField" placeholder="Enter something">
                        </div>
                        <button type="submit" class="btn btn-primary">toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end add category -->
    <!-- edit category -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">categorieën aanpasen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" id="inputField" placeholder="Enter something">
                        </div>
                        <button type="submit" class="btn btn-primary">pas aan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>