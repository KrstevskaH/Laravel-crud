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
                <p class="card-text">1</p>
            </div>
        </div>
    </div>


    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Active
            </div>
            <div class="card-body">
                <p class="card-text">2</p>
            </div>
        </div>
    </div>


    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Inactive
            </div>
            <div class="card-body">
                <p class="card-text">3</p>
            </div>
        </div>
    </div>

    <!-- Additional Content (Your existing card) -->
    <!-- <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                Dashboard
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>       
                @endif                
            </div>
        </div>
    </div> -->

</div>

@endsection