@extends('backend.master')

@section('title', 'Products')

@section('content')
<div class="card">
  <div class="mt-n5 mb-3 d-flex justify-content-end">
    <a href="{{ route('backend.admin.products.create') }}" class="btn bg-gradient-primary">
      <i class="fas fa-plus-circle"></i>
      Add New
    </a>
  </div>
  <div class="card-body p-2 p-md-4 pt-0">
    <div class="row g-4">
      <div class="col-md-12">
        <div class="card-body table-responsive p-0" id="table_data">
          <table id="datatables" class="table table-hover">
            <thead>
              <tr>
                <th data-orderable="false">#</th>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created</th>
                <th>Status</th>
                <th data-orderable="false">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $index => $product)
              <tr>
                <td>{{ $index + 1  + ($products->perPage() * ($products->currentPage() - 1))}}</td>
                <td>
                  <img
                    src="{{ asset('storage/' . $product->image) }}"
                    loading="lazy"
                    alt="{{ $product->name }}"
                    class="img-thumb img-fluid"
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}'"
                    height="80"
                    width="60" />

                </td>
                <td>{{ $product->name }}</td>
                <td>
                  {{ number_format($product->discounted_price,2,'.',',') }}
                  @if ($product->price>$product->discounted_price)
                  <br>
                  <del>{{ $product->price }}</del>
                  @endif
                </td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                  @if($product->status)
                  <span class="badge bg-primary">Active</span>
                  @else
                  <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn bg-gradient-primary btn-flat">Action</button>
                    <button type="button" class="btn bg-gradient-primary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="{{ route('backend.admin.products.edit', $product->id) }}">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <div class="dropdown-divider"></div>
                      <form action="{{ route('backend.admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="dropdown-item" onclick="return confirm('Are you sure ?')"><i class="fas fa-trash"></i> Delete</button>
                      </form>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="">
                        <i class="fas fa-cart-plus"></i> Purchase
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">No products found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <!-- Pagination Links -->
          <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@endpush