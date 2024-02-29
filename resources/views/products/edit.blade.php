@extends('auth.layouts')

@section('content')
<div class="row mt-5">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail"
                    placeholder="Detail">{{ $product->detail }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" value="{{ $product->email }}" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="tel" name="phone" class="form-control" value="{{ $product->phone }}" placeholder="Phone">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date of Birth:</strong>
                <input type="date" name="dob" class="form-control" value="{{ $product->dob }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label>Status:</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="status" value="1"
                    {{ $product->status == 1 ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="status" value="0"
                    {{ $product->status == 0 ? 'checked' : '' }}>
                <label class="form-check-label">Inactive</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <label for="image">Choose Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection