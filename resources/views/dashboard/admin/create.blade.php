@extends('layout.master')
@section('title', 'Create Admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">Admins</a></li>
                            <li class="breadcrumb-item active"><a href="#">Create Admin</a></li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-first">
                    <!-- left column -->
                    <!-- general form elements -->
                    <div class="col-md-7">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <x-alert type='success' />
                                <x-alert type='info' />
                                <form action="{{ route('dashboard.admins.create') }}" method="POST">
                                    @csrf
                                    @include('dashboard.admin._form', ['button_label' => 'Create', 'title' => 'Create Admin'])
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection