<x-guest-layout>
    <x-slot name="header">
        <h2>{{ __($project->name) }}</h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ms-xl-0">
                <div class="row my-5">
                    <div class="col-md-8 mt-2 col-xl-6 text-center mx-auto">
                        <h4>{!! $project->intro !!}</h4>
                        <div class="w-lg-50">{!! $project->description !!}</div>
                    </div>
                </div>
                <div class="row">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">gebruikers</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">taken</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active  " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="container py-4 py-xl-5">
                                {{-- henl --}}
                                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                                    @foreach ($project->users as $user)
                                    <div class="col">
                                        <div class="card border-0 shadow-none">
                                            <div class="card-body d-flex align-items-center p-0"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="70" height="70" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" />
                                                <div>
                                                    <h5 class="fw-bold text-primary mb-0">
                                                        {{ $user->where('id', $user->pivot->user_id)->first()->name }}
                                                    </h5>
                                                    <p class="text-muted mb-1">
                                                        {{ $user->roles->where('id', $user->pivot->role_id)->first()->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{-- pieter --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Taak</th>
                                            <th scope="col">Beschrijving</th>
                                            <th scope="col">Deadline</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($project->tasks as $task)
                                        <tr class="border-b">
                                            <td>
                                                {{ $task->title }}
                                            </td>
                                            <td class="">
                                                {{ $task->description }}
                                            </td>
                                            <td>
                                                {{ $task->deadline }}
                                            </td>
                                            <td>
                                                @if ($task->finshed == 1)
                                                <p>
                                                    voltooid
                                                </p>
                                                @else
                                                <p>
                                                    bezig
                                                </p>
                                                @endif
                                            </td>
                                            <td> @can('canFinish', [$project, $task])
                                                @if ($task->finshed == 0)
                                                <form action="{{ route('task.finish', [$project, $task]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="1" name="value">
                                                    <input type="hidden" value="{{ $task->id }}" name="task">
                                                    <button type="submit" class="btn btn-primary">voltooien</button>
                                                </form>
                                                @else
                                                <form action="{{ route('task.finish', [$project, $task]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="0" name="value">
                                                    <input type="hidden" name="task" value="{{ $task->id }}"">
                                                                <button type=" submit" class="btn btn-primary">terug
                                                    zetten</button>
                                                </form>
                                                @endif
                                                @endcan
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>
                                                geen taken
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
