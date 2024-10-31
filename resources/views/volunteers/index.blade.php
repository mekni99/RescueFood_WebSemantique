<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Volunteers</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addVolunteerModal">Add Volunteer</button>
    
    <table class="table mt-3" id="volunteerTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Availability</th>
                <th>Telephone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($volunteers as $volunteer)
                <tr>
                    <td>{{ $volunteer['volunteer']['value'] }}</td>
                    <td>{{ $volunteer['name']['value'] }}</td>
                    <td>{{ $volunteer['location']['value'] }}</td>
                    <td>{{ $volunteer['availability']['value'] }}</td>
                    <td>{{ $volunteer['telephone_number']['value'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session('message'))
        <div class="alert alert-info">{{ session('message') }}</div>
    @endif
</div>

<!-- Add Volunteer Modal -->
<div class="modal fade" id="addVolunteerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Volunteer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addVolunteerForm" action="{{ route('volunteers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Availability</label>
                        <input type="text" class="form-control" name="availability" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone_number">Telephone Number</label>
                        <input type="text" class="form-control" name="telephone_number" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Volunteer</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
