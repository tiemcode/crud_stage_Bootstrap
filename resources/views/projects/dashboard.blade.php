<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Projecten') }}
            </h1>

            <div class="d-flex flex-row-reverse">
                <a href="{{ route('projects.add') }}">
                    <button type="button" class="btn btn-primary">
                        Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container">
        <div class=" my-2">
            <form action="{{ route('project.search') }}" class="d-flex flex-row flex-between">
                <input type="text" name="search" id="search" class="form-control rounded-pill py-2.5 text-gray-900 shadow-sm" placeholder="Zoeken">
                <input type="submit" value="Ga Zoeken" class="btn btn-primary btn-sm font-weight-semibold ml-4">
            </form>
        </div>

        <table class="table table-bordered table-striped  ">
            <tbody>
                <tr class="border-b border-gray-500">
                    <td class="p-2">
                        Titel
                    </td>
                    <td class="p-2">
                        <div class="d-flex justify-center">
                            <p>
                                Aangemaakte Datum
                            </p>
                        </div>
                    </td>
                    <td class="p-2">
                        <div class="d-flex justify-center">
                            <p>
                                Acties
                            </p>
                        </div>
                    </td>
                </tr>
                @foreach ($project as $post)
                <tr class="border-b border-gray-700">
                    <td class="w-40 p-2">
                        <h6>
                            {{ Str::ucfirst($post->name) }}
                        </h6>
                    </td>

                    <td class="w-20 p-2">
                        <div class="d-flex justify-center">
                            {{ date('d/m/Y', strtotime($post->date_started)) }}
                        </div>
                    </td>
                    <td class="w-20 p-2">
                        <div class="d-flex justify-content-evenly">
                            <a href='{{ route('projects.edit', ['id' => $post->id]) }}'>Edit</a>
                            <form id="formDelete" method="POST" action="{{ route('projects.delete', ['id' => $post->id]) }}" onsubmit="return confirm('Weet je zeker dat je deze wilt verwijderen?');">
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end pt-2">
            {!! $project->links("pagination::bootstrap-5") !!}
        </div>
    </div>
    </div>
</x-app-layout>
