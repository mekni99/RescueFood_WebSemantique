@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransportModal">
                            Add Transport
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th>Vehicle Type</th>
                                        <th>License Plate</th>
                                        <th>Driver Name</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transports as $transport)
                                    <tr>
                                        <td>{{ $transport['vehicle_type'] }}</td>
                                        <td>{{ $transport['license_plate'] }}</td>
                                        <td>{{ $transport['driver_name'] }}</td>
                                        <td>{{ $transport['status'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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