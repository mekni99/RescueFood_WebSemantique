@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Update Restaurant'])

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add Restaurant</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('restaurants.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="address" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" id="contact_person" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Restaurant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/argon-dashboard-free@1.0.0/css/argon.css" rel="stylesheet">

@endsection
<link href="https://cdn.jsdelivr.net/npm/argon-dashboard-free@1.0.0/css/argon.css" rel="stylesheet">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
