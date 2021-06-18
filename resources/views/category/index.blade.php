@extends('layouts.adminox')

@section('page_name')
Category  
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ url('category') }}">category</a></li>
</ol> 
@endsection

@section('content')   
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card-box">
                <div class="card-header  bg-info text-dark">Category informations</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td scope="col">Checked</td>
                                        <th scope="col">SERIAL</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">category image</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <form action="{{ route('checked_delete') }}" method="POST">
                                    @csrf
                                    @forelse ($category_name_data as $category)
                                        <tbody>
                                            <tr>
                                                <td><input class="form-control check-input check_button" type="checkbox" name="category_id[]" value="{{ $category->id }}"></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td><img src="{{ asset('images/category_image/'.$category->category_image) }}" alt="not found" width="100"></td>
                                                <td>{{ $category->created_at->format('d/m/Y h:i:s A') }}</td>
                                                <td>
                                                    <a href="{{ route('category_update', [$category->id]) }}" class="btn btn-update bg-warning" type="button">Update</a>
                                                    <a href="{{ route('category_delete', [$category->id]) }}" class="delete_btn btn btn-delete bg-danger" type="button">Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data To Show</td>
                                        </tr>
                                    @endforelse
                                    </table>
                                    <div class="btn btn-group">
                                        <button type="button" class="btn btn-warning" id="button_checked">All Checked</button>
                                        <button type="button" class="btn btn-success" id="unchecked">Unchecked</button>
                                        <button type="submit" class="btn btn-danger">Checked Delete</button>
                                    </div>
                                </form>
                                @if (session('checked_data_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('checked_data_status') }}</span>
                                    
                                </div>
                            @endif
                    </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card-box">
                <div class="card-header  bg-dark text-white">Insert Category name</div>
                    <div class="card-body text-dark">
                       <form action="{{ url('category/post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Category image</label>
                                <input type="file" class="form-control" name="category_image">
                            </div>
                            @error('category_image')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            
                            <button type="submit" class="btn btn-primary">Add</button>
                             @if (session('category_insert_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('category_insert_status') }}</span>
                                    
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-8">
            <div class="card-box">
                <div class="card-header  bg-warning text-dark">Force delete all</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SERIAL</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                @forelse ($soft_delete as $category)
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->created_at->format('d/m/Y h:i:s A') }}</td>
                                            <td>
                                                <a href="{{ route('category_restore', [$category->id]) }}" class="btn btn-update bg-success" type="button">restore</a>
                                                <a href="{{ route('category_force_delete', [$category->id]) }}" class="delete_btn btn btn-delete bg-danger" type="button">force delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @empty
                                    <tr>
                                        <td colspan="50" class="text-center text-danger">No Data To Show</td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
            </div>
        </div>

    </div>


</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function(){
        $('#button_checked').click(function(){
            $('.check_button').attr('checked', 'checked');
        })
        $('#unchecked').click(function(){
            $('.check_button').removeAttr('checked');
        })
    });
</script>
    
@endsection