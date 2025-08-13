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
                        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="p-4">
                                <x-form.input element="Category" name="name" :value="$category->name" />
                                <x-form.select element="Parent" name="parent_id" :value="$parents" />
                                <x-form.textarea :data="$category->description" />
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
    </section>

@endsection
