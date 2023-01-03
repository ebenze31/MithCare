@extends('layouts.mithcare')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="section-overlay"></div>
          
                <div class="row">

                    <div class="col-lg-9 col-12 mx-auto">
                        <form class="custom-form donate-form" method="POST" action="{{ route('login') }}" role="form">
                            @csrf
                            <h3 class="mb-4 ">Login</h3>

                            <div class="row">

                                <div class="form-group row mt-2">

                                    <div class="col-lg-12 col-12">
                                        <input id="email" type="email" placeholder="Username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-5">


                                    <div class="col-lg-12 col-12">
                                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-5">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                PPAP
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-lg-12 col-12">
                                        <a class="btn btn-link" href="{{ route('register') }}">
                                            Register
                                        </a>

                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="form-control mt-4"> {{ __('Login') }}</button>

                            </div>

                            <!-- <div class="col-lg-12 col-12">
                                <h5 class="mt-2 mb-3">Select an amount</h5>
                            </div>


                            <div class="col-lg-6 col-12 form-check-group">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">$</span>

                                    <input type="text" class="form-control" placeholder="Custom amount" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <h5 class="mt-1">Personal Info</h5>
                            </div>

                            <div class="col-lg-6 col-12 mt-2">
                                <input type="text" name="donation-name" id="donation-name" class="form-control" placeholder="Jack Doe" required>
                            </div>

                            <div class="col-lg-6 col-12 mt-2">
                                <input type="email" name="donation-email" id="donation-email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jackdoe@gmail.com" required>
                            </div>

                            <div class="col-lg-12 col-12">
                                <h5 class="mt-4 pt-1">Choose Payment</h5>
                            </div>

                            <div class="col-lg-12 col-12 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="DonationPayment" id="flexRadioDefault9">
                                    <label class="form-check-label" for="flexRadioDefault9">
                                        <i class="bi-credit-card custom-icon ms-1"></i>
                                        Debit or Credit card
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="DonationPayment" id="flexRadioDefault10">
                                    <label class="form-check-label" for="flexRadioDefault10">
                                        <i class="bi-paypal custom-icon ms-1"></i>
                                        Paypal
                                    </label>
                                </div>

                                <button type="submit" class="form-control mt-4">Submit Donation</button>
                            </div>
                            </div>-->
                        </form>
                    </div>

             
            </div>



                <!-- <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div> -->
           
        </div>
    </div>
</div>
@endsection