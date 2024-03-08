@extends('news.layout')

@section('content')
<div class="container mt-5">
    <div class="pull-right">
        <a class="btn btn-danger mt-3 " href="{{ route('news.index') }}"> Back</a>
    </div>
    <h2>Edit News Article</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mt-5">
            <label for="title" class="font-weight-bold">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $news->title) }}" required>
        </div>

        <div class="form-group">
            <label for="details" class="font-weight-bold">Details:</label>
            <textarea name="details" id="details" class="form-control" required>{{ old('details', $news->details) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image" class="font-weight-bold">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($news->image)
                <img src="{{ asset('storage/news/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid mt-2" style="max-width: 200px;">
            @endif
        </div>

        <div class="form-group">
            <label for="status" class="font-weight-bold">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ old('status', $news->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $news->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mb-5">Update News</button>
    </form>
</div>
@endsection
