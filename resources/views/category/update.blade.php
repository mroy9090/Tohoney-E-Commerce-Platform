@extends('layouts.adminox')
@section('page_name')
Update 
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ url('category') }}">category</a></li>
    <li class="breadcrumb-item">update</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $data_category->category_name }}</li>
</ol> 
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 m-auto">
            <div class="card-box">
                <div class="card-header  bg-warning text-dark">Update Category name</div>
                    <div class="card-body text-dark">
                       <form action="{{ url('category/post/update') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="id" value="{{ $data_category->id }}">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="update_category_name" value="{{ $data_category->category_name }}">
                            </div>
                            @error('update_category_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <button type="submit" class="btn btn-dark">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </div>
    
@endsection