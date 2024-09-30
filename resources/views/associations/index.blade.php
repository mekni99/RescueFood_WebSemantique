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
                        <h6>Associations</h6>
                        <!-- Button to trigger add modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssociationModal">
                            Add Association
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Details</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Specific Needs</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($associations as $association)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $association->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $association->contact_details }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $association->specific_needs }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm
                                                @if($association->status == 'Active') bg-gradient-success
                                                @elseif($association->status == 'Inactive') bg-gradient-danger
                                                @endif">
                                                {{ $association->status }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editAssociationModal{{ $association->id }}" class="text-warning me-3" style="font-size: 1.25rem;">✏️</a>

                                                <form action="{{ route('associations.destroy', $association->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();" style="font-size: 1.25rem;">
                                                        🗑️
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal for editing association -->
                                    <div class="modal fade" id="editAssociationModal{{ $association->id }}" tabindex="-1" aria-labelledby="editAssociationModalLabel{{ $association->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editAssociationModalLabel{{ $association->id }}">Edit Association</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('associations.update', $association->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $association->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="contact_details" class="form-label">Contact Details</label>
                                                            <textarea class="form-control" id="contact_details" name="contact_details" rows="3" required>{{ $association->contact_details }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="specific_needs" class="form-label">Specific Needs</label>
                                                            <textarea class="form-control" id="specific_needs" name="specific_needs" rows="3" required>{{ $association->specific_needs }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select class="form-control" id="status" name="status" required>
                                                                <option value="Active" {{ $association->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                                <option value="Inactive" {{ $association->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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

                            @if($associations->isEmpty())
                                <div class="text-center">
                                    <p class="text-sm text-secondary">No associations found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding a new association -->
    <div class="modal fade" id="addAssociationModal" tabindex="-1" aria-labelledby="addAssociationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAssociationModalLabel">Add Association</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('associations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_details" class="form-label">Contact Details</label>
                            <textarea class="form-control" id="contact_details" name="contact_details" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="specific_needs" class="form-label">Specific Needs</label>
                            <textarea class="form-control" id="specific_needs" name="specific_needs" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Association</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
