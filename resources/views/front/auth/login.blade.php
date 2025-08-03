<x-front-layout>
    <x-slot:title>User Login</x-slot:title>
    <x-slot:breadcrumbs>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Login</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumbs>
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="card login-form" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>You can login using your social media account or email address.</p>
                            </div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn facebook-btn"
                                            href="javascript:void(0)"><i class="lni lni-facebook-filled"></i> Facebook
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn twitter-btn"
                                            href="javascript:void(0)"><i class="lni lni-twitter-original"></i> Twitter
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn google-btn"
                                            href="javascript:void(0)"><i class="lni lni-google"></i> Google login</a>
                                    </div>
                                </div>
                            </div>
                            <div class="alt-option">
                                <span>Or</span>
                            </div>
                            <div class="form-group input-group">
                                <label
                                    for="{{ config('fortify.username') }}">{{ ucfirst(config('fortify.username')) }}</label>
                                <input class="form-control" type="text" name="{{ config('fortify.username') }}"
                                    required>
                            </div>
                            <div class="form-group input-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                @if(Route::has('password.request'))
                                    <a class="lost-pass" href="{{ route('password.request') }}">Forgot password?</a>
                                @endif
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>
                            @if(Route::has('register'))
                                <p class="outer-link">Don't have an account? <a href="{{route('register')}}">Register here
                                    </a>
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>