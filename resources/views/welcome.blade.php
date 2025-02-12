@extends('layout')
@section('publicTitel','welcome')
@section('publicContent')
<!--Registration Page Starts-->
<section id="regestration" class="auth-height">
    <div class="row full-height-vh m-0">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="card overflow-hidden" style="height: 45rem; width:100%">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row m-0" style="height:45rem ; width:100%">
                            <div class="col-lg-6 col-md-12 d-lg-flex flex-column justify-content-center align-items-center text-center">
                                <h1 class="text-primary mb-2 terxt-center display-1"><b>Done</b></h1>
                                <h3 class="text-primary mb-2 terxt-center display-3">ادارة المهام اسهل مع <b>Done</b></h3>
                                <div class="justify-content-between flex-column">
                                    <a href="{{ route('login')}}" class="btn bg-light-primary mb-2 mb-sm-0">تسجيل الدخول</a>
                                    <a href="{{route('register')}}" class="btn btn-primary">تسجيل</a>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center text-center auth-img-bg py-2">
                                <img src="../../../app-assets/img/gallery/ToDoplanning.png" alt="" class="img-fluid" width="500" height="230">
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