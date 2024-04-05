@extends('products.layout')

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

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Enter Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="detail">Detail:</label>
                <textarea class="form-control" name="detail" placeholder="Enter Detail" rows="3" required>{{ $product->detail }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $product->email }}" class="form-control" placeholder="Enter Email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" value="{{ $product->phone }}" class="form-control" placeholder="Enter Phone" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" value="{{ $product->dob }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }}>
                    <label class="form-check-label">Inactive</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Choose Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
        </div>
        <div class="col-md-6">
    <div class="form-group">
        <label for="university_id">University:</label>
        <select name="university_id" class="form-control">
            <option value="">Select University </option>
            @foreach($universities as $university)
                <option value="{{ $university->id }}" {{ $product->university_id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
            @endforeach
        </select>
    </div>
</div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
