<x-guest-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mijn projecten') }}
        </h1>
    </x-slot>


    <div class="container">
        <div class="row mt-4 ">
            @foreach ($projects as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('project.details', $item) }}">{{ ucfirst($item->name) }}
                            </a>

                        </h5>
                        <div class="card-text ">{!! $item->intro !!}</div>
                        <p class="card-text fs-6  fst-italic ">
                            {{ date('d/m/Y', strtotime($item->date_started)) }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-guest-layout>
