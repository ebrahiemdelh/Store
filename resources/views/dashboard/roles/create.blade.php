@extends('layout.master')
@section('title', 'Create Role')
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
                            <h3 class="card-title">Create Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.roles._form', [
                                'button_label' => 'Create',
                                'deny_all' => true
                            ])
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                </div>
            </div>
        </section>

@endsection