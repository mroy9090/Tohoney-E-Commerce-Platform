@extends('layouts.adminox')

@section('page_name')
FAQ
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('faq') }}">faq</a></li>
</ol> 
@endsection



@section('content')   
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card-box">
                <div class="card-header  bg-info text-dark">FAQ informations</div>
                    <div class="card-body text-dark">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SERIAL</th> 
                                        <th scope="col">FAQ question</th>
                                        <th scope="col">FAQ answer</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <form action="{{ route('checked_delete') }}" method="POST">
                                    @csrf
                                    @forelse ($faq_data as $faqs_data)
                                        <tbody>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $faqs_data->faq_question }}</td>
                                                <td>{{ $faqs_data->faq_answer }}</td>
                                                <td>{{ $faqs_data->created_at->format('d/m/Y h:i:s A') }}</td>
                                                <td>    
                                                    <a href="{{ route('faqdelete', [$faqs_data->id]) }}" class="delete_btn btn btn-delete bg-danger" type="button">Delete</a>
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
                <div class="card-header  bg-dark text-white">Insert faq</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('faqpost') }}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">insert question</label>
                                <input type="text" class="form-control" name="faq_question">
                            </div>
                            @error('faq_question')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                             <div class="mb-3">
                                <label class="form-label">insert answer</label>
                                <textarea name="faq_answer"rows="10" class="form-control"></textarea>
                            </div>
                            @error('faq_answer')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            <button type="submit" class="btn btn-success">Add</button>
                             @if (session('faq_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('faq_status') }}</span>
                                    
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