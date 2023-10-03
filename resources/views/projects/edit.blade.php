<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl leading-tight">
            {{ __('project toevoegen') }}
        </h1>
    </x-slot>
    <div class="container d-flex justify-content-center w-50">
        <div class="d-flex pt-3 align-items-center flex-column justify-content-center w-100 bg-darkgray-800">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page">aanpassen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.user', ['id' => $data->id]) }}">gebruiker</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.task', ['id' => $data->id]) }}" aria-current="page">taken</a>
                </li>
            </ul>
            <div class="tab-content" id="nav-tabContent">
                <div>
                    <form enctype="multipart/form-data" class="" action="{{ route('addedpost') }}" method="post">
                        @csrf
                        <div class="row flex-row pt-4">
                            <div id="richt" class="col">
                                <div class="mb-2">
                                    <label for="title">titel</label>
                                    <input type="text" value="{{$data->name}}" name="title" id="title" class="form-control rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6" />
                                    @error('title')
                                    <div>
                                        @foreach ($errors->get('title') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="intro">intro</label>
                                    <textarea name="intro" id="intro" class="form-control intro rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6">{{$data->intro}}</textarea>
                                    @error('description')
                                    <div>
                                        @foreach ($errors->get('intro') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="description">description</label>
                                    <textarea rows="8" cols="48" name="description" id="description" class="form-control rounded-0 py-1.5 text-gray-900 shadow-sm border-1 border-inset border-gray-300 placeholder-text-gray-400 focus-ring-2 focus-ring-inset focus-ring-indigo-600 sm-text-sm sm-leading-6">{!! $data->description !!}</textarea>
                                    @error('description')
                                    <div>
                                        @foreach ($errors->get('description') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2 justify-content-end d-flex flex-row-reverse">
                                    <input type="submit" class="ml-3 mb-5 btn btn-primary btn-sm font-weight-bold px-3 py-2 text-sm shadow-sm hover-bg-indigo-500 focus-visible-outline focus-visible-outline-2 focus-visible-outline-offset-2 focus-visible-outline-indigo-500" value="voeg toe">
                                    <a href="{{ route('projects.index') }}">
                                        <div class="mb-5 btn btn-link btn-sm font-weight-medium text-indigo-400 text-decoration-underline shadow-sm focus-visible-outline focus-visible-outline-2 focus-visible-outline-offset-2 focus-visible-outline-indigo-500">
                                            ga terug
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade">
                <table class="w-100 rounded  bg-darkgray-800">
                    <tbody class="shadow-lg shadow-black">
                        <tr class="border-b border-gray-500">
                            <td class="p-2">
                                gebruiker&nbsp;
                            </td>
                            <td class="p-2">
                            </td>
                            <td class="justify-content-center d-flex p-2">
                                status
                            </td>
                            <td class="justify-content-center d-flex p-2">
                                taken
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    @section('scripts')
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
    </script>
    @endsection
</x-app-layout>
