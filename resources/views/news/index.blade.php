

@extends('news.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">News Articles</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('news.create') }}" class="btn btn-success mb-2">Create News</a>
        <div class="form-group">
            <label for="status" class="font-weight-bold">Status:</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div class="row mt-3">
            @forelse($news as $article)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($article->image)
                            <img src="{{ asset('storage/news/' . $article->image) }}" alt="{{ $article->title }}" class="card-img-top fixed-size-image">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->details }}</p>
                            <div class="mt-auto">
                                <small class="text-muted">{{ $article->status }}</small>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>
                                <a href="{{ route('news.show', $article->id) }}" class="btn btn-primary btn-sm">Show</a>
                                <a href="{{ route('news.edit', $article->id) }}" class="btn btn-warning btn-sm ml-1">Edit</a>
                            </div>
                            <div>
                                <form action="{{ route('news.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No news articles available.</p>
            @endforelse
        </div>

        {{ $news->links() }}
    </div>
@endsection