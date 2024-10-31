<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Associations</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addAssociationModal">Add Association</button>

    <table class="table mt-3" id="associationTable">
        <thead>
            <tr>
                <th>Association</th>
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
                        <td>{{ $association['association']['value'] }}</td>
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

<!-- Add Association Modal -->
<div class="modal fade" id="addAssociationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Association</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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

</body>
</html>
