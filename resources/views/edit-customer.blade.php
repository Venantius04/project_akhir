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
            <form action="{{ url('customers/' . $customer->id) }}" method="POST" >
                @csrf
                @method('PATCH')
                <div class="mb-3">
                  <label for="customer" class="form-label">Customer Name</label>
                  <input type="text" class="form-control" value="{{ $customer->name }}" id="customer" name="name">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
              </form>
        </div>
    </div>
</div>
@endsection
