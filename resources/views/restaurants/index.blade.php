@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <!-- Restaurant Management Section -->
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Restaurant Management</h6>


                        <a href="{{ route('restaurants.create') }}" class="btn btn-primary">Add Restaurant</a>
                      



                        @if (session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurants as $restaurant)
                                        <tr>
                                            <td>{{ $restaurant->name }}</td>
                                            <td>{{ $restaurant->address }}</td>
                                            <td>{{ $restaurant->contact_person }}</td>
                                            <td>{{ $restaurant->contact_number }}</td>
                                            <td>
                                              <button type="button" class="btn btn-warning" onclick="openEditModal({
                        id: '{{ $restaurant->id }}',
                        name: '{{ $restaurant->name }}',
                        address: '{{ $restaurant->address }}',
                        contact_person: '{{ $restaurant->contact_person }}',
                        contact_number: '{{ $restaurant->contact_number }}'
                    })">Edit</button>
                    <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Existing Dashboard Cards Below -->
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Money</p>
                                    <h5 class="font-weight-bolder">$53,000</h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+55%</span> since yesterday
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- More cards can follow here -->
        </div>

        <!-- Include the modal component -->
        @include('components.create-update-modal')
    </div>

    <script>
        function openEditModal(restaurant) {
            // Populate the form with the restaurant data for editing
            document.getElementById('recordId').value = restaurant.id;
            document.getElementById('recordName').value = restaurant.name;
            document.getElementById('recordAddress').value = restaurant.address;
            document.getElementById('recordContactPerson').value = restaurant.contact_person;
            document.getElementById('recordContactNumber').value = restaurant.contact_number;
            document.getElementById('modalTitle').innerText = 'Update Restaurant';

            // Show the modal
            $('#createUpdateModal').modal('show');
        }

        function submitForm() {
            const form = document.getElementById('createUpdateForm');
            const id = document.getElementById('recordId').value; // Get the ID from the hidden input

            if (id) {
                // Logic for updating the restaurant
                form.action = `/restaurants/${id}`; // Update the form action for editing
                form.method = 'POST';
                form.appendChild(createHiddenInput('_method', 'PUT')); // Add method override for PUT
            } else {
                // Logic for creating a new restaurant
                form.action = '/restaurants'; // Set form action for creating
                form.method = 'POST';
            }

            // Submit the form
            form.submit();
        }

        function createHiddenInput(name, value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            return input;
        }
    </script>
@endsection
