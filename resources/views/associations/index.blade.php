


@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Association Management'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center"> 
                        <h2>Associations</h2>
                    </div>
                    <div class="card-body p-3"> <!-- Added padding here -->
                        <div class="table-responsive p-0">
                            <table class="table mt-3" id="associationTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact Details</th>
                                        <th>Specific Needs</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($associations['results']['bindings']) && !empty($associations['results']['bindings']))
                                        @foreach ($associations['results']['bindings'] as $association)
                                            <tr>
                                                <td>{{ $association['name']['value'] }}</td>
                                                <td>{{ $association['contact_details']['value'] }}</td>
                                                <td>{{ $association['specific_needs']['value'] }}</td>
                                                <td>{{ $association['status']['value'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No associations found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            @if (session('message'))
                                <div class="alert alert-info">{{ session('message') }}</div>
                            @endif
                        </div>

                        <!-- Add Association Form -->
                        <h4 class="mt-4">Add Association</h4>
                        <form id="addAssociationForm" action="{{ route('associations.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_details">Contact Details</label>
                                <input type="text" class="form-control" name="contact_details" required>
                            </div>
                            <div class="form-group">
                                <label for="specific_needs">Specific Needs</label>
                                <input type="text" class="form-control" name="specific_needs" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Association</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle (includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection
