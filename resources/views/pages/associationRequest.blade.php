@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Requests'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Requests Table</h6>
                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRequestModal">
                            Create Request
                        </button>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Association</th>
                                        <th>Product Requested</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Date of Request</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $request->association_name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $request->association_email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $request->product_requested }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $request->quantity }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm 
                                                    @if($request->status == 'Completed') bg-gradient-success 
                                                    @else bg-gradient-secondary 
                                                    @endif">{{ $request->status }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $request->created_at->format('d/m/Y') }}</span>
                                            </td>

                                            <!-- Edit and Delete buttons -->
                                            <td class="align-middle text-center">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editRequestModal{{ $request->id }}" class="text-warning me-3" style="font-size: 1.25rem;"> <!-- Taille ajustée -->
                                                ✏️ <!-- Emoji de stylo -->
                                            </a>

                                                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="text-danger" onclick="return confirm('Are you sure you want to delete this request?')">    🗑️ <!-- Emoji de poubelle -->
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>

                                    <!-- Edit Request Modal -->
                                    <div class="modal fade" id="editRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="editRequestModalLabel{{ $request->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRequestModalLabel{{ $request->id }}">Edit Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('requests.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Association Name -->
                    <div class="mb-3">
                        <label for="association_name" class="form-label">Association Name</label>
                        <input type="text" class="form-control" id="association_name" name="association_name" value="{{ $request->association_name }}" required>
                    </div>

                    <!-- Association Email -->
                    <div class="mb-3">
                        <label for="association_email" class="form-label">Association Email</label>
                        <input type="email" class="form-control" id="association_email" name="association_email" value="{{ $request->association_email }}" required>
                    </div>

                    <!-- Product Requested -->
                    <div class="mb-3">
                        <label for="product_requested" class="form-label">Product Requested</label>
                        <input type="text" class="form-control" id="product_requested" name="product_requested" value="{{ $request->product_requested }}" required>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $request->quantity }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $request->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                                    @endforeach
                                </tbody>
                            </table>

                            @if($requests->isEmpty())
                                <div class="text-center">
                                    <p class="text-sm text-secondary">No requests found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Request Modal -->
    <div class="modal fade" id="createRequestModal" tabindex="-1" aria-labelledby="createRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRequestModalLabel">Create New Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to create a new request -->
                    <form action="{{ route('requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="association_name" class="form-label">Association Name</label>
                            <input type="text" class="form-control" id="association_name" name="association_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="association_email" class="form-label">Association Email</label>
                            <input type="email" class="form-control" id="association_email" name="association_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_requested" class="form-label">Product Requested</label>
                            <input type="text" class="form-control" id="product_requested" name="product_requested" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
