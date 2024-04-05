@extends('news.layout')

@section('content')
<div class="container mt-5">
    <div class="pull-right">
        <a class="btn btn-danger mt-3 " href="{{ route('news.index') }}"> Back</a>
    </div>
    <h2>Create News</h2>

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-5">
            <label for="title" class="font-weight-bold">Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="details" class="font-weight-bold">Details:</label>
            <textarea name="details" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image" class="font-weight-bold">Image:</label>
            <input type="file" name="image" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label for="status" class="font-weight-bold">Status:</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection