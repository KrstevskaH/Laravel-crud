@extends('products.layout')

@section('content')
<div class="row mt-5">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Student</h2>
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

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="detail">Detail:</label>
                <textarea class="form-control" name="detail" placeholder="Enter Detail" rows="3" required></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" value="1" checked>
                    <label class="form-check-label">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" value="0">
                    <label class="form-check-label">Inactive</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Choose Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="university_id">University:</label>
                <select name="university_id" class="form-control" required>
                    <option value="">Select University</option>
                    @foreach($universities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
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
