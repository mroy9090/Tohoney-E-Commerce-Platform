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


    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('cart_update') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $flag = true;
                                    $subtotal=0;
                                    $total = 0;
                                @endphp
                                @foreach ($cart as $cart_data)
                                    <tr>
                                        <td class="images"><img src="{{ asset('images') }}/product_image/{{ App\Models\Product::find($cart_data->product_id)->product_image }}" alt=""></td>
                                        <td class="product"><a class="text-danger">{{ $cart_data->relationProductTable->product_name }}
                                            <br>
                                            @if ($cart_data->relationProductTable->product_quantity < App\Models\Addtocart::find($cart_data->id)->quantity)
                                                <span class="badge bg-danger text text-light">Not in vailable</span>
                                                <br>
                                                <span class="badge bg-success text text-light">Available in stock: {{ App\Models\Product::find(App\Models\Addtocart::find($cart_data->id)->product_id)->product_quantity }}</span>
                                                @php
                                                    $flag=false
                                                @endphp
                                            @endif
                                        </a></td>
                                        <td class="ptice">${{ $cart_data->relationProductTable->product_price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" value="{{ App\Models\Addtocart::find($cart_data->id)->quantity }}" name="quantity[{{ $cart_data->id }}]"/>
                                        </td>
                                        
                                        <td class="total">$
                                            @php
                                                
                                                echo $subtotal = $subtotal + (App\Models\Product::find($cart_data->product_id)->product_price * $cart_data->quantity) ;
                                                $total=$total+$subtotal;
                                                $subtotal=0;
                                            @endphp
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                        <li><a href="shop.html">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code" id="coupun_code">
                                        <button id="coupun" type="button">Apply Cupon</button>
                                    </div>
                                    <br>
                                    @if (session('coupun_error'))
                                    <div class="alert alert-danger" role="alert">
                                            {{ session('coupun_error') }}
                                    </div>
                                        
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{ $total }}</li>
                                        <li><span class="pull-left"> Discount </span> {{ $coupun_discount }}(%)</li>
                                        <li><span class="pull-left"> Total(in ammount)</span>{{ ($total - ($total*($coupun_discount/100))) }}</li>
                                        <li><span class="pull-left"> Total </span></li>
                                    </ul>
                                    @php
                                        session([
                                            'session_total' => $total,
                                            'session_coupun_discount' => $coupun_discount,
                                            'session_total_in_ammount' => ($total - ($total*($coupun_discount/100))),
                                            'coupun_name' => $coupun_name

                                        ]);
                                    @endphp
                                    @if ($flag=="false")
                                        <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    
@endsection


{{-- pass value using jquery --}}
@section('coupun_script')
<script>
    $(document).ready(function () {
        $('#coupun').click(function () {
            var coupun_code = $('#coupun_code').val();
            var coupun_link = "{{ url('cart') }}/" + coupun_code;
            window.location = coupun_link

        });
    });
</script>
@endsection