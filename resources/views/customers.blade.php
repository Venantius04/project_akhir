@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
    @endif
    <div class="row justify-content-center">
        <div class="col-md-4">
          
            <form action="{{ url('customers') }}" method="POST" >
                @csrf
                <div class="mb-3">
                  <label for="customer" class="form-label">Customer Name</label>
                  <input type="text" class="form-control" id="customer" name="name">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
        <div class="col-md-8">
            <h1>Customers</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $i => $customer)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td class="d-flex gap-3">
                                <form action="{{ url('customers/' . $customer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                {{-- <a href="{{ url('customers/' . $customer->id) }}">
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </a>
                                <!-- Button trigger modal --> --}}
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ "editcustomer" . $customer->id }}">
                                    Edit
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="{{ "editcustomer" . $customer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Customer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('customers/' . $customer->id) }}" method="POST" >
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3">
                                                  <label for="customer" class="form-label">Customer Name</label>
                                                  <input type="text" class="form-control" value="{{ $customer->name }}" id="customer" name="name">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"  data-bs-dismiss="modal">Edit</button>
                                        </form>
                                        
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                    
                            </td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
