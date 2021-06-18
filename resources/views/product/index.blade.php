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
            <div class="card-box">
                <div class="card-header  bg-info text-dark">Category informations</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <td scope="col">Checked</td>
                                        <th scope="col">SERIAL</th>
                                        <th scope="col">Category name</th>
                                        <th scope="col">Product name</th>
                                        <th scope="col">Product image</th>
                                        <th scope="col">Product price</th>
                                        <th scope="col">Product quantity</th>
                                        <th scope="col">added by</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">UPDATED AT</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <form action="{{ route('product_checked_delete') }}" method="POST">
                                    @csrf
                                    @forelse ($product_data as $product)
                                        <tbody>
                                            <tr>
                                                <td><input class="form-control check-input check_button" type="checkbox" name="product_id[]" value="{{ $product->id }}"></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if (App\Models\Category::withTrashed()->find($product->category_id))
                                                        {{ App\Models\Category::withTrashed()->find($product->category_id)->category_name }} 
                                                    @else
                                                    NULL
                                                    @endif
                                                </td>
                                                <td>{{ $product->product_name }}</td>
                                                <td><img src="{{ asset('images/product_image/'.$product->product_image) }}" alt="not found" width="100"></td>
                                                <td>{{ $product->product_price }}</td>
                                                <td>{{ $product->product_quantity }}</td>
                                                <td>
                                                    @php
                                                        if(App\Models\User::find($product->user_id)){
                                                            echo App\Models\User::find($product->user_id)->name;
                                                        }
                                                        else {
                                                            echo "NULL";
                                                        }
                                                    @endphp
                                                </td>
                                                <td>{{ $product->created_at->format('d/m/Y h:i:s A') }}</td>
                                                <td>
                                                    @if ( $product->updated_at)
                                                        {{ $product->updated_at->format('d/m/Y h:i:s A') }}
                                                        @else
                                                            NULL
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('update_product_name',[$product->id]) }}" class="btn btn-update bg-warning" type="button">Update</a>
                                                    <a href="{{ route('product_delete',[$product->id]) }}" class="delete_btn btn btn-delete bg-danger" type="button">Delete</a>
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
                        <form action="{{ route('product_post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <label class="form-label">category Name</label>
                        <select name="category_id"  class="form-control" id="category_name">
                            <option>--choose one--</option>
                            @foreach ($category_data as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        {{-- <label class="form-label">sub category</label>
                         <select name="sub_category"  class="form-control" id="subcategory_name">
                            <option>--choose one--</option>
                                <option value="">--------</option>
                        </select> --}}
                            <div class="mb-3">
                                <label class="form-label">product Name</label>
                                <input type="text" class="form-control" name="product_name">
                            </div>
                             @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">product price</label>
                                <input type="number" class="form-control" name="product_price">
                            </div>
                             @error('product_price')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">product quantity</label>
                                <input type="number" class="form-control" name="product_quantity">
                            </div>
                             @error('product_quantity')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">product short description</label>
                                <textarea name="product_short_description"  class="form-control" rows="10"></textarea>
                            </div>
                             @error('product_short_description')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">product long description</label>
                                <textarea name="product_long_description"  class="form-control" rows="10"></textarea>
                            </div>
                             @error('product_long_description')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Alert quantity</label>
                                <input type="number" class="form-control" name="alert_product_quantity">
                            </div>
                            @error('alert_product_quantity')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Insert image</label>
                                <input type="file" class="form-control" name="product_image">
                            </div>
                            @error('product_image')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Insert featured images</label>
                                <input type="file" class="form-control" name="product_featured_image[]" multiple>
                            </div>
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


    <div class="row">
        <div class="col-8">
            <div class="card-box">
                <div class="card-header  bg-warning text-dark">Force delete all</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SERIAL</th>
                                        <th scope="col">category name</th>
                                        <th scope="col">product name</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                @forelse ($soft_delete as $product)
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ App\Models\Category::withTrashed()->find($product->category_id)->category_name }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->created_at->format('d/m/Y h:i:s A') }}</td>
                                            <td>
                                                <a href="{{ route('product_restore', [$product->id]) }}" class="btn btn-update bg-success" type="button">restore</a>
                                                <a href="{{ route('product_force_delete', [$product->id]) }}" class="delete_btn btn btn-delete bg-danger" type="button">force delete</a>
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

@section('subcategory')
<script>
 // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#category_name').select2();
    $('#category_name').change(function(){
        var category_id=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "subcategory/post/{category_id}",
            data: {category_id:category_id},
            success: function(data) {
                $('#subcategory_name').html(data);
            }
        });
    });
});
</script>
@endsection