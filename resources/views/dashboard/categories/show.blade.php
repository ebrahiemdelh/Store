@extends('layout.master')
@section('title', $category->name)
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
                            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a>
                            <li class="breadcrumb-item active"><a href="#">{{ $category->name }}</a></li>
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
                    <div class="col-12">
                        <x-alert type='success' />
                        <x-alert type='info' />
                        <div class="card">
                            {{-- <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between my-4">
                                @csrf
                                <x-form.input name="name" placeholder="Search" class="mx-4"
                                    value="{{ request('name') }}" />
                                <select name="status" class="form-control mx-4">
                                    <option value="" selected>All</option>
                                    <option value="active"@selected(request('status') == 'active')>Active</option>
                                    <option value="archived"@selected(request('status') == 'archived')>Archived</option>
                                </select>
                                <button type='submit'class="btn btn-dark mx-2">Filter</button>
                            </form> --}}
                            <div class="card-header">
                                <h3 class="card-title">Responsive Hover Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th></th>
                                            <th>Name</th>
                                            <th>Store</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($category->products as $product)
                                            <tr class="text-center">
                                                <td><img src="{{ $product->image }}" style="width:100px"></td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->store_id }}</td>
                                                <td>{{ $product->status }}</td>
                                                <td>{{ $product->created_at }}</td>
                                                {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="5">No Products Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- {{ $category->withQueryString()->links() }} --}}

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
