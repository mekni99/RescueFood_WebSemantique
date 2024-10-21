
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            {{-- Success message --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Volunteers</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
                        Add Volunteer
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Availability</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($volunteers->count() > 0)
                                    @foreach ($volunteers as $volunteer)
                                        <tr>
                                            <td class="border-b py-4 px-6">{{ $volunteer->name }}</td>
                                            <td class="border-b py-4 px-6">{{ $volunteer->location }}</td>
                                            <td class="border-b py-4 px-6">{{ $volunteer->availability }}</td>
                                            <td class="border-b py-4 px-6">{{ $volunteer->telephone_number }}</td>
                                            <td class="border-b py-4 px-6 text-end">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editVolunteerModal{{ $volunteer->id }}" class="text-warning me-3" style="font-size: 1.25rem;">✏️</a>
                                                <form action="{{ route('volunteers.destroy', $volunteer->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();" style="font-size: 1.25rem;">🗑️</a>
                                                </form>
                                            </td>
                                        </tr>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade" id="editVolunteerModal{{ $volunteer->id }}" tabindex="-1" aria-labelledby="editVolunteerModalLabel{{ $volunteer->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editVolunteerModalLabel{{ $volunteer->id }}">Edit Volunteer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('volunteers.update', $volunteer->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $volunteer->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="location" class="form-label">Location</label>
                                                                <input type="text" class="form-control" id="location" name="location" value="{{ $volunteer->location }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="availability" class="form-label">Availability</label>
                                                                <input type="text" class="form-control" id="availability" name="availability" value="{{ $volunteer->availability }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="telephone_number" class="form-label">Phone</label>
                                                                <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="{{ $volunteer->telephone_number }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update Volunteer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4">No volunteers found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for adding a new volunteer --}}
    <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-labelledby="addVolunteerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVolunteerModalLabel">Add Volunteer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('volunteers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <input type="text" class="form-control" id="availability" name="availability" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone_number" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="telephone_number" name="telephone_number" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Volunteer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

