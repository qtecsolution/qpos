@extends('backend.master')

@section('title', 'Create New Blog Category')

@section('content')

    <div class="card">
        <!-- form start -->
        <form action="{{ route('backend.admin.create.blog.category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title">
                        Category Title
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" placeholder="Enter title" name="title"
                        value="{{ old('title') }}" required>
                </div>
                {{-- description --}}
                <div class="form-group">
                    <label for="description">
                        Description
                    </label>
                    <textarea class="form-control" placeholder="Enter description" name="description" cols="30"
                        rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="col-4">
                    <p></p>
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="publish" name="status" checked>
                            <label class="custom-control-label" for="publish">
                                Publish
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-block bg-gradient-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
