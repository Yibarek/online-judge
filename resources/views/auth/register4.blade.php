{{-- @extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app1')

<style>
    .wrap-input100{
        margin-bottom: -15px;
        margin-top: -15px;
    }
</style>

@section('title') Register @endsection

@section('content')
	<div id="dropDownSelect1"></div>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" {{--onsubmit="return macth();" --}} method="POST" action="{{ route('register')" }}>
					@csrf

					<span class="login100-form-title p-b-16">
						Sign Up
					</span>
					<span class="login100-form-title p-b-35">
						<i class="ri ri-user-2-fill"></i>
					</span>

                    {{-- Username --}}
                    <div class=" wrap-input100 validate-input"  >
                        <input id="username" type="text" class="input100  @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        <span class="focus-input100" data-placeholder="Username"></span>
                        @error('Username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

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
                    <div class="wrap-input100 validate-input" data-validate="Invalid password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                        @error('password')
                                value ="12"
                        @enderror>
                        <span for="password" class="focus-input100" data-placeholder="{{ __('Password') }}"></span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    {{--  --}}

                    {{-- Confirm Password --}}
                    <div class="wrap-input100 validate-input" data-validate="Invalid password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">

                        <span for="password" class="focus-input100" data-placeholder="{{ __('Confirm Password') }}"></span>
                        <span class="invalid-feedback" role="alert">
                            <strong name="password-macth"></strong>
                        </span>
                    </div>
                    {{--  --}}

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">{{ __('Sign Up') }}</button>
						</div>
					</div>

					<div class="text-center p-t-35">
						<span class="txt1">
							Already have an account?
						</span>

						@if (Route::has('login'))
							<a class="txt2" href="{{ route('login') }}">
								{{ __('Login') }}
							</a>
						@endif
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>

@endsection
