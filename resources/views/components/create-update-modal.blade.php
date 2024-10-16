<!-- Create/Update Restaurant Modal -->
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="modal fade" id="createUpdateModal" tabindex="-1" aria-labelledby="createUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUpdateModalLabel">Create/Update Restaurant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUpdateForm">
                    @csrf
                    <input type="hidden" id="restaurantId" name="id" value="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Restaurant Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                    </div>
                    <!-- Add any other fields as necessary -->
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
