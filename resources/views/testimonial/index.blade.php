@extends('layouts.adminox')

@section('page_name')
Testimonial 
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('testimonial') }}">Testimonial</a></li>
</ol> 
@endsection


@section('content')   
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card-box">
                <div class="card-header  bg-info text-dark">Testimonial informations</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SERIAL</th> 
                                        <th scope="col">customer name</th>
                                        <th scope="col">testimonial details</th>
                                        <th scope="col">customer position</th>
                                        <th scope="col">customer photo</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <form action="{{ route('checked_delete') }}" method="POST">
                                    @csrf
                                    @forelse ($testimonial_data as $testimonial)
                                        <tbody>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $testimonial->customer_name }}</td>
                                                <td>{{ $testimonial->customer_details }}</td>
                                                <td>{{ $testimonial->customer_position }}</td>
                                                <td><img src="{{ asset('images/testimonial_image/'.$testimonial->customer_photo) }}" alt="not found" width="100"></td>
                                                <td>{{ $testimonial->created_at->format('d/m/Y h:i:s A') }}</td>
                                                <td>    
                                                    <a href="##" class="delete_btn btn btn-delete bg-danger" type="button">Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data To Show</td>
                                        </tr>
                                    @endforelse
                                    </table>
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
                <div class="card-header  bg-dark text-white">Insert testimonial</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('testimonialpost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">customer name</label>
                                <input type="text" class="form-control" name="customer_name">
                            </div>
                            @error('customer_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                             <div class="mb-3">
                                <label class="form-label">testimonial details</label>
                                <textarea name="customer_details"rows="10" class="form-control"></textarea>
                            </div>
                            @error('customer_details')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">customer position</label>
                                <input type="text" class="form-control" name="customer_position">
                            </div>
                             @error('customer_position')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">customer photo</label>
                                <input type="file" class="form-control" name="customer_photo">
                            </div>
                            @error('customer_photo')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <button type="submit" class="btn btn-success">Add</button>
                             @if (session('testimonial_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('testimonial_status') }}</span>
                                    
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
