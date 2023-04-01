@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h1 class="fw-bold mb-4">Tambah product</h1>
            <form action="{{ url('transactions/storeSession') }}" method="POST" >
                @csrf
                <select name="product_id" id="product" required>
                    <option disabled selected>Select product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }} Stock : {{ $product->stock }}</option>
                    @endforeach
                </select>
                <div class="form-group mb-3">
                    <label for="qty">Quantitiy</label>
                    <input type="number" id="qty" required max="100" class="form-control" name="qty">

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="col-md-6">
            <h1>Transaction Product</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Total</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    @php 
                        $total = 0;
                    @endphp
                    @if($cart)
                    @foreach ($cart as $i => $item)
                    @php
                    $total += $item['total']
                        
                    @endphp
                    <tr>
                      <td scope="col">{{ $i + 1 }}</td>
                      <td scope="col">{{ $item['product']->product_name }}</td>
                      <td scope="col">{{ $item['qty'] }}</td>
                      <td scope="col">{{ $item['total'] }}</td>

                      <th scope="col" class="d-flex gap-2">
                          <form action="{{ url('transactions/deleteItem/1') }}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger" type="submit">Delete</button>
                          </form>
                      </th>
  
                  </tr>
                  @endforeach
                  @endif
                </tbody>
            </table>
            <h6 class="fw-bold mb-4">Total : {{ $total }}</h6>
            <form action="{{ url('/transactions/checkout/' .$transaction->id) }}" method="POST">
                <div class="form-group mb-3">
                    <label for="pay">Uang Customer</label>
                    <input type="number" id="pay" class="form-control" name="pay">
                </div>
            <div class="d-flex gap-1">
                    @csrf
                    <button class="btn btn-success" type="submit">Checkout</button>
                </form>
                <form action="{{ url('/transactions/clearCart/') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Clear Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection