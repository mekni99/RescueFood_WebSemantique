@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')


    <!-- Afficher les messages de succès -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Ajouter un Restaurant
        </button>
    </div>
    <!-- Modal pour ajouter un nouveau restaurant -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Ajouter un Nouveau Restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('restaurants.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du Restaurant</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="postal_code" class="form-label">Code Postal</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_name" class="form-label">Nom du Contact</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Téléphone de Contact</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email de Contact</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="food_type" class="form-label">Type de Nourriture</label>
                            <input type="text" class="form-control" id="food_type" name="food_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="collection_zone" class="form-label">Zone de Collecte</label>
                            <input type="text" class="form-control" id="collection_zone" name="collection_zone" required>
                        </div>
                        <div class="mb-3">
                            <label for="banque_alimentaire_id" class="form-label">ID de la Banque Alimentaire</label>
                            <input type="text" class="form-control" id="banque_alimentaire_id" name="banque_alimentaire_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des restaurants -->
    <div class="card">
        <div class="card-header">Liste des Restaurants</div>
        <div class="card-body">

            <!-- Bouton pour ouvrir le modal d'ajout -->
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Ajouter un Restaurant
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Adresse</th>                        
                        <th>collection_zone</th>
                        <th>contact_number</th>
                        <th> </th>

                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->address }}</td>
                        <td>{{ $restaurant->collection_zone }}</td>
                        <td>{{ $restaurant->food_type}}</td>
                        

                        <td>
                        
                        

                            <td>
                                <!-- Icône pour voir les détails -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $restaurant->id }}">
                                    <i class="fas fa-info-circle"></i> <!-- Font Awesome -->
                                    <!-- <i class="bi bi-info-circle"></i> --> <!-- Bootstrap Icons -->
                                </button>
                            
                                <!-- Modal pour afficher les détails du restaurant -->
                                <div class="modal fade" id="detailsModal{{ $restaurant->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $restaurant->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailsModalLabel{{ $restaurant->id }}">Détails du Restaurant: {{ $restaurant->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Adresse:</strong> {{ $restaurant->address }}</li>
                                                    <li class="list-group-item"><strong>Ville:</strong> {{ $restaurant->city }}</li>
                                                    <li class="list-group-item"><strong>Code Postal:</strong> {{ $restaurant->postal_code }}</li>
                                                    <li class="list-group-item"><strong>Nom du Contact:</strong> {{ $restaurant->contact_name }}</li>
                                                    <li class="list-group-item"><strong>Téléphone de Contact:</strong> {{ $restaurant->contact_phone }}</li>
                                                    <li class="list-group-item"><strong>Email de Contact:</strong> {{ $restaurant->contact_email }}</li>
                                                    <li class="list-group-item"><strong>Type de Nourriture:</strong> {{ $restaurant->food_type }}</li>
                                                    <li class="list-group-item"><strong>Zone de Collecte:</strong> {{ $restaurant->collection_zone }}</li>
                                                    <li class="list-group-item"><strong>ID de la Banque Alimentaire:</strong> {{ $restaurant->banque_alimentaire_id }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Icône pour éditer -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $restaurant->id }}">
                                    <i class="fas fa-edit"></i> <!-- Font Awesome -->
                                    <!-- <i class="bi bi-pencil"></i> --> <!-- Bootstrap Icons -->
                                </button>
                            
                                <!-- Modal pour éditer le restaurant -->
                                <div class="modal fade" id="editModal{{ $restaurant->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $restaurant->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $restaurant->id }}">Éditer le Restaurant: {{ $restaurant->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nom du Restaurant</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $restaurant->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Adresse</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="{{ $restaurant->address }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="city" class="form-label">Ville</label>
                                                        <input type="text" class="form-control" id="city" name="city" value="{{ $restaurant->city }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="postal_code" class="form-label">Code Postal</label>
                                                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $restaurant->postal_code }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="contact_name" class="form-label">Nom du Contact</label>
                                                        <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ $restaurant->contact_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="contact_phone" class="form-label">Téléphone de Contact</label>
                                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $restaurant->contact_phone }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="contact_email" class="form-label">Email de Contact</label>
                                                        <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $restaurant->contact_email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="food_type" class="form-label">Type de Nourriture</label>
                                                        <input type="text" class="form-control" id="food_type" name="food_type" value="{{ $restaurant->food_type }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="collection_zone" class="form-label">Zone de Collecte</label>
                                                        <input type="text" class="form-control" id="collection_zone" name="collection_zone" value="{{ $restaurant->collection_zone }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="banque_alimentaire_id" class="form-label">ID de la Banque Alimentaire</label>
                                                        <input type="text" class="form-control" id="banque_alimentaire_id" name="banque_alimentaire_id" value="{{ $restaurant->banque_alimentaire_id }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-warning">Mettre à jour</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Icône pour supprimer -->
                                <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant?');">
                                        <i class="fas fa-trash"></i> <!-- Font Awesome -->
                                        <!-- <i class="bi bi-trash"></i> --> <!-- Bootstrap Icons -->
                                    </button>
                                </form>
                            </td>         

                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

@endsection

@section('scripts')
<script>
    // Initialiser Bootstrap modals
    var addModal = new bootstrap.Modal(document.getElementById('addModal'));
    @foreach($restaurants as $restaurant)
        var detailsModal{{ $restaurant->id }} = new bootstrap.Modal(document.getElementById('detailsModal{{ $restaurant->id }}'));
        var editModal{{ $restaurant->id }} = new bootstrap.Modal(document.getElementById('editModal{{ $restaurant->id }}'));
    @endforeach
</script>

@endsection
