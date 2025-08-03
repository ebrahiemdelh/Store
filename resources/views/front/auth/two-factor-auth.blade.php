<x-front-layout>
    <x-slot:title>Two Factor Authentication</x-slot:title>
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
                    <form class="card login-form" method="post" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>Please enter the verification code sent to your email.</p>
                            </div>
                            @if (session('status') == 'two-factor-authentication-enabled')
                                <div class="mb-4 font-medium text-sm">
                                    Please finish configuring your two-factor authentication below.
                                </div>

                            @endif
                            <div class="button">
                                @if(!$user->two_factor_secret)
                                    <button class="btn" type="submit">Enable</button>
                                @else
                                <div class="p4">
                                    {!! $user->twoFactorQrCodeSvg() !!}
                                </div>
                                <h3>Recovery codes</h3>
                                <ul class="p4 mb-4">
                                    @foreach ($user->RecoveryCodes() as $code)
                                        <li>{{ $code }}</li>
                                    @endforeach
                                </ul>
                                @method('DELETE')
                                <button class="btn" type="submit">Disable</button>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>