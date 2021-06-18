<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Invoice</title>
  </head>
  <body>
      <table class="table">
            <tr>
                <td>ORDER ID : {{ $data->id}}</td>
            </tr>
            <tr>
                <td>NAME : {{ $data->client_name }}</td>
            </tr>
            <tr>
                <td>EMAIL : {{ $data->client_email }}</td>
            </tr>
            <tr>
                <td>PHONE : {{ $data->client_phone }}</td>
            </tr>
            <tr>
                <td>BILLING ADDRESS : {{ $data->billing_address }}</td>
            </tr>
        </table>

        <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">SL. NO.</th>
                <th scope="col">Product name</th>
                <th scope="col">Product photo</th>
                <th scope="col">Product quantity</th>
                <th scope="col">Product price</th>
                <th scope="col">Unit price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="images/product_image/{{ $detail->relationProductTable->product_image }}" alt="not found" height="50" width="80"></td>
                    <td>{{ $detail->relationProductTable->product_name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ $detail->relationProductTable->product_price }}</td>
                    <td>${{ $detail->relationProductTable->product_price * $detail->quantity}}</td>
                </tr>
                
            @endforeach
        </tbody>
        </table>










    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>