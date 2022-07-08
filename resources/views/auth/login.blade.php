@extends('layouts.app1')

@section('title') Login @endsection

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					{{-- <form class="login100-form validate-form" method="POST" action="/checkUser"> --}}
					@csrf

					<span class="login100-form-title p-b-16">
						Login
					</span>
					<span class="login100-form-title p-b-35">
						<i class="ri ri-user-2-fill"></i>
					</span>

                    {{-- Email --}}
                    <div class=" wrap-input100 validate-input"  data-validate = "Valid email is: a@b.c">
                        <input id="email" type="text" class="input100  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        <span class="focus-input100" data-placeholder="Email"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
					{{-- <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" id="password">
						<span class="focus-input100" data-placeholder="Password"></span>

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div> --}}


                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <span for="password" class="focus-input100" data-placeholder="{{ __('Password') }}"></span>

                </div>
                    {{--  --}}
					<div class="row mb-3" style="margin-top: -20px;">
						<div class="">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

								<label class="form-check-label" for="remember">
									{{ __('Remember Me') }}
								</label>
							</div>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">{{ __('Login') }}</button>
						</div>
						@if (Route::has('password.request'))
							<a class="btn btn-link" href="{{ route('password.request') }}" style="margin-top: 10px;">
								{{ __('Forgot Your Password?') }}
							</a>
						@endif
					</div>

					<div class="text-center p-t-35">
						<span class="txt1">
							Don’t have an account?
						</span>

						@if (Route::has('register'))
							<a class="txt2" href="{{ route('register') }}">
								Sign Up
							</a>
						@endif
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
@endsection
