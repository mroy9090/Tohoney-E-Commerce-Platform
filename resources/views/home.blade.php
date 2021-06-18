@extends('layouts.adminox')

@section('page_name')
Home   
@endsection
@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
</ol> 
@endsection



 @section('content')
<div class="container">
    @if (Auth::user()->role == 2)
        @include('customer.index')
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="card-box">
                    <div class="card-header bg-dark text-light text-center">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">SERIAL</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">LOGIN STATUS</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @foreach ($db_data as $item)
                                        <tr>
                                            <th>{{ $item->id }}</th>
                                            <td>{{ $loop->iteration }}</</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->created_at->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                            
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card text-dark mb-3">
                    <div class="card-body d-flex justify-content-center">
                        <div class="col-6">
                            <canvas id="myChart"></canvas>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endif
</div>
@endsection



@section('chart_js')
<script>
        const data = {
        labels: [
            'Cash on delevary',
            'Online payment'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [{{ $cash_on_delevary }}, {{ $credit_card }}],
            backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };
    const config = {
        type: 'doughnut',
        data,
        options: {}
    };
  // === include 'setup' then 'config' above ===

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

    
@endsection
