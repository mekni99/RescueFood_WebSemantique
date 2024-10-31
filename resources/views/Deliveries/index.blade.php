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
                        <h6>Livraisons</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeliveryModal">
                            Add Delivery
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th>Start Address</th>
                                        <th>Delivery Address</th>
                                        <th>Recipient Name</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deliveries as $delivery)
                                    <tr>
                                        <td>{{ $delivery['start_address'] }}</td>
                                        <td>{{ $delivery['delivery_address'] }}</td>
                                        <td>{{ $delivery['recipient_name'] }}</td>
                                        <td>{{ $delivery['status'] }}</td>
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

    <!-- Modal for adding a delivery -->
    <div class="modal fade" id="addDeliveryModal" tabindex="-1" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeliveryModalLabel">Add a Delivery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('deliveries.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="start_address" class="form-label">Start Address</label>
                            <input type="text" class="form-control" id="start_address" name="start_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="delivery_address" class="form-label">Delivery Address</label>
                            <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient_name" class="form-label">Recipient Name</label>
                            <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Delivery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection