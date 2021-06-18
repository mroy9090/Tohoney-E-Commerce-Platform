@extends('layouts.adminox')

@section('page_name')
Setting 
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('setting') }}">setting</a></li>
</ol> 
@endsection


@section('content')   
<div class="container">
    <div class="row">
        <div class="col-4 m-auto">
            <div class="card-box ">
                <div class="card-header  bg-success text-white">Text settings</div>
                    <div class="card-body text-dark ">
                       <form action="{{ route('settingpost') }}" method="POST">
                                
                            @csrf
                                <div class="mb-3">
                                    <label class="form-label">Phone number</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $setting_data->where('setting_name','phone')->first()->setting_value }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">email address</label>
                                    <input type="text" class="form-control" name="email" value="{{ $setting_data->where('setting_name','email')->first()->setting_value }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">address</label>
                                    <input type="text" class="form-control" name="email" value="{{ $setting_data->where('setting_name','address')->first()->setting_value }}">
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