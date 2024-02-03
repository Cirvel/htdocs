<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

    <head>
        <title>{{ $title }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <h3 style="text-align: center">
            CHASSEURS
        </h3>
        <table style="width:100%">
            <tr>
                <td style="text-align: left">
                    {{ $nickname }}
                </td>
                <td style="text-align: center">
                    {{ $register }}
                </td>
                <td style="text-align: right">
                    {{ $date }}
                </td>
            </tr>
        </table>
        <hr>

        {{-- <table class="table table-striped"> --}}
        <table style="width: 100%" class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 10ch;">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Category</th>
                    <th scope="col">Cost</th>
                    <th scope="col" style="width: 10ch;">Amount</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ((array)$carts as $key => $cart)
                <tr>
                    <td style="text-align: right" >{{ $no }}</td>
                    {{-- <td style="text-align: right" >{{ $key }}</td> --}}
                    <td style="text-align: center" >{{ $cart['item_name'] }}</td>
                    <td style="text-align: center" >{{ $cart['category_name'] }}</td>
                    <td style="text-align: right" >Rp. {{ number_format($cart['price']) }}</td>
                    <td style="text-align: right" >{{ $cart['amount'] }}</td>
                    <td style="text-align: right" >Rp. {{ number_format($cart['total']) }}</td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
        </table>
        <h4>Total Cost: Rp. {{ number_format(array_sum(array_column($carts,'total'))) }} </h4>
    </body>
</html>