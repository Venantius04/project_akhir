@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h1 class="fw-bold mb-4">Edit Product</h1>
            <form action="{{ url('products' . '/' . $product->id) }}" method="POST" >
                @method('PATCH')
                @csrf
                <div class="mb-3">
                  <label for="product" class="form-label">Product Name</label>
                  <input type="text" class="form-control" id="product" value="{{ $product->product_name }}" name="product_name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" value="{{ $product->price }}" name="price">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
                </div>
  
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
@endsection