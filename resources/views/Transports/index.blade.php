@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Transport Management'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Transports</h6>
                        <!-- Button to trigger add modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransportModal">
                            Add Transport
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">License Plate</th> <!-- Nouvelle colonne -->
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Driver Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transports as $transport)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->vehicle_type }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->license_plate }}</p> <!-- Affichage de la plaque -->
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->driver_name }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm 
                                                @if($transport->status == 'Available') bg-gradient-success 
                                                @elseif($transport->status == 'Unavailable') bg-gradient-danger 
                                                @endif">
                                                {{ $transport->status }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editTransportModal{{ $transport->id }}" class="text-warning me-3" style="font-size: 1.25rem;">
                                                    ✏️
                                                </a>

                                                <form action="{{ route('transports.destroy', $transport->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();" style="font-size: 1.25rem;" onclick="return confirm('Are you sure you want to delete this transport?')">
                                                        🗑️
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal for editing transport -->
                                    <div class="modal fade" id="editTransportModal{{ $transport->id }}" tabindex="-1" aria-labelledby="editTransportModalLabel{{ $transport->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editTransportModalLabel{{ $transport->id }}">Edit Transport</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Edit form -->
                                                    <form action="{{ route('transports.update', $transport->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                                            <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" value="{{ $transport->vehicle_type }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="license_plate" class="form-label">License Plate</label>
                                                            <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ $transport->license_plate }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="driver_name" class="form-label">Driver Name</label>
                                                            <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ $transport->driver_name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="Available" {{ $transport->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                                <option value="Unavailable" {{ $transport->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>

                            @if($transports->isEmpty())
                                <div class="text-center">
                                    <p class="text-sm text-secondary">No transports found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding a transport -->
    <div class="modal fade" id="addTransportModal" tabindex="-1" aria-labelledby="addTransportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransportModalLabel">Add a Transport</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add form -->
                    <form action="{{ route('transports.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">Vehicle Type</label>
                            <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="license_plate" class="form-label">License Plate</label>
                            <input type="text" class="form-control" id="license_plate" name="license_plate" required>
                        </div>
                        <div class="mb-3">
                            <label for="driver_name" class="form-label">Driver Name</label>
                            <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Transport</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
