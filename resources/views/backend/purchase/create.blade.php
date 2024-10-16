@extends('backend.master')

@section('title', 'Create Customer')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.customers.store') }}" method="post" class="accountForm"
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
          <label for="title" class="form-label">
            Phone
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter phone" name="phone"
            value="{{ old('phone') }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="title" class="form-label">
            Address
          </label>
          <input type="text" class="form-control" placeholder="Enter Address" name="address"
            value="{{ old('Address') }}">
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