@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Destinataires'])

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
                        <h6>Tableau des Destinataires</h6>
                        <!-- Bouton pour ouvrir le modal d'ajout -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDestinataireModal">
                            Ajouter un Destinataire
                        </button>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Contact</th>
                                        <th>Adresse</th>
                                        <th>Besoins Spécifiques</th>
                                        <th class="text-center">Demande Associée</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($destinataires as $destinataire)
                                        <tr>
                                            <td>{{ $destinataire->first_name }}</td>
                                            <td>{{ $destinataire->last_name }}</td>
                                            <td>{{ $destinataire->contact }}</td>
                                            <td>{{ $destinataire->address }}</td>
                                            <td>{{ $destinataire->specific_needs }}</td>
                                            <td class="text-center">{{ $destinataire->associationRequest->id ?? 'N/A' }}</td>

                                            <!-- Boutons Éditer et Supprimer -->
                                            <td class="align-middle text-center">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editDestinataireModal{{ $destinataire->id }}" class="text-warning me-3" style="font-size: 1.25rem;"> <!-- Taille ajustée -->
                                                ✏️ <!-- Emoji de stylo -->
                                            </a>

                                                <form action="{{ route('destinataire.destroy', $destinataire->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce destinataire ?')">    🗑️ <!-- Emoji de poubelle -->
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal pour Éditer le Destinataire -->
                                        <div class="modal fade" id="editDestinataireModal{{ $destinataire->id }}" tabindex="-1" aria-labelledby="editDestinataireModalLabel{{ $destinataire->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editDestinataireModalLabel{{ $destinataire->id }}">Modifier le Destinataire</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('destinataire.update', $destinataire->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="first_name" class="form-label">Prénom</label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $destinataire->first_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="last_name" class="form-label">Nom</label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $destinataire->last_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="contact" class="form-label">Contact</label>
                                                                <input type="text" class="form-control" id="contact" name="contact" value="{{ $destinataire->contact }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="address" class="form-label">Adresse</label>
                                                                <input type="text" class="form-control" id="address" name="address" value="{{ $destinataire->address }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="specific_needs" class="form-label">Besoins Spécifiques</label>
                                                                <input type="text" class="form-control" id="specific_needs" name="specific_needs" value="{{ $destinataire->specific_needs }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Mettre à jour le Destinataire</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>

                            @if($destinataires->isEmpty())
                                <div class="text-center">
                                    <p class="text-sm text-secondary">Aucun destinataire trouvé.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour Ajouter un Destinataire -->
    <div class="modal fade" id="createDestinataireModal" tabindex="-1" aria-labelledby="createDestinataireModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDestinataireModalLabel">Ajouter un Nouveau Destinataire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('destinataire.store') }}" method="POST">
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
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="specific_needs" class="form-label">Besoins Spécifiques</label>
                            <input type="text" class="form-control" id="specific_needs" name="specific_needs" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer le Destinataire</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
