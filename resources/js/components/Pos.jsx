import React, { Component, useEffect, useState, useCallback } from "react";
import { createRoot } from "react-dom";
import axios from "axios";
import Swal from "sweetalert2";
import Cart from "./Cart";
export default function Pos() {
    const [products, setProducts] = useState([]);
    const [carts, setCarts] = useState([]);
    const [total, setTotal] = useState(0);
    const [cartUpdated, setCartUpdated] = useState(false);
    const [searchQuery, setSearchQuery] = useState("");
    const [searchBarCode, setSearchBarCode] = useState("");
    const { protocol, hostname, port } = window.location;
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(0);
    const [loading, setLoading] = useState(false);
    const fullDomainWithPort = `${protocol}//${hostname}${
        port ? `:${port}` : ""
    }`;
    const getProducts = useCallback(
        async (search = "", page = 1) => {
            setLoading(true);
            try {
                const res = await axios.get(`get/products`, {
                    params: { search, page },
                });
                const productsData = res.data;
                setProducts((prev) => [...prev, ...productsData.data]); // Append new products
                setTotalPages(productsData.meta.last_page); // Get total pages
            } catch (error) {
                console.error("Error fetching products:", error);
            } finally {
                setLoading(false); // Set loading to false
            }
        },
        []
    );

    const getCarts = async () => {
        try {
            const res = await axios.get(`cart`);
            const data = res.data;
            setTotal(data?.total);
            setCarts(data?.carts);
        } catch (error) {
            console.error("Error fetching carts:", error);
        }
    };

    useEffect(() => {
        getCarts();
    }, []);

    useEffect(() => {
        getCarts();
    }, [cartUpdated]);

    useEffect(() => {
        if (searchQuery) {
            setProducts([]);
            setCurrentPage(1);
        }
        getProducts(searchQuery, currentPage);
    }, [getProducts, currentPage, searchQuery]);

    // Infinite scroll logic
    useEffect(() => {
        const handleScroll = () => {
            if (
                window.innerHeight + document.documentElement.scrollTop >=
                document.documentElement.offsetHeight
            ) {
                // Load next page if not on the last page
                if (currentPage < totalPages) {
                    setCurrentPage((prev) => prev + 1);
                }
            }
        };

        window.addEventListener("scroll", handleScroll);
        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, [currentPage, totalPages]);

    function addProductToCart(id) {
        axios
            .post("/admin/cart", { id })
            .then((res) => {
                console.log(res);
                setCartUpdated(!cartUpdated);
                Swal.fire("Success!", res?.data?.message, "success");
            })
            .catch((err) => {
                Swal.fire("Error!", err.response.data.message, "error");
            });
    }
    return (
        <div className="card">
            <div className="card-body p-2 p-md-4 pt-0">
                <div className="row">
                    <div className="col-md-6 col-lg-5">
                        <div className="row mb-2">
                            <div className="col-6">
                                <select className="form-control">
                                    <option>Walking Customer</option>
                                    <option>Customer 1</option>
                                    <option>Customer 2</option>
                                </select>
                            </div>
                            {/* <div className="col-6">
                                <form className="form">
                                    <input
                                        type="text"
                                        className="form-control"
                                        placeholder="Enter barcode"
                                        value={searchQuery}
                                        onChange={(e) =>
                                            setSearchQuery(e.target.value)
                                        }
                                    />
                                </form>
                            </div> */}
                        </div>
                        <Cart carts={carts} />
                        <div className="card">
                            <div className="card-body">
                                <div className="row text-bold">
                                    <div className="col">Total:</div>
                                    <div className="col text-right mr-2">
                                        {total.toFixed(2)}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col">
                                <button
                                    type="button"
                                    className="btn btn-danger btn-block"
                                >
                                    Cancel
                                </button>
                            </div>
                            <div className="col">
                                <button
                                    type="button"
                                    className="btn btn-primary btn-block"
                                >
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6 col-lg-7">
                        <div className="mb-2">
                            <input
                                type="text"
                                className="form-control"
                                placeholder="Enter Product Name or Barcode"
                                value={searchBarCode}
                                onChange={(e) =>
                                    setSearchBarCode(e.target.value)
                                } // Update state on change
                            />
                        </div>
                        <div className="row products-card-container">
                            {products.length > 0 &&
                                products.map((product) => (
                                    <div
                                        onClick={() =>
                                            addProductToCart(product.id)
                                        }
                                        className="col-sm-6 col-md-4 col-lg-3 mb-3"
                                        key={product.id}
                                    >
                                        <div className="product-item text-center">
                                            <img
                                                src={`${fullDomainWithPort}/storage/${product.image}`}
                                                alt={product.name}
                                                className="mr-2 img-thumb"
                                                onError={(e) => {
                                                    e.target.onerror = null;
                                                    e.target.src = `${fullDomainWithPort}/assets/images/no-image.png`;
                                                }}
                                                width={120}
                                                height={100}
                                            />
                                            <div className="product-details">
                                                <p className="mb-0 text-bold product-name">
                                                    {product.name} (
                                                    {product.quantity})
                                                </p>
                                                <p>
                                                    Price:{" "}
                                                    {product.price.toFixed(2)}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                        </div>
                        {loading && (
                            <div className="loading-more">Loading more...</div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
}
const root = document.getElementById("cart");
if (root) {
    const rootInstance = createRoot(root);
    rootInstance.render(<Pos />);
}
