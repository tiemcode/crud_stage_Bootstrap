<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-weight-semibold text-xl leading-tight">
                {{ __('Gebruiker taken') }}
            </h1>
        </div>
    </x-slot>
    <div class="d-flex justify-content-center" style="width: 85%;">
        <div class="d-flex pt-3 items-center flex-column justify-content-center w-100 bg-dark-gray">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('projects.task.edit', ['task_id' => $task_id, 'project_id' => $id]) }}" aria-current="page">Aanpasen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page">gebruikers</a>
                </li>
            </ul>
            <div class="mt-2">
                <form enctype="multipart/form-data" method="post" action="{{ route('tast.user.update', ['project_id' => $id, 'task_id' => $task_id]) }}">
                    @csrf
                    <div class="card">
                        @foreach ($users as $user)
                        <div>
                            <input type="checkbox" id="horns" value="{{ $user->id }}" name="users" />
                            <label for="users">{{ $user->name }}</label>
                        </div>
                        @endforeach
                        <div class="mt-2 d-flex ">
                            <input type="submit" class="ml-3 mb-5 btn btn-primary" value="voeg toe">
                            <a href="{{ route('projects.task', ['id' => $id]) }}" class="mb-5 btn btn-link">ga
                                terug</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
