<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h1 class="font-weight-semibold text-xl leading-tight">
                {{ __('taken aanpassen') }}
            </h1>
        </div>
    </x-slot>

    <div class="d-flex justify-content-center" style="width: 85%;">
        <div class="d-flex pt-3 items-center flex-column justify-content-center w-100 bg-dark-gray">
            <div class="mt-2">
                <form enctype="multipart/form-data" class="" method="POST" action="{{ route('projects.task.edited' ,['project_id' => $project_id , 'task_id'=>$task_id ]) }}">
                    @csrf
                    <div class="row flex-row pt-4">
                        <div id="richt" class="col">
                            <div class="mb-2">
                                <label for="title">titel</label>
                                <input type="text" value="{{$tasks->title}}" name="title" id="title" class="form-control rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6" />
                                @error('title')
                                <div>
                                    @foreach ($errors->get('title') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="description">description</label>
                                <textarea rows="8" cols="48" name="description" id="description" class="form-control rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6">{!! $tasks->description !!}</textarea>
                                @error('description')
                                <div>
                                    @foreach ($errors->get('description') as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="users">gebruikers</label>
                                <select class="form-control js-example-basic-multiple" name="users[]" multiple="multiple">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" />
                                    {{$user->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 d-flex justify-content-end ">
                                <a href="{{ route('projects.index') }}">
                                    <div class="mb-5 btn btn-link btn-sm font-weight-medium text-indigo-400 text-decoration-underline shadow-sm focus-visible-outline focus-visible-outline-2 focus-visible-outline-offset-2 focus-visible-outline-indigo-500">
                                        Teruggaan
                                    </div>
                                </a>
                                <input type="submit" class="ml-3 mb-5 btn btn-primary btn-sm font-weight-bold px-3 py-2 text-sm shadow-sm hover-bg-indigo-500 focus-visible-outline focus-visible-outline-2 focus-visible-outline-offset-2 focus-visible-outline-indigo-500" value="Toevoegen">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
    <style>
        .ck {
            height: 100px;
        }
    </style>
    <script>
        window.addEventListener('load', () => {
            for (const name of ['description', ]) {
                ClassicEditor
                    .create(document.getElementById(name))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    @endsection
</x-app-layout>