import React, { useState, useEffect } from "react";

export default function Cart() {
const [carts, setCart] = useState([])
  return (
      <div className="user-cart">
          <div className="card">
              <div className="card-body">
                  <table className="table table-striped">
                      <thead>
                          <tr className="text-center">
                              <th>Name</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Product1</td>
                              <td className="d-flex align-items-center">
                                  <button className="btn btn-warning btn-sm">
                                      <i className="fas fa-minus"></i>
                                  </button>
                                  <input
                                      type="text"
                                      className="form-control form-control-sm qty ml-1 mr-1"
                                      value="5"
                                  />
                                  <button className="btn btn-success btn-sm">
                                      <i className="fas fa-plus "></i>
                                  </button>
                              </td>
                              <td className="text-right">500</td>
                              <td>
                                  {" "}
                                  <button className="btn btn-danger btn-sm mr-3">
                                      <i className="fas fa-trash "></i>
                                  </button>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  );
}
