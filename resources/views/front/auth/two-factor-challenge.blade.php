<x-front-layout>
    <x-slot:title>2FA Challenge</x-slot:title>
    <x-slot:breadcrumbs>
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
                    <form class="card login-form" method="post" action="{{ route('two-factor.login') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA Challenge</h3>
                                <p>You must enter the 2FA Code</p>
                            </div>
                            <div class="form-group input-group">
                                <label for="two_factor_code">2FA Code</label>
                                <input class="form-control" type="text" name="code">
                            </div>
                            <div class="form-group input-group">
                                <label for="two_factor_code">Recovery Code</label>
                                <input class="form-control" type="text" name="recovery_code">
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Check</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>