<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-weight-semibold text-xl leading-tight">
                {{ __('taken') }}
            </h1>
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('projects.task.add', ['id' => $id]) }}">
                    <button type="button" class="btn btn-primary">
                        taak Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="d-flex justify-content-center" style="width: 85%;">
        <div class="d-flex pt-3 items-center flex-column justify-content-center w-100 bg-dark-gray">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.edit', ['id' => $id]) }}">Aanpassen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('projects.user', ['id' => $id]) }}"
                        aria-current="page">Gebruikers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">taken</a>
                </li>
            </ul>
            <div class="mt-2">
                <table class="table table-striped ">
                    <tbody>
                        <tr class="border-b">
                            <td>taken</td>
                            <td>status</td>

                            <td class="d-flex justify-content-center ">actie`s</td>
                        </tr>
                        @forelse ($project->tasks as $user)
                            <tr class="border-b">
                                <td>
                                    {{ $user->title }}
                                </td>
                                <td>
                                    @if ($user->finshed == 1)
                                        <p>
                                            voltooid
                                        </p>
                                    @else
                                        <p>
                                            bezig
                                        </p>
                                    @endif
                                </td>
                                <td colspan="2" >
                                    <div class="d-flex justify-content-evenly">
                                        <a
                                            href='{{ route('projects.task.edit', ['project_id' => $id, 'task_id' => $user->id]) }}'>Edit</a>
                                        <form id="formDelete" method="POST"
                                            action="{{ route('projects.task.delete', ['id' => $id, 'task_id' => $user->id]) }}"
                                            onsubmit="return confirm('Weet je zeker dat je deze wilt verwijderen?');">
                                            @csrf
                                            <input type="submit" value="{{ __('Delete') }}" class="btn btn-danger "
                                                :href=" route('deletePost')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>geen gebruikers gevonden</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
