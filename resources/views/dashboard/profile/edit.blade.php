@extends('layout.master')
@section('title', 'Edit Profile')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <!-- left column -->
                <!-- general form elements -->
                <div class="col-md-7 pt-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <x-form.input type='text' name='first_name' placeholder="Enter First Name"
                                        value="{{ $user->profile->first_name ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <x-form.input type='text' name='last_name' placeholder="Enter Last Name"
                                        value='{{ $user->profile->last_name }}' />
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date Of Birth</label>
                                    <x-form.input type='date' name='date_of_birth'
                                        value='{{ $user->profile->date_of_birth }}' />
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <div class="form-check">
                                        <input type="radio" name="gender" class="form-check-input"
                                            @checked($user->profile->gender == 'male') value="male">
                                        <label for="gender">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" class="form-check-input"
                                            @checked($user->profile->gender == 'female') value="female">
                                        <label for="gender">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" placeholder="Enter Address">{{ $user->profile->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <x-form.input type='text' name='city' placeholder='Enter City Name'
                                        value='{{ $user->profile->city }}' />
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <x-form.input type='text' name='country' placeholder='Enter Country Name'
                                        value='{{ $user->profile->country }}' />
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
