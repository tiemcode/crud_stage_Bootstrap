<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    @page {
        size: A4 landscape;
    }

    .container {
        display: flex;
        justify-content: space-between;
    }

    .col-8 {
        flex: 0 0 66.66667%;
        max-width: 66.66667%;
    }

    .card {
        padding: 1rem;
        margin-top: 1rem;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .col-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    h5 {
        font-size: 1.25rem;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 0.75rem;
        text-align: left;
    }

    th {
        font-weight: bold;
    }

    thead {
        background-color: #f8f9fa;
    }

    .table img {
        height: 75px;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .col-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .d-flex.flex-column {
        display: flex;
        flex-direction: column;
    }

    h4 {
        font-size: 1.5rem;
    }

    .fst-italic {
        font-style: italic;
    }
</style>


<body>
    <div class="container">
        <div class="d-flex justify-content-between ">
            <div class="col-8">
                <div class="card p-3">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="col-6">
                            <h5>Verzendadres</h5>
                            <p>{{ $addres[0]->firstName }} {{ $addres[0]->lastName }}</p>
                            <p>{{ $addres[0]->email }}</p>
                            <p>{{ $order->phoneNumber }}</p>
                            <p>{{ $addres[0]->address }}</p>
                            <p>{{ $addres[0]->city }}</p>
                            <p>{{ $addres[0]->zipCode }}</p>
                        </div>
                        @isset($addres[1])
                        <div class="col-6">
                            <h5>Factuuradres</h5>
                            <p>{{ $addres[1]->firstName }} {{ $addres[1]->lastName }}</p>
                            <p>{{ $addres[1]->address }}</p>
                            <p>{{ $addres[1]->city }}</p>
                            <p>{{ $addres[1]->zipCode }}</p>
                        </div>
                        @endisset
                    </div>
                </div>

                <div class="card mt-3 ">
                    <table class=" table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">naam</th>
                                <th scope="col">Prijs <sub class="fst-italic "> excl BTW</sub></th>
                                <th scope="col">Aantal</th>
                                <th scope="col">BTW prijs</th>
                                <th scope="col">totaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                            <?php
                            for ($i = 0; $i < count($orderProduct); $i++) {
                                if ($orderProduct[$i]['product_id'] == $item->id) {
                                    $amount = $orderProduct[$i]['amount'];
                                }
                            }
                            $vat = round(($item->price * $item->vat) / 100, 2);

                            $total = round($item->price * $amount + $vat * $amount, 2);

                            ?>

                            <tr>
                                <td>
                                    <img src="{{ asset('products/' . $item->img) }} " alt="product image" style="height: 75px">
                                </td>
                                <td>
                                    <p>{{ $item->title }}</p>
                                </td>
                                <td>
                                    <p>€ {{ $item->price }}</p>
                                </td>
                                <td>
                                    <p>{{ $amount }}</p>

                                </td>
                                <td>
                                    <p>€ {{ $vat }}</p>
                                </td>
                                <td>
                                    <p>€ {{ $total }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-3 card">
                <div class="d-flex flex-column ">
                    <h4>Subtotaal</h4>
                    <p>€ {{ $order->total_excl }}</p>
                    <h4>BTW bedrag</h4>
                    <p>€ {{ $order->vat }}</p>
                    <h4>totaal </h4>
                    <p>€ {{ $order->total_incl }}</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
