@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
          
            <form action="{{ url('transactions') }}" method="POST" >
                @csrf
                <div class="mb-3">
                    <label for="stock" class="form-label" >Customer</label>
                    <select name="customer_id" id="customer" required>
                        <option disabled selected>Select customer</option>
                        <option value="guest">Guest</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
  
                <button type="submit" class="btn btn-primary">Create Transaction</button>
              </form>
        </div>
        <div class="col-md-8">
            <h1>Recents Transaction</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Transaction id</th>
                    <th scope="col">customer Name</th>
                    <th scope="col">Total</th>
                    <th scope="col">Kembalian</th>
                    <th scope="col">Status Transaksi</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                  <tr>
                    <td scope="col">{{ $transaction->id }}</td>
                    <td scope="col">@if ($transaction->customer_id === null)
                        Guest
                    @else
                        {{ $transaction->customer->name}}
                    @endif</td>
                    <td scope="col">{{ $transaction->total }}</td>
                    <td scope="col">{{ $transaction->kembalian }}</td>
                    <td scope="col">{{ $transaction->status_transaction }}</td>


                </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
