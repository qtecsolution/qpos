import React, { useCallback, useState } from "react";
import Suppliers from "./Suppliers";
import axios from "axios";
import Swal from "sweetalert2";
import toast, { Toaster } from "react-hot-toast";

export default function Purchase() {
    const [searchTerm, setSearchTerm] = useState("");
    const [supplierId, setSupplierId] = useState(null);
    const [tax, setTax] = useState(0);
    const [discount, setDiscount] = useState(0);
    const [shipping, setShipping] = useState(0);
    const [products, setProducts] = useState([]);

    const getProducts = useCallback(async () => {
        if (!searchTerm.trim()) {
            console.log("Search term is empty");
            return;
        }

        // Optional: Uncomment if you want to show loading state
        // setLoading(true);

        try {
            const res = await axios.get("/admin/products", {
                params: { search: searchTerm },
            });

            const productsData = res.data;

            // Ensure productsData and productsData.data exist
            if (productsData?.data && productsData.data.length) {
                productsData.data.forEach((product) => {
                    const existingProductIndex = products.findIndex(
                        (p) => p.id === product.id
                    );
                    if (existingProductIndex !== -1) {
                        // Product exists, increment qty
                        setProducts((prevProducts) => {
                            const updatedProducts = [...prevProducts];
                            updatedProducts[existingProductIndex].qty += 1; // Increment qty
                            updatedProducts[existingProductIndex].subTotal =
                                updatedProducts[existingProductIndex]
                                    .purchasePrice *
                                updatedProducts[existingProductIndex].qty; // Update subTotal
                            return updatedProducts;
                        });
                    } else {
                        // New product, add to the list
                        const newProduct = {
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            purchase_price: product.purchase_price,
                            stock: product.quantity,
                            qty: 1,
                            subTotal: product.purchase_price,
                        };
                        setProducts((prevProducts) => [
                            ...prevProducts,
                            newProduct,
                        ]);
                    }
                });
            }
        } catch (error) {
            console.error("Error fetching products:", error);
        } finally {
            // Optional: Uncomment if you want to hide loading state
            // setLoading(false);

            // Clear searchTerm if needed
            setSearchTerm("");
        }
    }, [searchTerm]); // Don't forget to add searchTerm as a dependency

    // Handle deletion of a product
    const handleDelete = (id) => {
        setProducts(products.filter((product) => product.id !== id));
    };

    // Update quantity and recalculate subtotal
    const handleQtyChange = (id, value) => {
        const updatedProducts = products.map((product) => {
            if (product.id === id) {
                const newQty = parseInt(value) || 0;
                return {
                    ...product,
                    qty: newQty,
                    subTotal: parseFloat(
                        (product.purchasePrice * newQty).toFixed(2)
                    ),
                };
            }
            return product;
        });
        setProducts(updatedProducts);
    };

    // Update purchase price and recalculate subtotal
    const handlePriceChange = (id, value) => {
        const updatedProducts = products.map((product) => {
            if (product.id === id) {
                const newPrice = parseFloat(value) || 0;
                return {
                    ...product,
                    purchasePrice: newPrice,
                    subTotal: parseFloat((product.qty * newPrice).toFixed(2)),
                };
            }
            return product;
        });
        setProducts(updatedProducts);
    };
    // Add a new product by searching
    const handleSearchAdd = () => {
        getProducts();
    };

    // Calculate totals with two decimal places
    const calculateTotals = () => {
        const subTotal = products.reduce(
            (sum, product) => sum + product.subTotal,
            0
        );
        const formattedSubTotal = parseFloat(subTotal.toFixed(2));
        const formattedTax = parseFloat(tax.toFixed(2));
        const formattedDiscount = parseFloat(discount.toFixed(2));
        const formattedShipping = parseFloat(shipping.toFixed(2));
        const grandTotal = parseFloat(
            (
                formattedSubTotal +
                formattedTax -
                formattedDiscount +
                formattedShipping
            ).toFixed(2)
        );

        return {
            subTotal: formattedSubTotal,
            tax: formattedTax,
            discount: formattedDiscount,
            shipping: formattedShipping,
            grandTotal,
        };
    };

    const totals = calculateTotals();
    const handleSubmit = async () => {
       if (totals.grandTotal <= 0) {
        //    toast.error("Total must be greater than zero.");
           return;
       }
       if (!supplierId) {
           toast.error("Please select a supplier.");
           return;
       }

       // Show confirmation dialog
       Swal.fire({
           title: `Are you sure you want to create this purchase?`,
           showDenyButton: true,
           confirmButtonText: "Yes",
           denyButtonText: "No",
           customClass: {
               actions: "my-actions",
               cancelButton: "order-1 right-gap",
               confirmButton: "order-2",
               denyButton: "order-3",
           },
       }).then(async (result) => {
           if (result.isConfirmed) {
            //    console.log("data:", {
            //        products,
            //        supplierId,
            //        totals,
            //    }); return;
               try {
                   const res = await axios.post("/admin/purchase", {
                       products,
                       supplierId,
                       totals,
                   });
                   setProducts([]);
                   toast.success(res?.data?.message);
                   window.location.href = "/admin/purchase";
               } catch (err) {
                   toast.error(
                       err.response?.data?.message || "An error occurred"
                   );
               }
           }
       });
   };
    return (
        <>
            <div className="container-fluid">
                <div className="card">
                    <div className="card-body">
                        <div className="row">
                            <div className="mb-3 col-md-6">
                                <label htmlFor="date" className="form-label">
                                    Purchase Date
                                    <span className="text-danger">*</span>
                                </label>
                                <input
                                    type="date"
                                    className="form-control"
                                    placeholder="Enter date"
                                    name="date"
                                    required
                                />
                            </div>
                            <div className="mb-3 col-md-6">
                                <label
                                    htmlFor="supplier"
                                    className="form-label"
                                >
                                    Supplier
                                    <span className="text-danger">*</span>
                                </label>
                                <Suppliers setSupplierId={setSupplierId} />
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
                                <input
                                    type="search"
                                    className="form-control form-control-lg"
                                    value={searchTerm}
                                    onChange={(e) =>
                                        setSearchTerm(e.target.value)
                                    }
                                    placeholder="Enter product barcode/name"
                                />
                                <button
                                    className="btn bg-gradient-primary ml-2"
                                    onClick={handleSearchAdd}
                                >
                                    Add Product
                                </button>
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
                                        {products.map((product, index) => (
                                            <tr key={product.id}>
                                                <td>{index + 1}</td>
                                                <td>{product.name}</td>
                                                <td>
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        min="0"
                                                        className="form-control form-control-sm"
                                                        value={
                                                            product.purchasePrice
                                                        }
                                                        onChange={(e) =>
                                                            handlePriceChange(
                                                                product.id,
                                                                e.target.value
                                                            )
                                                        }
                                                    />
                                                </td>
                                                <td>{product.stock}</td>
                                                <td>
                                                    <input
                                                        type="number"
                                                        min="0"
                                                        className="form-control form-control-sm"
                                                        value={product.qty}
                                                        onChange={(e) =>
                                                            handleQtyChange(
                                                                product.id,
                                                                e.target.value
                                                            )
                                                        }
                                                    />
                                                </td>
                                                <td>
                                                    {product.subTotal.toFixed(
                                                        2
                                                    )}
                                                </td>
                                                <td>
                                                    <button
                                                        className="btn btn-danger btn-sm"
                                                        onClick={() =>
                                                            handleDelete(
                                                                product.id
                                                            )
                                                        }
                                                    >
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-6"></div>
                            <div className="col-6">
                                <div className="table-responsive">
                                    <table className="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td className="text-right">
                                                    {totals.subTotal.toFixed(2)}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tax:</th>
                                                <td className="text-right">
                                                    {totals.tax.toFixed(2)}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td className="text-right">
                                                    {totals.discount.toFixed(2)}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td className="text-right">
                                                    {totals.shipping.toFixed(2)}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total:</th>
                                                <td className="text-right">
                                                    {totals.grandTotal.toFixed(
                                                        2
                                                    )}
                                                </td>
                                            </tr>
                                        </tbody>
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
                                <label htmlFor="tax" className="form-label">
                                    Tax
                                    <span className="text-danger">*</span>
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    className="form-control"
                                    value={tax}
                                    onChange={(e) =>
                                        setTax(parseFloat(e.target.value) || 0)
                                    }
                                    placeholder="Enter tax"
                                    name="tax"
                                    required
                                />
                            </div>
                            <div className="mb-3 col-md-4">
                                <label
                                    htmlFor="discount"
                                    className="form-label"
                                >
                                    Discount
                                    <span className="text-danger">*</span>
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    className="form-control"
                                    value={discount}
                                    onChange={(e) =>
                                        setDiscount(
                                            parseFloat(e.target.value) || 0
                                        )
                                    }
                                    placeholder="Enter discount"
                                    name="discount"
                                    required
                                />
                            </div>
                            <div className="mb-3 col-md-4">
                                <label
                                    htmlFor="shipping"
                                    className="form-label"
                                >
                                    Shipping Charge
                                    <span className="text-danger">*</span>
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    className="form-control"
                                    value={shipping}
                                    onChange={(e) =>
                                        setShipping(
                                            parseFloat(e.target.value) || 0
                                        )
                                    }
                                    placeholder="Enter shipping"
                                    name="shipping"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    className="btn btn-md bg-gradient-primary"
                    onClick={handleSubmit}
                >
                    Create
                </button>
            </div>

            <Toaster position="top-right" reverseOrder={false} />
        </>
    );
}
