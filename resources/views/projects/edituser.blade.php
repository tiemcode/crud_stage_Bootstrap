<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rol aanpasen') }}
        </h1>
    </x-slot>

    <div class="container w-50 dark-bg-gray-800">
        <div class="mt-10 mx-auto w-full max-w-sm">
            <form class="space-y-4" action="{{ route('project.user.update', ['projectId' => $projectId, 'userId' => $userId]) }}" method="POST">
                @csrf
                <div>
                    <div class="mt-2">
                        <label for="username" class="block text-sm font-medium">gebruikers naam</label>
                        <input type="text" name="title" id="title" disabled value="{{ $user->name }}" class="form-control @error('title') is-invalid @enderror" />
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="rollen" class="block text-sm font-medium">rol</label>
                    </div>
                    <div class="mt-2">
                        <select class="form-select rounded-md border-0 bg-white-5 py-1.5 shadow-sm ring-1 ring-inset ring-white-10 focus-ring-2 focus-ring-inset focus-ring-indigo-500" name="rollen" id="rollen">
                            @foreach ($roles as $item)
                            <option class="text-black" value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2 d-flex flex-row-reverse">
                    <input type="submit" class="ml-3 mb-5 btn btn-primary" value="voeg toe">
                    <a href="{{ route('projects.user', ['id' => $projectId]) }} " class="mb-5 btn btn-link">Teruggaan</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>