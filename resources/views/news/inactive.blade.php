@extends('news.layout')

@section('content')
    <h2 class="mt-3">Inactive News Articles</h2>

    @foreach($inactiveNews as $article)
      
    @endforeach

    {{ $inactiveNews->links() }}
@endsection
