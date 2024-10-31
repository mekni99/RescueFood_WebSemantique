@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <h1>Liste des Produits</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
                </div>

                <h6>Produits</h6>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addRequestModal">
                    <span class="me-1"><i class="fas fa-plus"></i></span> Ajouter Produit
                </button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    {{-- Liste des demandes d'association --}}
                    <h3 class="text-center">Liste des demandes</h3>
                    @if(!empty($associationRequests['results']['bindings']))
                        <div class="d-flex justify-content-center mb-4">
                            <table class="table table-bordered" style="margin-left: 4rem;">
                                <thead>
                                    <tr>
                                        <th>Nom de l'association</th>
                                        <th>Email de l'association</th>
                                        <th>Produit demandé</th>
                                        <th>Quantité</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($associationRequests['results']['bindings'] as $request)
                                        <tr>
                                            <td>{{ $request['association_name']['value'] }}</td>
                                            <td>{{ $request['association_email']['value'] }}</td>
                                            <td>{{ $request['product_requested']['value'] }}</td>
                                            <td>{{ $request['quantity']['value'] }}</td>
                                            <td>{{ $request['status']['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Aucune demande d'association trouvée.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Modal pour ajouter une demande --}}
        <div class="modal fade" id="addRequestModal" tabindex="-1" role="dialog" aria-labelledby="addRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRequestModalLabel">Ajouter une demande d'association</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addRequestForm" action="{{ route('requests.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="association_name">Nom de l'association</label>
                                <input type="text" class="form-control" id="association_name" name="association_name" required>
                            </div>
                            <div class="form-group">
                                <label for="association_email">Email de l'association</label>
                                <input type="email" class="form-control" id="association_email" name="association_email" required>
                            </div>
                            <div class="form-group">
                                <label for="product_requested">Produit demandé</label>
                                <input type="text" class="form-control" id="product_requested" name="product_requested" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantité</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Statut</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="en attente">En attente</option>
                                    <option value="accepté">Accepté</option>
                                    <option value="rejeté">Rejeté</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scripts nécessaires pour le modal --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function() {
                // Code pour ouvrir le modal
                $('#addRequestModal').on('show.bs.modal', function (event) {
                    // Reset the form on modal open
                    $(this).find('form')[0].reset();
                });
            });
        </script>
    </div>
@endsection
