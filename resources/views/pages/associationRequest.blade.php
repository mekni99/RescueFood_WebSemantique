{{-- resources/views/association_requests/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Demandes d'association</h1>

        {{-- Messages de succès ou d'erreur --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif(isset($message))
            <div class="alert alert-info">{{ $message }}</div>
        @endif

        {{-- Bouton pour ajouter une demande d'association --}}
        <button class="btn btn-primary" data-toggle="modal" data-target="#addRequestModal">Ajouter une demande</button>

        {{-- Liste des demandes d'association --}}
        <h3>Liste des demandes</h3>
        @if(!empty($associationRequests['results']['bindings']))
            <table class="table table-bordered">
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
        @else
            <p>Aucune demande d'association trouvée.</p>
        @endif
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
    <script>
        $(document).ready(function() {
            // Code pour ouvrir le modal
            $('#addRequestModal').on('show.bs.modal', function (event) {
                // Reset the form on modal open
                $(this).find('form')[0].reset();
            });
        });
    </script>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

@endsection
