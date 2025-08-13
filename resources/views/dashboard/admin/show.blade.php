@extends('layout.master')
@section('title', $admin->name)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Admins</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">Admins</a>
                            <li class="breadcrumb-item active"><a href="#">{{ $admin->name }}</a></li>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-7">
                        <x-alert type='success' />
                        <x-alert type='info' />
                        <form action="{{ route('dashboard.admins.update', $admin->id) }}" method="POST">
                            @csrf
                            @include('dashboard.admin._form', ['button_label' => 'Update', 'title' => 'Update Admin'])
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection