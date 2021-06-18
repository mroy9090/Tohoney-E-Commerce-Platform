@extends('layouts.adminox')

@section('page_name')
Product 
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('coupun.index') }}">Coupun</a></li>
</ol> 
@endsection

@section('content')   
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card-box">
                <div class="card-header  bg-info text-dark">Category informations</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">SERIAL</th>
                                        <th scope="col">coupun name</th>
                                        <th scope="col">discount ammount</th>
                                        <th scope="col">expired date</th>
                                        <th scope="col">users limit</th>
                                        <th scope="col">created at</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                 @forelse ($coupun as $coupun)
                                        <tbody>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $coupun->coupun_name }}</td>
                                                <td>{{ $coupun->discount_ammount }}</td>
                                                <td>{{ $coupun->expired_date }}</td>
                                                <td>{{ $coupun->users_limit }}</td>
                                                <td>{{ $coupun->created_at->format('d/m/Y h:i:s A') }}</td>
                                                <td>
                                                    <a href="{{ route('coupun.edit',[$coupun->id]) }}" class="btn btn-success">Update</a>
                                                    <form action="{{ route('coupun.destroy',[$coupun->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')     {{-- this method indicates for DELETE method in CoupunController --}}
                                                        <button class="btn btn-danger">delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data To Show</td>
                                        </tr>
                                    @endforelse
                            </table>
                                @if (session('product_checked_data_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('product_checked_data_status') }}</span>
                                    
                                </div>
                            @endif
                    </div>
            </div>

        </div>

        <div class="col-4">
            <div class="card-box">
                <div class="card-header  bg-dark text-white">Insert product information</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('coupun.store') }}" method="POST" class="form-responsive">
                        
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">coupun Name</label>
                                <input type="text" class="form-control" name="coupun_name" placeholder="coupun name">
                            </div>
                             @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror

                            <div class="mb-3">
                                <label class="form-label">discount ammount</label>
                                <input type="number" class="form-control" name="discount_ammount" placeholder="discount_ammount">
                            </div>
                             @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror

                            <div class="mb-3">
                                <label class="form-label">expired date</label>
                                <input type="date" class="form-control" name="expired_date" placeholder="expired date">
                            </div>
                             @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror

                            <div class="mb-3">
                                <label class="form-label">users limit</label>
                                <input type="number" class="form-control" name="users_limit" placeholder="users limit">
                            </div>
                             @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            
                            
                            <button type="submit" class="btn btn-danger">Add</button>
                             @if (session('product_insert_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('product_insert_status') }}</span>
                                    
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection