@extends('auth.layouts')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Product Details</h5>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ isset($product->name) ? $product->name : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Details:</strong>
                        {{ isset($product->detail) ? $product->detail : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ isset($product->email) ? $product->email : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Phone:</strong>
                        {{ isset($product->phone) ? $product->phone : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Date of Birth:</strong>
                        {{ isset($product->dob) ? $product->dob : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Status:</strong>
                        {{ isset($product->status) ? ($product->status == 1 ? 'Active' : 'Inactive') : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Image:</strong>
                        @if(isset($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 100%;">
                        @else
                            No Image Available
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
