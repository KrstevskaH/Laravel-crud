@extends('products.layout')
 
@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 10 CRUD Example </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered custom-table mt-3">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date Of Birth</th>
            <th>Status</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>{{ $product->email }}</td>
            <td>{{ $product->phone }}</td>
            <td>{{ $product->dob }}</td>
            <td>{{ $product->status }}</td>
            <td>
            @if(isset($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }} Image" class="img-thumbnail" style="max-width: 100%;">
                    @else
                        No Image Available
                    @endif
            </td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection