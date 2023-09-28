<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('categorie aanpassen') }}
        </h1>
    </x-slot>
    <div class="flex w-[50%]  justify-center ">
        <div class=" flex w-full justify-center dark:bg-gray-800">
            <form class="" action="{{ route('roles.added') }}" method="post">
                @csrf
                <div class="flex flex-row pt-4 ">
                    <div id="richt">
                        <div class="mt-2">
                            <label for="title" class="">title</p>
                                <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$data->title}}" />
                        </div>
                        <div class="mt-2 flex flex-row-reverse">
                            <input type="submit" class=" ml-3 mb-5 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold  shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" value="voeg toe">
                            <a href="{{route('roles.index')}}">
                                <div class="mb-5 inline-flex items-center  px-3 py-2 text-sm font-medium text-indigo-400 underline shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">ga terug</d>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>