@extends('backend.master')

@section('title', 'Update Unit')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.units.update',$unit->id) }}" method="post" class="accountForm"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body row">
        <div class="mb-3 col-md-6">
          <label for="title" class="form-label">
            Title
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter title" name="title"
            value="{{ old('title',$unit->title) }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="short_name" class="form-label">
            Short Name
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter Short Name" name="short_name"
            value="{{ old('short_name',$unit->short_name) }}" required>
        </div>
      </div>
      <!-- /.card-body -->
      <button type="submit" class="btn btn-block bg-gradient-primary">Update</button>
    </form>
  </div>
</div>
@endsection
@push('script')
<script src="{{ asset('js/image-field.js') }}"></script>
@endpush