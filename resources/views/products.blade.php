@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
          
            <form action="{{ url('products') }}" method="POST" >
                @csrf
                <div class="mb-3">
                  <label for="product" class="form-label">Product Name</label>
                  <input type="text" class="form-control" id="product" name="product_name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock">
                </div>
  
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="col-md-8">
            <h1>List Product</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i => $product)
                  <tr>
                    <td scope="col">{{ $i + 1 }}</td>
                    <td scope="col">{{ $product->product_name }}</td>
                    <td scope="col">{{ $product->price }}</td>
                    <td scope="col">{{ $product->stock }}</td>
                    <th scope="col" class="d-flex gap-2">
                        <form action="{{ url('products'. '/' . $product->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        <a href="{{ url('products/' . $product->id) }}" class="">
                            <button class="btn btn-primary">Edit</button>
                        </a>
                    </th>

                </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
