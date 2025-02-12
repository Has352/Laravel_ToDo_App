@extends('layouts.app')

@section('content')

<!--Registration Page Starts-->
<section id="regestration" class="col-12 d-flex align-items-center justify-content-center" dir="rtl">
    <div class="row full-height-vh m-0">
        <div class="col-12 d-flex align-items-center justify-content-center" style="height: fit-content;">
            <div class="card bg-white">
                <div class="card-content" style=" margin-top: auto; margin-bottom: auto;">
                    <div class="card-body auth-img">
                        <div class="row m-0">
                            <div class="col-lg-6 col-md-12 px-4 py-3">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <h1 class="card-title mb-2 text-primary">{{ __('انشاء حساب') }}</h1>
                                    <p>قم بتعبئة الحقول التالية لانشاء حساب جديد.</p>
                                    <div class="mt-3">
                                        <input id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="الاسم">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <input id="email" name="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror" placeholder="البريد الالكتروني" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <input id="password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password" placeholder="كلمة المرور">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <input required autocomplete="new-password" name="password_confirmation" id="password-confirm" type="password" class="form-control mb-2"
                                            placeholder="تاكيد كلمة المرور">
                                    </div>

                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <a href="{{route('login')}}"
                                            class="btn bg-light-primary mb-2 mb-sm-0">العودة لتسجيل الدخول</a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('تسجيل') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div
                                class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center text-center auth-img-bg py-2">
                                <img src="../../../app-assets/img/gallery/register.png" alt=""
                                    class="img-fluid" width="350" height="230">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Registration Page Ends-->
@endsection