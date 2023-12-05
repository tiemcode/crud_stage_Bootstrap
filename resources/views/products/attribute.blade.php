<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('attribuut van product') }}
            </h2>
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('products.attribute.add', ['productId' => $id]) }}">
                    <button type="button" class="btn btn-primary  font-weight-semibold">
                        product Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.edit', ['id' => $id]) }}" aria-current="page">aanpassen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">attributen</a>
                    </li>
                </ul>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th scope="col">Attirbuut</th>
                                        <th scope="col">Waarde</th>
                                        <th scope="col">Actie`s</th>
                                    </tr>
                                </thead>
                                @forelse ($attributes as $item)
                                <tr class="">
                                    <td scope="row">{{ $item->attribute->title }} </td>
                                    <td>{{ $item->value }}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly  ">
                                            <a href='{{ route('products.attribute.edit', ['productId' => $id, 'attributeId' => $item->id]) }}'>Edit</a>
                                            <form method="POST" action="{{ route('products.attribute.delete', ['productId' => $id, 'attributeId' => $item->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">geen attributen gevonden</td>
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
</x-app-layout>