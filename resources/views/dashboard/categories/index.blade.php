@extends('layout.master')
@section('title', 'Categories')
@if (Route::currentRouteName() == 'dashboard.categories.trash')
    @section('title', 'Trash Categories')
@endif
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
                            @if (Route::currentRouteName() == 'dashboard.categories.trash')
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('dashboard.categories.index') }}">Categories</a>
                                </li>
                            @endif
                            @if (Route::currentRouteName() == 'dashboard.categories.index')
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.trash') }}">Trash
                                        Categories</a></li>
                            @endif
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
                                @if (Route::currentRouteName() == 'dashboard.categories.index')
                                @can('create', App\Models\Category::class)
                                    <div class="card-tools mx-2">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('dashboard.categories.create') }}">
                                                Add Category
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                                @can('delete', App\Models\Category::class)
                                <div class="card-tools mx-2">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <a class="btn btn-sm btn-primary"
                                        href="{{ route('dashboard.categories.trash') }}">
                                        Trash Categories
                                        </a>
                                    </div>
                                </div>
                                @endcan
                                @endif
                                @if (Route::currentRouteName() == 'dashboard.categories.trash')
                                    <div class="card-tools mx-2">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('dashboard.categories.index') }}">
                                                Categories
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Image</th>
                                            <th>ID</th>
                                            <th>Parent</th>
                                            <th>Name</th>
                                            <th>No. Active Products</th>
                                            @if (Route::currentRouteName() == 'dashboard.categories.trash')
                                            <th>Deleted At</th>@else<th>Created At</th>
                                            @endif
                                            <th>Status</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr class="text-center">
                                                <td><img src="{{ $category->image }}" style="width:100px"></td>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->parent->name }}</td>
                                                <td><a
                                                        href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a>
                                                </td>
                                                <td>{{ $category->products_count }}</td>
                                                @if (Route::currentRouteName() == 'dashboard.categories.trash')
                                                <td>{{ $category->deleted_at }}</td>@else<td>
                                                        {{ $category->created_at }}</td>
                                                @endif
                                                <td>{{ $category->status }}</td>
                                                {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                                                <td class="d-flex justify-content-around">
                                                    @can('update', $category)
                                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-outline-success">Edit</a>
                                                    @endcan
                                                    @if ($category->deleted_at != null)
                                                        <form
                                                            action="{{ route('dashboard.categories.restore', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-primary">Restore</button>
                                                        </form>
                                                        @can('delete', $category)
                                                            <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
                                                            </form>
                                                        @endcan
                                                    @else
                                                        @can('delete', $category)
                                                        <form
                                                            action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr class="text-center">
                                                <td colspan="9">No Categories Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $categories->withQueryString()->links() }}

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
