@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Update Restaurant'])

    <div class="container-fluid py-4">
        <h1 class="mb-4">Update Restaurant</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Update Restaurant Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Restaurant Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ old('contact_person', $restaurant->contact_person) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $restaurant->contact_number) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Restaurant</button>
                    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
