<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-weight-semibold text-xl leading-tight">
                {{ __('Projecten') }}
            </h1>
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('project.user.add', ['id' => $data->id]) }}">
                    <button type="button" class="btn btn-primary">
                        Gebruiker Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="d-flex justify-content-center" style="width: 85%;">
        <div class="d-flex pt-3 items-center flex-column justify-content-center w-100 bg-dark-gray">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.edit', ['id' => $data->id]) }}">Aanpassen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page">Gebruikers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.task', ['id' => $data->id]) }}" aria-current="page">taken</a>
                </li>
            </ul>
            <div class="mt-2">
                <table class="table table-striped ">
                    <tbody class="shadow-lg shadow-black">
                        <tr class="border-b">
                            <td>Gebruikers</td>
                            <td>Rollen</td>
                            <td>Actie`s</td>
                        </tr>
                        @forelse ($data->users as $user)
                        <tr class="border-b">
                            <td>
                                @if ($user->pivot->user_id)
                                {{ $user->where('id', $user->pivot->user_id)->first()->name }}
                                @else
                                Geen gebruiker gevonden
                                @endif
                            </td>
                            <td>
                                @if ($user->pivot->role_id)
                                {{ $user->roles->where('id', $user->pivot->role_id)->first()->name }}
                                @else
                                Geen rol toegewezen
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <a href='{{ route('projects.user.edit', ['userId' => $user->id, 'projectId' => $data->id]) }}'>Edit</a>
                                    <form id="formDelete" method="POST" action="{{ route('projects.user.delete', ['id' => $user->id]) }}" onsubmit="return confirm('Weet je zeker dat je deze wilt verwijderen?');">
                                        @csrf
                                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-danger " :href=" route('projects.user.delete')" onclick="event.preventDefault(); this.closest('form').submit();">
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