<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('bestellingen') }}
        </h1>
    </x-slot>
    <div style="width: 85%;">
        <div class="my-2">
            <form action="{{ route('orders.search') }}" class="d-flex flex-row-reverse">
                <input type="submit" value="Zoeken" class="btn btn-primary btn-sm  font-weight-semibold ml-4">
                <input class="w-25 form-control " type="text" name="search" id="search"
                    class="form-control rounded py-2.5 me-1 text-gray-900 shadow-sm" placeholder="Zoeken">
            </form>
        </div>
        <table class="table table-striped table-bordered shadow-sm ">
            <thead>
                <tr>
                    <th>Order id</th>
                    <th>Gebruiker</th>
                    <th>Datum</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>


                @forelse ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Bekijk</a>
                            <form action="{{ route('orders.delete', $order->id) }}" method="POST"
                                class="d-inline-block ">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Verwijder" class="btn btn-primary btn-sm btn-danger">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Geen bestellingen gevonden</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
