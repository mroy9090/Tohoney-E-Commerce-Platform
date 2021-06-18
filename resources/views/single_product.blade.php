@extends('layouts.tohoney_home')



@section('body')

<!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->


    
    <!-- single-product-area start-->
    <div class="single-product-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            <div class="item">
                                <img src="{{ asset('images/product_image/'.$product->product_image) }}" alt="">
                            </div>
                            @foreach ($featured_photos as $photos)
                            <div class="item">
                                <img src="{{ asset('images/product_featured_images/'.$photos->featured_photo_name) }}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="product-thumbnil-active  owl-carousel">
                            <div class="item">
                                <img src="{{ asset('images/product_image/'.$product->product_image) }}" alt="">
                            </div>
                        @foreach ($featured_photos as $photos)
                            <div class="item">
                                <img src="{{ asset('images/product_featured_images/'.$photos->featured_photo_name) }}" alt="">
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-single-content">
                        <h3>{{ $product->product_name }}</h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left">${{ $product->product_price }}</span>
                            <br>
                            <span class="badge bg-warning text-dark">available product: {{ $product->product_quantity }}</span>
                            <ul class="rating pull-right">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li>(05 Customar Review)</li>
                            </ul>
                        </div>
                        <p>{{ $product->product_short_description }}</p>
                        <form action="{{ route('add_cart',[$product]) }}" method="POST">
                            @csrf
                            <ul class="input-style">
                                <li class="quantity cart-plus-minus">
                                    <input type="number" value="1" name="quantity" />
                                </li>
                                <li>
                                    <button class="btn btn-danger">Add to cart</button>
                                </li>
                            </ul>
                        </form>
                        @if (session('status'))
                            <div class="alert alert-primary" role="alert">
                              {{ session('status') }}
                            </div>
                        @endif
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li><a href="#">{{ $category_name }}</a></li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                            <li><a data-toggle="tab" href="#tag">Faq</a></li>
                            <li><a data-toggle="tab" href="#review">Review</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="description-wrap">
                               <p>{{ $product->product_long_description }}</p>
                               
                            </div>
                        </div>
                        <div class="tab-pane" id="tag">
                            <div class="faq-wrap" id="accordion">
                                @foreach ($faq_data as $faq)
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5><button data-toggle="collapse" data-target="#collapseOne{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne">{{ $faq->faq_question }} </button></h5>
                                    </div>
                                    <div id="collapseOne{{ $faq->id }}" class="collapse {{ ($loop->iteration)==1 ? 'show':'' }}" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            {{ $faq->faq_answer }}
                                        </div>
                                    </div>
                                </div>
                                 @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="review">
                            <div class="review-wrap">
                                <ul>
                                    <li class="review-items">
                                        <div class="review-img">
                                            <img src="{{ asset('tohoney') }}/assets/images/comment/1.png" alt="">
                                        </div>
                                        <div class="review-content">
                                            <h3><a href="#">GERALD BARNES</a></h3>
                                            <span>27 Jun, 2019 at 2:30pm</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="add-review">
                                <h4>Add A Review</h4>
                                <div class="ratting-wrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>task</th>
                                                <th>1 Star</th>
                                                <th>2 Star</th>
                                                <th>3 Star</th>
                                                <th>4 Star</th>
                                                <th>5 Star</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>How Many Stars?</td>
                                                <td>
                                                    <input type="radio" name="a" />
                                                </td>
                                                <td>
                                                    <input type="radio" name="a" />
                                                </td>
                                                <td>
                                                    <input type="radio" name="a" />
                                                </td>
                                                <td>
                                                    <input type="radio" name="a" />
                                                </td>
                                                <td>
                                                    <input type="radio" name="a" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h4>Name:</h4>
                                        <input type="text" placeholder="Your name here..." />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h4>Email:</h4>
                                        <input type="email" placeholder="Your Email here..." />
                                    </div>
                                    <div class="col-12">
                                        <h4>Your Review:</h4>
                                        <textarea name="massage" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn-style">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- single-product-area end-->


    <!-- featured-product-area start -->
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-left">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($category_related_product as $product)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="{{ asset('images/product_image/'.$product->product_image) }}" alt="">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="{{ route('single_product', [$product->id]) }}">{{ $product->product_name }}</a></h3>
                                        <p>${{ $product->product_price }}</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @empty
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="alert alert-primary" role="alert">
                            nothing to show
                        </div>
                    </div>
                @endforelse


            </div>
        </div>
    </div>
    <!-- featured-product-area end -->
    
@endsection