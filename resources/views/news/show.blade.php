@extends('news.layout')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show News Article</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-danger" href="{{ route('news.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">News Article Details</h5>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Title:</strong>
                        {{ isset($news->title) ? $news->title : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Details:</strong>
                        {{ isset($news->details) ? $news->details : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Status:</strong>
                        {{ isset($news->status) ? ($news->status == 'active' ? 'Active' : 'Inactive') : '' }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Image:</strong>
                        @if(isset($news->image))
                            <img src="{{ asset('storage/news/' . $news->image) }}" alt="News Image" class="img-thumbnail" style="max-width: 100%;">
                        @else
                            No Image Available
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
