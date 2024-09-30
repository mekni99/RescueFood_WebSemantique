@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Recommendations Management'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Recommendations</h6>
                        <!-- Button to trigger add modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecommendationModal">
                            Add Recommendation
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recommendations as $recommendation)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $recommendation->title }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $recommendation->description }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $recommendation->created_at->format('d/m/Y') }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm 
                                                @if($recommendation->status == 'Actif') bg-gradient-success 
                                                @elseif($recommendation->status == 'Obsolète') bg-gradient-danger 
                                                @elseif($recommendation->status == 'En révision') bg-gradient-warning 
                                                @endif">
                                                {{ $recommendation->status }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-end">
    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
        <!-- Link for editing with a pencil emoji -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#editRecommendationModal{{ $recommendation->id }}" class="text-warning me-3" style="font-size: 1.25rem;"> <!-- Taille ajustée -->
            ✏️ <!-- Emoji de stylo -->
        </a>

        <form action="{{ route('recommendations.destroy', $recommendation->id) }}" method="POST" class="d-inline-block" style="display:inline;">
            @csrf
            @method('DELETE')
            <!-- Link for deleting with a trash emoji -->
            <a href="#" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();" style="font-size: 1.25rem;" onclick="return confirm('Are you sure you want to delete this recommendation?')">
                🗑️ <!-- Emoji de poubelle -->
            </a>
        </form>
    </div>
</td>

</td>

                 </tr>

                                    <!-- Modal d'édition d'une recommandation -->
                                    <div class="modal fade" id="editRecommendationModal{{ $recommendation->id }}" tabindex="-1" aria-labelledby="editRecommendationModalLabel{{ $recommendation->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRecommendationModalLabel{{ $recommendation->id }}">Editer la recommandation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulaire d'édition -->
                                                    <form action="{{ route('recommendations.update', $recommendation->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Titre</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ $recommendation->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $recommendation->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="type" class="form-label">Type de denrée</label>
                                                            <select class="form-select" id="type" name="type" required>
                                                                <option value="Fruits" {{ $recommendation->type == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                                                                <option value="Légumes" {{ $recommendation->type == 'Légumes' ? 'selected' : '' }}>Légumes</option>
                                                                <option value="Produits laitiers" {{ $recommendation->type == 'Produits laitiers' ? 'selected' : '' }}>Produits laitiers</option>
                                                                <option value="Autre" {{ $recommendation->type == 'Autre' ? 'selected' : '' }}>Autre</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="practical_tips" class="form-label">Conseils pratiques</label>
                                                            <textarea class="form-control" id="practical_tips" name="practical_tips" rows="3" required>{{ $recommendation->practical_tips }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="shelf_life" class="form-label">Durée de conservation</label>
                                                            <input type="text" class="form-control" id="shelf_life" name="shelf_life" value="{{ $recommendation->shelf_life }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="state" class="form-label">État de la denrée</label>
                                                            <select class="form-select" id="state" name="state" required>
                                                                <option value="Frais" {{ $recommendation->state == 'Frais' ? 'selected' : '' }}>Frais</option>
                                                                <option value="Congelé" {{ $recommendation->state == 'Congelé' ? 'selected' : '' }}>Congelé</option>
                                                                <option value="Préparé" {{ $recommendation->state == 'Préparé' ? 'selected' : '' }}>Préparé</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="creation_date" class="form-label">Date de création</label>
                                                            <input type="date" class="form-control" id="creation_date" name="creation_date" value="{{ $recommendation->creation_date }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Statut</label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="Actif" {{ $recommendation->status == 'Actif' ? 'selected' : '' }}>Actif</option>
                                                                <option value="Obsolète" {{ $recommendation->status == 'Obsolète' ? 'selected' : '' }}>Obsolète</option>
                                                                <option value="En révision" {{ $recommendation->status == 'En révision' ? 'selected' : '' }}>En révision</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>

                            @if($recommendations->isEmpty())
                                <div class="text-center">
                                    <p class="text-sm text-secondary">No recommendations found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout d'une recommandation -->
    <div class="modal fade" id="addRecommendationModal" tabindex="-1" aria-labelledby="addRecommendationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecommendationModalLabel">Ajouter une recommandation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire d'ajout -->
                    <form action="{{ route('recommendations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de denrée</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="Fruits">Fruits</option>
                                <option value="Légumes">Légumes</option>
                                <option value="Produits laitiers">Produits laitiers</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="practical_tips" class="form-label">Conseils pratiques</label>
                            <textarea class="form-control" id="practical_tips" name="practical_tips" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="shelf_life" class="form-label">Durée de conservation</label>
                            <input type="text" class="form-control" id="shelf_life" name="shelf_life" required>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">État de la denrée</label>
                            <select class="form-select" id="state" name="state" required>
                                <option value="Frais">Frais</option>
                                <option value="Congelé">Congelé</option>
                                <option value="Préparé">Préparé</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="creation_date" class="form-label">Date de création</label>
                            <input type="date" class="form-control" id="creation_date" name="creation_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Actif">Actif</option>
                                <option value="Obsolète">Obsolète</option>
                                <option value="En révision">En révision</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
