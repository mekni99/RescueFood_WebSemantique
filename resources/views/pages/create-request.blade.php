<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <h5>Create Request</h5>
                </div>
                <div class="card-body">
                    <!-- Form to create a new request for the logged-in association -->
                    <form action="{{ route('user.requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_requested" class="form-label">Produit demandé</label>
                            <input type="text" class="form-control" id="product_requested" name="product_requested" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending">En attente</option>
                                <option value="Completed">Complété</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Créer la demande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
