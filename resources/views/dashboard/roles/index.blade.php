@extends('layout.master')
@section('title', 'Roles')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Simple Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <x-alert type='success' />
                        <x-alert type='info' />
                        <div class="card">
                            <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between my-4">
                                @csrf
                                <input type="text" name="name" placeholder="Search" class="mx-4"
                                    value="{{ request('name') }}">
                                <button type='submit' class="btn btn-dark mx-2">Filter</button>
                            </form>
                            <div class="card-header">
                                <h3 class="card-title">Responsive Hover Table</h3>
                                {{-- @can('Roles.create') --}}
                                <div class="card-tools mx-2">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <a class="btn btn-sm btn-primary" href="{{ route('dashboard.roles.create') }}">
                                            Add role
                                        </a>
                                    </div>
                                </div>
                                {{-- @endcan --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $role)
                                            <tr class="text-center">
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->created_at }}</td>
                                                <td class="d-flex justify-content-around">
                                                    {{-- @can('roles.update') --}}
                                                    <a href="{{ route('dashboard.roles.edit', $role->id) }}"
                                                        class="btn btn-sm btn-outline-success">Edit</a>
                                                    {{-- @endcan --}}
                                                        {{-- @can('roles.delete') --}}
                                                        <form action="{{ route('dashboard.roles.destroy', $role->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                        {{-- @endcan --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">No Roles Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $roles->withQueryString()->links() }}

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection