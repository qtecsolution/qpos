@extends('backend.master')
@section('title', 'Pos')
@section('content')
<div id="cart"></div>
@push('style')
<style>
    .products-card-container {
        max-height: 400px;
        /* Set a fixed height for the container */
        overflow-y: auto;
        /* Enable vertical scrolling */
        overflow-x: hidden;
        /* Hide horizontal scrolling */
        border: 1px solid #ddd;
        /* Optional: add a border for better visibility */
        padding: 10px;
        /* Optional: add some padding */
    }

    .product-name {
        margin-bottom: 0;
        /* Remove default bottom margin */
        font-weight: bold;
        /* Make the name bold */
        overflow: hidden;
        /* Hide any overflow */
        white-space: normal;
        /* Allow wrapping */
        text-overflow: ellipsis;
    }

    .product-details p {
        margin: 0;
        max-height: 3.6em;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .loading-more {
        text-align: center;
        /* Center the loading message */
        padding: 10px;
        /* Add some padding */
        font-weight: bold;
        /* Make the text bold */
    }

    .responsive-table {
        height: 100%;
        overflow-y: scroll;

    }

    .qty {
        /* Hides the default number input spinner */
        -moz-appearance: textfield;
        /* Firefox */
        -webkit-appearance: none;
        /* Chrome/Safari */
        appearance: none;
        /* Standard */
    }

    .qty::-webkit-inner-spin-button,
    .qty::-webkit-outer-spin-button {
        display: none;
        /* Hides the spin buttons */
    }
</style>
@endpush
@endsection