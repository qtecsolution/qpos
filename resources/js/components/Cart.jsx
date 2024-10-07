import React, { useState, useEffect } from "react";

export default function Cart({ carts }) {
    return (
        <div className="user-cart">
            <div className="card">
                <div className="card-body">
                    <div className="responsive-table">
                        <table className="table table-striped">
                            <thead>
                                <tr className="text-center">
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th></th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                {carts.map((item) => (
                                    <tr key={item.id}>
                                        <td>{item.product.name}</td>
                                        <td className="d-flex align-items-center">
                                            <button className="btn btn-warning btn-sm">
                                                <i className="fas fa-minus"></i>
                                            </button>
                                            <input
                                                type="number"
                                                className="form-control form-control-sm qty ml-1 mr-1"
                                                value={item.quantity}
                                            />
                                            <button className="btn btn-success btn-sm">
                                                <i className="fas fa-plus "></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button className="btn btn-danger btn-sm mr-3">
                                                <i className="fas fa-trash "></i>
                                            </button>
                                        </td>
                                        <td className="text-right">
                                            {item.row_total.toFixed(2)}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
}
