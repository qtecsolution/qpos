@extends('backend.master')

@section('title', 'Create Category')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.categories.store') }}" method="post" class="accountForm"
      enctype="multipart/form-data">
      @csrf
      <div class="card-body row">
        <div class="mb-3 col-md-6">
          <label for="title" class="form-label">
            Name
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter title" name="name"
            value="{{ old('name') }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="thumbnailInput" class="form-label">
            Image
          </label>
          <div class="image-upload-container" id="imageUploadContainer">
            <input type="file" class="form-control" name="category_image" id="thumbnailInput" accept="image/*" style="display: none;">
            <div class="thumb-preview" id="thumbPreviewContainer">
              <img src="{{ asset('backend/assets/images/blank.png') }}" alt="Thumbnail Preview"
                class="img-thumbnail d-none" id="thumbnailPreview">
              <div class="upload-text">
                <i class="fas fa-plus-circle"></i>
                <span>Upload Image</span>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3 col-md-12">
          <label for="description" class="form-label">
            Description
          </label>
          <textarea class="form-control" placeholder="Enter description" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3 col-md-12">
          <div class="form-switch">
            <input type="hidden" name="status" value="0">
            <input class="form-check-input" type="checkbox" name="status" id="active"
              value="1" checked>
            <label class="form-check-label" for="active">
              Active
            </label>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <button type="submit" class="btn btn-block bg-gradient-primary">Create</button>
    </form>
  </div>
</div>
@endsection
@push('script')
<script>
</script>
@endpush