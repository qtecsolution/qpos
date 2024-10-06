@extends('backend.master')

@section('title', 'Create Product')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.products.store') }}" method="post" class="accountForm"
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
          <label for="sku" class="form-label">
            Sku
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" placeholder="Enter sku" name="sku"
            value="{{ old('sku') }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="brand_id" class="form-label">
            Brand
            <span class="text-danger">*</span>
          </label>
          <select class="form-control select2" style="width: 100%;" name="brand_id" required>
            <option value="">Select Brand</option>
            @foreach ($brands as $item)
            <option value={{ $item->id }}
              {{ old('brand_id') == $item->id ? 'selected' : '' }}>
              {{ $item->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3 col-md-6">
          <label for="category_id" class="form-label">
            Category
            <span class="text-danger">*</span>
          </label>
          <select class="form-control select2" style="width: 100%;" name="category_id" required>
            <option value="">Select Category</option>
            @foreach ($categories as $item)
            <option value={{ $item->id }}
              {{ old('category_id') == $item->id ? 'selected' : '' }}>
              {{ $item->name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3 col-md-6">
          <label for="price" class="form-label">
            Price
            <span class="text-danger">*</span>
          </label>
          <input type="number" step="0.01" min="0" class="form-control"
            placeholder="Enter price" name="price" value="{{ old('price') }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="quantity" class="form-label">
            Initial Stock
            <span class="text-danger">*</span>
          </label>
          <input type="number" class="form-control" placeholder="Enter quantity" name="quantity"
            value="{{ old('quantity') }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="discount_type" class="form-label">
            Discount Type
          </label>
          <select class="form-control form-select" name="discount_type">
            <option value="">Select Discount Type</option>
            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>
              Fixed
            </option>
            <option value="percentage"
              {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>
              Percentage
            </option>
          </select>
        </div>
        <div class="mb-3 col-md-6">
          <label for="purchase_price" class="form-label">
            Purchase Price
            <span class="text-danger">*</span>
          </label>
          <input type="number" step="0.01" min="0" class="form-control"
            placeholder="Enter purchase Price" name="purchase_price" value="{{ old('purchase_price') }}" required>
        </div>
        <div class="mb-3 col-md-6">
          <label for="discount_value" class="form-label">
            Discount Amount
          </label>
          <input type="number" step="0.01" min="0" class="form-control"
            placeholder="Enter discount" name="discount" value="{{ old('discount') }}">
        </div>
        <div class="mb-3">
          <label for="thumbnailInput" class="form-label">
            Image
            <span class="text-danger">*</span>
          </label>
          <input type="file" class="form-control" name="product_image" required id="thumbnailInput">
          <div class="thumb-preview">
            <img src="{{ asset('backend/assets/images/blank.png') }}" alt="Thumbnail Preview"
              class="img-thumbnail d-none" id="thumbnailPreview">
          </div>
          <script>
            document.getElementById('thumbnailInput').addEventListener('change', function() {
              const reader = new FileReader();
              reader.addEventListener('load', function() {
                const img = document.getElementById('thumbnailPreview');
                img.src = reader.result;
                img.classList.remove('d-none');
              });
              reader.readAsDataURL(this.files[0]);
            });
          </script>
        </div>

        <div class="mb-3 col-md-12">
          <label for="description" class="form-label">
            Description
            <span class="text-danger">*</span>
          </label>
          <textarea class="form-control" placeholder="Enter description" name="description" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3 col-md-6">
          <label for="expire_date" class="form-label">
            Expire date
          </label>
          <input type="date" class="form-control"
            placeholder="Enter product expire date" name="expire_date" value="{{ old('expire_date') }}">
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