import React from 'react'
export default function Purchase() {
  return (
  <div className="container-fluid">
    <div className="card">
      <div className="card-body">
        <div className="row">
          <div className="mb-3 col-md-6">
            <label for="title" className="form-label">
              Purchase Date
              <span className="text-danger">*</span>
            </label>
            <input type="date" className="form-control" placeholder="Enter date" name="date"
              value="" required/>
          </div>
          <div className="mb-3 col-md-6">
            <label for="sku" className="form-label">
              Supplier
              <span className="text-danger">*</span>
            </label>
            <input type="text" className="form-control" placeholder="Enter discount" name="discount"
              value="" required/>
          </div>
        </div>
      </div>
    </div>
    <div className="card">
      <div className="card-body">
        <div className="row mb-2">
          <div className="input-group col-6">
            <div className="input-group-prepend">
              <span className="input-group-text">
                <i className="fas fa-search"></i>
              </span>
            </div>
            <input type="search" className="form-control form-control-lg" name="search" id="search" placeholder="Search Product Barcode/Name"/>
          </div>
        </div>
        <div className="row">
          <div className="col-12">
            <table className="table table-sm table-bordered text-center">
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
                  <td className="d-flex align-items-center justify-content-center">
                    <input
                      className="form-control form-control-sm w-25" value="500"/>
                  </td>
                  <td>12</td>
                  <td className="d-flex align-items-center justify-content-center">
                    <input min="0" className="form-control form-control-sm w-25" value="12"/>
                  </td>
                  <td>1200</td>
                  <td>Action</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mac Mini</td>
                  <td className="d-flex align-items-center justify-content-center">
                    <input
                      className="form-control form-control-sm w-25" value="500"/>
                  </td>
                  <td>12</td>
                  <td className="d-flex align-item-center justify-content-center">
                    <input min="0" className="form-control form-control-sm w-25" value="12"/>
                  </td>
                  <td>1200</td>
                  <td>Action</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div className="row">
          <div className="col-6">
          </div>
          <div className="col-6">
            <div className="table-responsive">
              <table className="table table-sm">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td className="text-right">500</td>
                </tr>
                <tr>
                  <th>Tax:</th>
                  <td className="text-right">50</td>
                </tr>
                <tr>
                  <th>Discount:</th>
                  <td className="text-right">100</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td className="text-right">100</td>
                </tr>
                <tr>
                  <th>Grand Total:</th>
                  <td className="text-right">450</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div className="card">
      <div className="card-body">
        <div className="row">
          <div className="mb-3 col-md-4">
            <label for="title" className="form-label">
              Tax
              <span className="text-danger">*</span>
            </label>
            <input type="text" className="form-control" placeholder="Enter tax" name="tax"
              value="" required/>
          </div>
          <div className="mb-3 col-md-4">
            <label for="sku" className="form-label">
              Discount
              <span className="text-danger">*</span>
            </label>
            <input type="text" className="form-control" placeholder="Enter discount" name="discount"
              value="" required/>
          </div>
          <div className="mb-3 col-md-4">
            <label for="sku" className="form-label">
              Shipping Charge
              <span className="text-danger">*</span>
            </label>
            <input type="text" className="form-control" placeholder="Enter shipping" name="shipping"
              value="" required/>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" className="btn btn-md bg-gradient-primary">Create</button>
  </div>
  )
}
