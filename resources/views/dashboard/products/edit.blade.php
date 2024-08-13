@extends('layout.master')
@section('title', 'Edit Category')
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
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('categories.update', $category->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}"
                                        placeholder="Enter Category Name">
                                </div>
                                <div class="form-group form-select">
                                    <label for="parent_id">Parent Category</label>
                                    <select class="form-control" id="parent" name="parent_id">
                                        <option value="">Select Parent Category</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>
                                                {{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description">{{ $category->description }}</textarea>
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
                                            @checked($category->status == 'active')>
                                        <label for="status">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="status" value="archived" class="form-check-input"
                                            @checked($category->status == 'archived')>
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
