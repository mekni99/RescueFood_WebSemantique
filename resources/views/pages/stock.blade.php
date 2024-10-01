@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Stock Management'])

    <div class="container-fluid py-4">
        <h1>Stock Management</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
    <h6>Stock Items</h6>
    <!-- Button to trigger the modal for creating a new stock item -->
  <!-- Button to trigger the modal for creating a new stock item -->
<button type="button" class="btn btn-success btn-sm d-flex align-items-center mx-1" data-bs-toggle="modal" data-bs-target="#createNewItemModal" style="padding: 0.375rem 0.75rem;">
    <span class="me-1"><i class="fas fa-plus"></i></span>
    Add
</button>

</div>


            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Invoice Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/img/icons8-boîte-50.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->type }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if($item->quantity == 0)
                                            <span class="badge badge-sm bg-gradient-danger">Out of stock</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-success">{{ $item->quantity }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->price }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->invoice_number }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                        <span class="me-1"><i class="fas fa-edit"></i></span>
                                        Edit
                                        </button>
                                        <form action="{{ route('stock.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">    <span class="me-1"><i class="fas fa-trash"></i></span>
                                            Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Item Modal -->
                                <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editItemModalLabel{{ $item->id }}">Edit Stock Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('stock.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="type">Type</label>
                                                                <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="quantity">Quantity</label>
                                                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="price">Price</label>
                                                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $item->price }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="invoice_number">Invoice Number</label>
                                                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $item->invoice_number }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn bg-gradient-success">Update </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                    @if($items->isEmpty())
                        <div class="text-center">
                            <p class="text-sm text-secondary">No items found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Create New Stock Item Modal -->
        <div class="modal fade" id="createNewItemModal" tabindex="-1" aria-labelledby="createNewItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createNewItemModalLabel">Create New Stock Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('stock.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control" id="type" name="type" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="invoice_number">Invoice Number</label>
                                        <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-success">Add Stock Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
