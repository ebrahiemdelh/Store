@extends('layout.master')
@section('title', 'Create Category')
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
                            <h3 class="card-title">Create Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <x-form.input type='text' name='name' value="{{$category->name ?? ''}}"/>
                                </div>
                                <div class="form-group form-select">
                                    <label for="parent_id">Parent Category</label>
                                    <select @class(['form-control', 'is-invalid' => $errors->has('parent_id')]) id="parent" name="parent_id">
                                        <option value="" selected disabled>Select Parent Category</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>
                                                {{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" @class(['custom-file-input', 'is-invalid' => $errors->has('image')]) id="image"
                                                name="image">
                                            <label class="custom-file-label"
                                                for="image">{{ old('image', 'Choose file') }}</label>
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
                                            @checked(old('status') == 'active')>
                                        <label for="status">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="status" value="archived" class="form-check-input"
                                            @checked(old('status') == 'archived')>
                                        <label for="status">Archived</label>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
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
