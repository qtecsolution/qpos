@extends('backend.master')

@section('title', 'Create Customer')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.customers.update',$customer->id) }}" method="post" class="accountForm"
      enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="card-body row">
        <div class="mb-3 col-md-6">
          <label for="title" class="form-label">
            Name
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter title" name="name"
            value="{{ $customer->name }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="title" class="form-label">
            Phone
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter phone" name="phone"
            value="{{ $customer->phone }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="title" class="form-label">
            Address
          </label>
          <input type="text" class="form-control" placeholder="Enter Address" name="address"
            value="{{ $customer->address }}">
        </div>
      </div>
      <!-- /.card-body -->
      <button type="submit" class="btn btn-block bg-gradient-primary">Update</button>
    </form>
  </div>
</div>
@endsection
@push('script')
<script>
</script>
@endpush