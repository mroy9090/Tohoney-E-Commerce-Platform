<div class="card text-white  mb-3">
  <div class="card-header bg-primary">Header</div>
  <div class="card-body text text-dark">
      <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">SERIAL</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">PHONE NUMBER</th>
                <th scope="col">TOTAL</th>
                <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($order_details as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $loop->iteration }}</</td>
                    <td>{{ $item->client_name }}</td>
                    <td>{{ $item->client_email }}</td>
                    <td>{{ $item->client_phone }}</td>
                    <td>${{ $item->total }}</td>
                    <td>
                        <a href="{{ route('invoice.download',[$item->id]) }}"><i class="fa fa-download">download invoice</i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
  </div>
</div>