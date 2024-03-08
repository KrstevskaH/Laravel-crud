<!-- resources/views/news/active.blade.php -->

@extends('news.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Active News Articles</h2>

        @if(count($activeNews) > 0)
            <div class="row">
                @foreach($activeNews as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ $article->details }}</p>
                                @if($article->image)
                                    <img src="{{ asset('storage/news/' . $article->image) }}" alt="{{ $article->title }}" class="card-img-top">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No active news articles available.</p>
        @endif
    </div>
@endsection
