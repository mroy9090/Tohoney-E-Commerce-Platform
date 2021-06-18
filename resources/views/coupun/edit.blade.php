@extends('layouts.adminox')

@section('page_name')
coupun 
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('coupun.index') }}">Coupun</a></li>
    <li class="breadcrumb-item"><a href="">update</a></li>
</ol> 
@endsection



@section('content')   
<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card-box ">
                <div class="card-header  bg-dark text-white">Insert product information</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('coupun.update',[$coupun->id]) }}" method="POST" class="form-responsive">
                        
                        @csrf
                        @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">coupun Name</label>
                                <input type="text" class="form-control" name="coupun_name" value="{{ $coupun->coupun_name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">discount ammount</label>
                                <input type="number" class="form-control" name="discount_ammount" value="{{ $coupun->discount_ammount }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">expired date</label>
                                <input type="date" class="form-control" name="expired_date" value="{{ $coupun->expired_date }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">users limit</label>
                                <input type="number" class="form-control" name="users_limit" value="{{ $coupun->users_limit }}">
                            </div>
                            
                            <button type="submit" class="btn btn-danger">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection