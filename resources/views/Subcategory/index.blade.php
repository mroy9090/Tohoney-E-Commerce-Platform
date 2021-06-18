@extends('layouts.adminox')

@section('page_name')
Product 
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('product_index') }}">product</a></li>
</ol> 
@endsection



@section('content')   
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card text-dark mb-3">
                <div class="card-header bg-danger">Header</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SERIAL</th>
                                <th scope="col">Category name</th>
                                <th scope="col">Sub Category name</th>
                                <th scope="col">CREATED AT</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @forelse ($subcategory as $subcategory_data)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ App\Models\Category::find($subcategory_data->category_id)->category_name }}</td>
                                <td>{{ $subcategory_data->subcategory_name}}</td>
                                <td>{{ $subcategory_data->created_at->format('d/m/Y h:i:s A') }}</td>
                                <td>
                                    <a href="*" class="btn btn-update bg-warning" type="button">Update</a>
                                    <a href="*" class="delete_btn btn btn-delete bg-danger" type="button">Delete</a>
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

        <div class="col-4">
            <div class="card-box">
                <div class="card-header  bg-dark text-white">Insert sub category information</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('subcategory_post') }}" method="POST">
                        <label class="form-label">sub category Name</label>
                        <select name="category_id"  class="form-control">
                            <option>--choose one--</option>
                            @foreach ($category as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">sub category Name</label>
                                <input type="text" class="form-control" name="subcategory_name">
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