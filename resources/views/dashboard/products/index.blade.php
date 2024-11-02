@extends('layout.master')
@if (Route::currentRouteName() == 'dashboard.products.trash')
    @section('title', 'Trash Products')
@elseif (Route::currentRouteName() == 'dashboard.products.index')
    @section('title', 'Products')
@endif('title', 'Products')
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
                            @if (Route::currentRouteName() == 'dashboard.products.index')
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.trash') }}">Trash
                                        Products</a>
                                </li>
                            @elseif (Route::currentRouteName() == 'dashboard.products.trash')
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('dashboard.products.index') }}">Products</a></li>
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
                                <x-form.input name="name" placeholder="Search With Name" class="mx-4"
                                    value="{{ request('name') }}" />
                                <x-form.input name="store" placeholder="Search With Store Id" class="mx-4"
                                    value="{{ request('store') }}" />
                                <x-form.input name="category" placeholder="Search With Category Id" class="mx-4"
                                    value="{{ request('category') }}" />
                                <select name="status" class="form-control mx-4">
                                    <option value="" selected>All</option>
                                    <option value="active"@selected(request('status') == 'active')>Active</option>
                                    <option value="archived"@selected(request('status') == 'archived')>Archived</option>
                                    <option value="draft"@selected(request('status') == 'draft')>Draft</option>
                                </select>
                                <button type='submit'class="btn btn-dark mx-2">Filter</button>
                            </form>
                            <div class="card-header">
                                <h3 class="card-title">Responsive Hover Table</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <a class="btn btn-sm btn-primary" href="{{ route('dashboard.products.create') }}">
                                            Add Product
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Store Name</th>
                                            <th>Category Name</th>
                                            @if (Route::currentRouteName() == 'dashboard.products.index')
                                                <th>Created At</th>
                                            @elseif(Route::currentRouteName() == 'dashboard.products.trash')
                                                <th>Deleted At</th>
                                            @endif
                                            <th>Status</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr class="text-center">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->store->name ?? '' }}</td>
                                                <td>{{ $product->category->name ?? '' }}</td>
                                                @if (Route::currentRouteName() == 'dashboard.products.index')
                                                    <td>{{ $product->created_at }}</td>
                                                @elseif(Route::currentRouteName() == 'dashboard.products.trash')
                                                    <td>{{ $product->deleted_at }}</td>
                                                @endif
                                                <td>{{ $product->status }}</td>
                                                <td class="d-flex justify-content-around">
                                                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-outline-success">Edit</a>
                                                    @if (Route::currentRouteName() == 'dashboard.products.index')
                                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                    @elseif (Route::currentRouteName() == 'product.trash')
                                                        <form action="{{ route('dashboard.products.restore', $product->id) }}"
                                                            method="post">
                                                            @csrf @method('put')
                                                            <button type="submit"
                                                                class="btn btn-sm btm-outline-primary">Restore</button>
                                                        </form>
                                                        <form action="{{ route('dashboard.products.force-delete', $product->id) }}"
                                                            method="post">
                                                            @csrf @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-sm btm-outline-danger">Force Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="9">No Products Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $products->withQueryString()->links() }}
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
