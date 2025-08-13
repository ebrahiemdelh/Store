@extends('layout.master')
@section('title', 'Admins')
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
                                <select name="status" class="form-control mx-4">
                                    <option value="" selected>All</option>
                                    <option value="active" @selected(request('status') == 'active')>Active</option>
                                    <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                                </select>
                                <button type='submit' class="btn btn-dark mx-2">Filter</button>
                            </form>
                            <div class="card-header">
                                <h3 class="card-title">Responsive Hover Table</h3>
                                @can('create', App\Models\Admin::class)
                                    <div class="card-tools mx-2">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <a class="btn btn-sm btn-primary" href="{{ route('dashboard.admins.create') }}">
                                                Add Admin
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                                {{-- @can('delete',$admin)
                                <div class="card-tools mx-2">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <a class="btn btn-sm btn-primary" href="{{ route('dashboard.admins.trash') }}">
                                            Trash Admins
                                        </a>
                                    </div>
                                </div>
                                @endcan --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th colspan="4">Roles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admins as $admin)
                                            <tr class="text-center">
                                                <td>{{ $admin->id }}</td>
                                                <td><a
                                                        href="{{ route('dashboard.admins.show', $admin->id) }}">{{ $admin->name }}</a>
                                                </td>
                                                <td>{{ $admin->created_at }}</td>
                                                <td colspan="4">
                                                    @foreach ($admin->roles as $role)
                                                        <span class="badge badge-info">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>

                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="9">No Admins Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $admins->withQueryString()->links() }}

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