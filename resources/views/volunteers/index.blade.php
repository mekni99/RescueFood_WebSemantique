<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.4/dist/cdn.min.js" defer></script>
</head>
<body>

<header
      class='shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]  top-0 py-3 px-4 sm:px-10  z-50 min-h-[70px]'  style="color:#FBCEB1;">
      <div class='flex flex-wrap items-center gap-4'>
        <a href="javascript:void(0)"><img src="{{ asset('img/logo22.png') }}"alt="logo" class='w-36' />
        </a>

        <div id="collapseMenu"
          class='max-lg:hidden lg:!block max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
          <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
              <path
                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                data-original="#000000"></path>
              <path
                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                data-original="#000000"></path>
            </svg>
          </button>

          <ul
            class='lg:ml-12 lg:flex gap-x-6 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
            <li class='mb-6 hidden max-lg:block'>
              <a href="javascript:void(0)"><img src="{{ asset('img/logo (2).png') }}" alt="logo" class='w-36' />
              </a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'>
              <a href='javascript:void(0)'
                class='block font-semibold transition-all'  style="color:#F96C57;">Home</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class=' block font-semibold transition-all'style="color:#F96C57;">About us</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class=' block font-semibold transition-all'style="color:#F96C57;">Restaurant</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class=' block font-semibold transition-all'style="color:#F96C57;">Association</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class=' block font-semibold transition-all'style="color:#F96C57;">Contact Us</a>
            </li>
           
          </ul>

        </div>

        <div class='flex ml-auto'>
    <form role="form" method="POST" action="{{ route('logout') }}" id="logout-form" class="d-inline">
        @csrf
        <button type="submit" class='px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>
            <i class="fa fa-user me-sm-1"></i> Log Out
        </button>
    </form>

        </div>
      </div>
    </header>


    <div class=" px-6 py-12 ">
    <div class="lg:max-w-7xl max-w-lg mx-auto px-6 py-8  rounded-lg shadow-md" style='background-color: #fbddca;'>
<div class="container mt-5">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-3xl font-extrabold" style="color: #F98128;">Manage Volunteers</h2>
    
    <!-- Button to Open Add Volunteer Modal -->
    <button type="button" class="btn text-white rounded-xl font-bold" style='background-color: #8cc342;' data-toggle="modal" data-target="#addVolunteerModal">
        Add Volunteer
    </button>
</div>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered rounded-2xl" style='background-color: white;'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Availability</th>
                <th>Telephone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($volunteers as $volunteer)
                <tr>
                    <td>{{ $volunteer->name }}</td>
                    <td>{{ $volunteer->location }}</td>
                    <td>{{ $volunteer->availability }}</td>
                    <td>{{ $volunteer->telephone_number }}</td>
                    <td>
                        <!-- Button to Open Edit Volunteer Modal -->
                        <td>

    <!-- Edit Icon -->
    <button type="button" class="btn" data-toggle="modal" data-target="#editVolunteerModal" data-id="{{ $volunteer->id }}" data-name="{{ $volunteer->name }}" data-location="{{ $volunteer->location }}" data-availability="{{ $volunteer->availability }}" data-telephone="{{ $volunteer->telephone_number }}" title="Edit" style="border: none; background: none;">
        <i class="fas fa-edit" style="color: #8cc342; font-size: 1.2rem;"></i>
    </button>

    <!-- Delete Icon -->
    <form action="{{ route('volunteers.destroy', $volunteer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn" title="Delete" onclick="return confirm('Are you sure you want to delete this volunteer?');" style="border: none; background: none;">
            <i class="fas fa-trash" style="color: #F96C57; font-size: 1.2rem;"></i>
        </button>
    </form>
</td>

</td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Volunteer Modal -->
<div class="modal fade rounded-2xl font-bold" id="addVolunteerModal" tabindex="-1" aria-labelledby="addVolunteerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVolunteerModalLabel" style="color: #F96C57;">Add Volunteer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('volunteers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="volunteerName">Name</label>
                        <input type="text" class="form-control" id="volunteerName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="volunteerLocation">Location</label>
                        <input type="text" class="form-control" id="volunteerLocation" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="volunteerAvailability">Availability</label>
                        <input type="text" class="form-control" id="volunteerAvailability" name="availability" required>
                    </div>
                    <div class="form-group">
                        <label for="volunteerTelephone">Telephone Number</label>
                        <input type="text" class="form-control" id="volunteerTelephone" name="telephone_number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-white font-bold " data-dismiss="modal"style="color: #F96C57;" >Close</button>
                        <button type="submit" class="btn font-bold text-white "style='background-color: #8cc342;'>Add Volunteer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Volunteer Modal -->
<div class="modal fade rounded-2xl" id="editVolunteerModal" tabindex="-1" aria-labelledby="editVolunteerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-bold " id="editVolunteerModalLabel" style="color: #F96C57;">Edit Volunteer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editVolunteerForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editVolunteerName">Name</label>
                        <input type="text" class="form-control" id="editVolunteerName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editVolunteerLocation">Location</label>
                        <input type="text" class="form-control" id="editVolunteerLocation" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="editVolunteerAvailability">Availability</label>
                        <input type="text" class="form-control" id="editVolunteerAvailability" name="availability" required>
                    </div>
                    <div class="form-group">
                        <label for="editVolunteerTelephone">Telephone Number</label>
                        <input type="text" class="form-control" id="editVolunteerTelephone" name="telephone_number" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn bg-white font-bold " data-dismiss="modal"style="color: #F96C57;" >Close</button>
                    <button type="submit" class="btn font-bold text-white  "style='background-color: #8cc342;'>Update Volunteer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $('#editVolunteerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var location = button.data('location');
        var availability = button.data('availability');
        var telephone = button.data('telephone');

        var modal = $(this);
        modal.find('.modal-body #editVolunteerName').val(name);
        modal.find('.modal-body #editVolunteerLocation').val(location);
        modal.find('.modal-body #editVolunteerAvailability').val(availability);
        modal.find('.modal-body #editVolunteerTelephone').val(telephone);
        modal.find('form').attr('action', '/volunteers/' + id);
    });
</script>

</body>
</html>
