@extends('backend.master')

@section('title', 'Update Currency')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.currencies.update',$currency->id) }}" method="post" class="accountForm"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body row">
        <div class="mb-3 col-md-6">
          <label for="name" class="form-label">
            Name
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter name" name="name"
            value="{{ old('name',$currency->name) }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="code" class="form-label">
            Code
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter Short cod" name="code"
            value="{{ old('code',$currency->code) }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="symbol" class="form-label">
            Symbol
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter symbol" name="symbol"
            value="{{ old('symbol',$currency->symbol) }}" required>
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