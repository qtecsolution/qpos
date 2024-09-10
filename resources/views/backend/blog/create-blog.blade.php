@extends('backend.master')

@section('title', 'Create New Blog')

@section('content')
    <!-- card -->
    <div class="card">
        <!-- form start -->
        <form action="{{ route('backend.admin.create.blog') }}" method="post" enctype="multipart/form-data"
            id="create-blog-form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title">
                        Blog Title
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" placeholder="Enter title" name="title"
                        value="{{ old('title') }}" required>
                </div>
                {{-- description --}}
                <div class="form-group">
                    <label for="short-description">
                        Short Description
                        <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" placeholder="Enter short description" name="short_description" required cols="30"
                        rows="4">{{ old('short_description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">
                        Long Description
                        <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control summerNote" placeholder="Enter long description" name="long_description" cols="30"
                        rows="10" id="description">{{ old('long_description') }}</textarea>
                    <p class="text-danger d-none" id="description-error">
                        * description field is required
                    </p>
                </div>
                <div class="form-group">
                    <label for="thumbnail">
                        Thumbnail
                        <span class="text-danger">*</span>
                    </label>
                    <input type="file" class="form-control" name="thumbnail" required>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="category">
                            Category
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" name="category_id" required>
                            <option value="">-- Select --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="main-features">
                            Meta Tags
                        </label>
                        <input type="text" class="form-control" placeholder="SPA,Hosting, ..." name="meta_tags"
                            value="{{ old('meta_tags') }}">
                        <small class="form-text text-muted">Enter values separated by commas.</small>
                    </div>
                    <div class="form-group col-2">
                        <p class="py-2"></p>
                        <div class="py-1 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="publish" name="status" checked>
                            <label class="custom-control-label" for="publish">
                                Publish
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="live-link">Meta Description</label>
                    <textarea class="form-control" name="meta_description" placeholder="Enter meta description ..." cols="30"
                        rows="2">{{ old('meta_description') }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-block bg-gradient-primary">Create</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@push('script')
    <script>
        document
            .getElementById("create-blog-form")
            .addEventListener("submit", function(event) {
                var contentValue = document.getElementById("description").value;

                if (contentValue.trim() === "") {
                    event.preventDefault();

                    // Throw an exception or display an error message
                    document.getElementById("description-error").classList.remove("d-none");
                }
            });
    </script>
@endpush
