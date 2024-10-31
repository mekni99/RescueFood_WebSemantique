@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Add Volunteer'])

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add Volunteer</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('volunteers.store') }}" method="POST">
                        @csrf

                        <!-- Full Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
                        </div>

                        <!-- Location -->
                        <div class="form-group mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" id="location" placeholder="Enter location" required>
                        </div>

                        <!-- Availability -->
                        <div class="form-group mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <input type="text" name="availability" class="form-control" id="availability" placeholder="Enter availability" required>
                        </div>

                        <!-- Telephone Number -->
                        <div class="form-group mb-3">
                            <label for="telephone_number" class="form-label">Telephone Number</label>
                            <input type="text" name="telephone_number" class="form-control" id="telephone_number" placeholder="Enter telephone number" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Register Volunteer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/argon-dashboard-free@1.0.0/css/argon.css" rel="stylesheet">
@endsection
