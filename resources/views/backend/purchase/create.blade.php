@extends('backend.master')

@section('title', 'Product Purchase')

@section('content')
<section class="content-header">

  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="mb-3 col-md-6">
            <label for="title" class="form-label">
              Purchase Date
              <span class="text-danger">*</span>
            </label>
            <input type="date" class="form-control" placeholder="Enter date" name="date"
              value="" required />
          </div>
          <div class="mb-3 col-md-6">
            <label for="sku" class="form-label">
              Supplier
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" placeholder="Enter discount" name="discount"
              value="" required />
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="input-group col-6">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-search"></i>
              </span>
            </div>
            <input type="search" class="form-control form-control-lg" name="search" id="search" placeholder="Search Product Barcode/Name" />
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <table class="table table-sm table-bordered text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
                  <th>Purchase Price</th>
                  <th>Current Stock</th>
                  <th>Qty</th>
                  <th>Sub Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mac Mini</td>
                  <td class="d-flex align-items-center justify-content-center">
                    <input
                      class="form-control form-control-sm w-25" value="500" />
                  </td>
                  <td>12</td>
                  <td class="d-flex align-items-center justify-content-center">
                    <input min="0" class="form-control form-control-sm w-25" value="12" />
                  </td>
                  <td>1200</td>
                  <td>Action</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mac Mini</td>
                  <td class="d-flex align-items-center justify-content-center">
                    <input
                      class="form-control form-control-sm w-25" value="500" />
                  </td>
                  <td>12</td>
                  <td class="d-flex align-item-center justify-content-center">
                    <input min="0" class="form-control form-control-sm w-25" value="12" />
                  </td>
                  <td>1200</td>
                  <td>Action</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          </div>
          <div class="col-6">
            <div class="table-responsive">
              <table class="table table-sm">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td class="text-right">500</td>
                </tr>
                <tr>
                  <th>Tax:</th>
                  <td class="text-right">50</td>
                </tr>
                <tr>
                  <th>Discount:</th>
                  <td class="text-right">100</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td class="text-right">100</td>
                </tr>
                <tr>
                  <th>Grand Total:</th>
                  <td class="text-right">450</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="mb-3 col-md-4">
            <label for="title" class="form-label">
              Tax
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" placeholder="Enter tax" name="tax"
              value="" required />
          </div>
          <div class="mb-3 col-md-4">
            <label for="sku" class="form-label">
              Discount
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" placeholder="Enter discount" name="discount"
              value="" required />
          </div>
          <div class="mb-3 col-md-4">
            <label for="sku" class="form-label">
              Shipping Charge
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" placeholder="Enter shipping" name="shipping"
              value="" required />
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-md bg-gradient-primary">Create</button>
  </div>
</section>
@endsection
@push('script')
<script>
</script>
@endpush