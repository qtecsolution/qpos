@extends('backend.master')

@section('title', 'Create Unit')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.units.store') }}" method="post" class="accountForm"
      enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="mb-3 col-md-6">
            <label for="title" class="form-label">
              Title
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" placeholder="Enter title" name="title"
              value="{{ old('title') }}" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="short_name" class="form-label">
              Short Name
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" placeholder="Enter Short Name" name="short_name"
              value="{{ old('short_name') }}" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn bg-gradient-primary">Create</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('style')


@endpush
@push('script')
<script src="{{ asset('js/image-field.js') }}"></script>
@endpush