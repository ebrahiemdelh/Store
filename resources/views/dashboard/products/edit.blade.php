@extends('layout.master')
@section('title', 'Edit Product')
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                        placeholder="Enter Product Name">
                                </div>
                                <div class="form-group form-select">
                                    <label for="store_id">Store Product</label>
                                    <select class="form-control" id="store" name="store_id">
                                        <option value="">Select Store Product</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}" @selected($product->store_id == $store->id)>
                                                {{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-select">
                                    <label for="category_id">Category Product</label>
                                    <select class="form-control" id="category" name="category_id">
                                        <option value="">Select Category Product</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="compare_price">Compare Price</label>
                                    <input type="text" class="form-control" name="compare_price"
                                        value="{{ $product->compare_price }}">
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" name="tags" value="{{ $tags }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="form-check">
                                        <input type="radio" name="status" value="active" class="form-check-input"
                                            @checked($product->status == 'active')>
                                        <label for="status">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="status" value="archived" class="form-check-input"
                                            @checked($product->status == 'archived')>
                                        <label for="status">Archived</label>
                                    </div>
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
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElem = document.querySelector('input[name=tags]');
        var tagify = new Tagify(inputElem);
    </script>
@endpush
