@extends('layouts.app')

@section('content')
<!--Login Page Starts-->

<section id="login" class="auth-height" dir="rtl">
    <div class="row full-height-vh m-0">
        <div class="col-12 d-flex align-items-center justify-content-center" style="height: fit-content;">
            <div class="card overflow-hidden">
                <div class="card-content bg-white">
                    <div class="card-header">{{ __('') }}</div>
                    <div class="card-body auth-img">
                        <div class="row m-0">

                            <div class="col-lg-6 col-12 px-4 py-3">
                                <h4 class="mb-2 card-title">تسجيل الدخول</h4>
                                <p>اهلاً بعودتك، قم بتسجيل الدخول لحسابك</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div>
                                        <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div>
                                        <input id="password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="كلمة المرور">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                                        <div class="remember-me mb-2 mb-sm-0">
                                            <div class="checkbox auth-checkbox">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember"><span>تذكرني</span></label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('نسيت كلمة المرور؟') }}
                                        </a>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <a href="{{route(name: 'register')}}" class="btn bg-light-primary mb-2 mb-sm-0">تسجيل</a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('دخول') }}
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary m-0">Or Login With</h6>
                                    <div class="login-options">
                                        <a class="btn btn-sm btn-social-icon btn-facebook mr-1"><span class="fa fa-facebook"></span></a>
                                        <a class="btn btn-sm btn-social-icon btn-twitter mr-1"><span class="fa fa-twitter"></span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                                <img src="{{asset('app-assets/img/gallery/GDPR-amico.png')}}" alt="" class="img-fluid" width="400" height="280">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--Login Page Ends-->
@endsection