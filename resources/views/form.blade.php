@extends('layouts.main')
@section('content')
    <div class="alert alert-danger" id="errors" hidden>

    </div>
    <div class="container">
        <div class="row">
            <h2>Products form</h2>
            <form>
                <div class="form-group col-md-4">
                    <label for="product_name">Product name:</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" name="product_name">
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Quantity in stock:</label>
                    <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity in Stock" name="quantity">
                </div>
                <div class="form-group col-md-4">
                    <label for="price">Price per item:</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter Price Per Item" name="price">
                </div>
                <div class="form-group col-md-offset-10 col-md-2">
                    <button type="button" id="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <th>Product name</th>
                    <th>Quantity in stock</th>
                    <th>Price per item</th>
                    <th>Datetime submitted</th>
                    <th>Total value number</th>
                </thead>
                <tbody id="dataTable">
                </tbody>
            </table>
        </div>
    </div>
@endsection