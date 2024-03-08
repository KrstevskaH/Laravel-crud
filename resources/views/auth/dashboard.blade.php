@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Total Students
            </div>
            <div class="card-body">
                <p class="card-text">Number of Students: {{ $studentCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                
                News
            </div>
            <div class="card-body">
                <p class="card-text">{{ $activeNewsCount + $inactiveNewsCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card mb-4">
            <a href="{{ route('news.active') }}" class="card-header bg-success text-white">
                Active
            </a>
            <div class="card-body">
                <p class="card-text">{{ $activeNewsCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card mb-4">
            <a href="{{ route('news.inactive') }}" class="card-header bg-success text-white">
                Inactive
            </a>
            <div class="card-body">
                <p class="card-text">{{ $inactiveNewsCount }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
