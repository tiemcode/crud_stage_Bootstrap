<x-guest-layout>
    <x-slot name="header">
        <h1 class="">
            {{ __('Artikelen') }}
        </h1>
    </x-slot>

    </div>
    <div class="container">
        <div class="row mt-4">
            @foreach ($allposts as $post)
            <div class="col-md-6 mb-4">
                <div class="card  shadow rounded">
                    <div class="card-body">
                        <h2 class="card-title">
                            {{ Str::ucfirst($post->title) }}
                        </h2>
                        <h3 class="card-subtitle font-weight-medium">
                            {{ Str::ucfirst($post->intro) }}
                        </h3>
                        <p class="card-text">
                            {{ Str::ucfirst($post->description) }}
                        </p>
                        @if ($post->file_name)
                        <img src="{{ asset($post->file_name) }}" class="img-fluid">
                        @endif
                        <p class="card-text fst-italic">Gepubliceerde op {{ date('d/m/Y', strtotime($post->date_posted)); }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    </div>
</x-guest-layout>
