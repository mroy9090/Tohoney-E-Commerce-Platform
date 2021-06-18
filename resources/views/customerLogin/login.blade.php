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

<!-- checkout-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <form action="{{ route('customerLogin.post') }}" method="POST">
                        @csrf
                        <div class="account-form form-style">
                            <p>User Email Address *</p>
                            <input type="email" name="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror

                            <p>Password *</p>
                            <input type="Password" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror
                            @if (session('mail_error'))
                                <span class="text-danger">{{ session('mail_error') }}</span>
                                <br>
                                <br>
                            @endif
                            @if (session('password_error'))
                                <span class="text-danger">{{ session('password_error') }}</span>
                                <br>
                                <br>
                            @endif
                            <div class="row">
                                <div class="col-lg-6">
                                    <input id="password" type="checkbox">
                                    <label for="password">Save Password</label>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a href="#">Forget Your Password?</a>
                                </div>
                            </div>
                            <button type="submit">SIGN IN</button>
                            <div class="text-center">
                                <a href="{{ route('checkout') }}">Or Creat an Account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->

    
@endsection