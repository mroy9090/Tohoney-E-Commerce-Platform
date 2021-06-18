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



<br>


@auth
 <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="{{ route('billing.post') }}" method="POST" id="main-form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <p>Name *</p>
                                    <input type="text" value="{{ Auth::user()->name }}" name="client_name">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value="{{ Auth::user()->email }}" name="client_email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text"  name="client_phone">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select id="country_name"  name="client_country_name">
                                        <option value="">choose one</option>
                                        @foreach ($country_list as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>City *</p>
                                    <select id="city_list" name="client_city">
                                        <option value="">choose one</option>
                                    </select>
                                </div> 
                                <div class="col-sm-6 col-12">
                                    <p>address</p>
                                    <input type="text" name="billing_address">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>post/code *</p>
                                    <input type="text" name="billing_post_code">
                                </div>                     
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                                @error('client_name')
                                    <span class="text-danger">{{ "Enter correct information" }}</span>
                                    <br>
                                    <br>
                                @enderror
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            <li>Coupun name <span class="pull-right"><strong>{{ session('coupun_name') ? session('coupun_name'):"not applicable" }}</strong></span></li>
                            <li>Subtotal <span class="pull-right"><strong>${{ session('session_total') }}</strong></span></li>
                            <li>Coupun discount <span class="pull-right"><strong>{{ session('session_coupun_discount') }}%</strong></span></li>
                            <li>Total<span class="pull-right">${{ session('session_total_in_ammount') }}</span></li>
                        </ul>
                        <ul class="payment-method">                            
                            <li>
                                <input id="card" type="radio" name="payment_option" value="1">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="radio" name="payment_option" value="2">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button type="button" id="button">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a  title="SSLCommerz" alt="SSLCommerz"><img style="width:900px;height:auto;" src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-05.png" /></a>

            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@else
  <!-- checkout-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <form action="{{ route('checkout_post') }}" method="POST">
                        @csrf
                        <div class="account-form form-style">
                            <p>User Name *</p>
                            <input type="text" name="name">
                            <p>User email *</p>
                            <input type="email" name="email">
                            <p>Password *</p>
                            <input type="Password" name="password">
                            <p>Confirm Password *</p>
                            <input type="Password">
                            <button type="submit">Register</button>
                            <div class="text-center">
                                <a href="{{ route('customer_login') }}">Or Login</a>
                            </div>
                            
                        </div>
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                        @enderror
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                        @enderror
                    </form>
                    <div class="text text-center">
                        <a href="{{ url('auth/redirect') }}">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endauth
@endsection



@section('script')
<script>
 // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#country_name').select2();
    $('#country_name').change(function(){
        var country_id=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "city/post",
            data: {country_id:country_id},
            success: function(data) {
                $('#city_list').html(data);
            }
        });
    });
    $('#button').click(function(){
        if($("input[name=payment_option]:checked").val() == 1){
            $('#main-form').attr('action','http://127.0.0.1:8000/pay');
            $( "#main-form" ).submit();
        }
        else{
            $('#main-form').attr('action','http://127.0.0.1:8000/checkout/billing/post');
            $( "#main-form" ).submit();
            
        }
    });
});
</script>
    
@endsection
