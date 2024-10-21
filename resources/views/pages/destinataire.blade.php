@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<!-- Add Destinataires Form -->
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
                    <h5>Ajouter des Destinataires</h5>
                </div>
                <div class="card-body">
                    <!-- Form to add new destinataires -->
                    <form action="{{ route('user.destinataires.store') }}" method="POST">
                        @csrf

                        <!-- Select Request -->
                        <div class="mb-3">
                            <label for="request_id" class="form-label">Associer à une Demande Existante</label>
                            <select class="form-select" id="request_id" name="request_id" required>
                                <!-- Dynamically populate requests -->
                                @foreach($requests as $request)
                                    <option value="{{ $request->id }}">{{ $request->name }} ({{ $request->product_requested }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Destinataire Details -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Prénom du Destinataire</label>
                            <input type="text" class="form-control" id="first_name" name="first_name[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nom du Destinataire</label>
                            <input type="text" class="form-control" id="last_name" name="last_name[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="specific_needs" class="form-label">Besoins Spécifiques</label>
                            <textarea class="form-control" id="specific_needs" name="specific_needs[]" rows="3"></textarea>
                        </div>

                        <!-- Button to add more destinataires -->
                        <div class="mb-3">
                            <button type="button" id="add-destinataire" class="btn btn-outline-secondary">Ajouter un autre destinataire</button>
                        </div>

                        <!-- Submit the form -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Enregistrer les Destinataires</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to dynamically add more destinataire fields -->
<script>
    document.getElementById('add-destinataire').addEventListener('click', function() {
        let form = document.querySelector('form');
        let newFields = `
            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom du Destinataire</label>
                <input type="text" class="form-control" id="first_name" name="first_name[]" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Nom du Destinataire</label>
                <input type="text" class="form-control" id="last_name" name="last_name[]" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact[]" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address[]" required>
            </div>
            <div class="mb-3">
                <label for="specific_needs" class="form-label">Besoins Spécifiques</label>
                <textarea class="form-control" id="specific_needs" name="specific_needs[]" rows="3"></textarea>
            </div>
        `;
        form.insertAdjacentHTML('beforeend', newFields);
    });
</script>
