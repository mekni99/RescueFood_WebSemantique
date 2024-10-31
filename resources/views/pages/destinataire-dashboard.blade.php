@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Destinataires</h1>

    {{-- Messages de succès ou d'erreur --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(isset($message))
        <div class="alert alert-info">{{ $message }}</div>
    @endif

    {{-- Bouton pour ajouter un destinataire --}}
    <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addDestinataireModal">Ajouter un destinataire</button>

    {{-- Liste des destinataires --}}
    <table class="table">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Contact</th>
                <th>Adresse</th>
                <th>Besoins Spécifiques</th>
                <th>Demande Associée</th>
            </tr>
        </thead>
        <tbody>
            @if(count($destinataires) > 0)
                @foreach($destinataires as $destinataire)
                    <tr>
                        <td>{{ $destinataire['first_name']['value'] ?? '' }}</td>
                        <td>{{ $destinataire['last_name']['value'] ?? '' }}</td>
                        <td>{{ $destinataire['contact']['value'] ?? '' }}</td>
                        <td>{{ $destinataire['address']['value'] ?? '' }}</td>
                        <td>{{ $destinataire['specific_needs']['value'] ?? '' }}</td>
                        <td>{{ $destinataire['associated_request']['value'] ?? '' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Aucun destinataire trouvé.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Modal pour ajouter un destinataire --}}
    <div class="modal fade" id="addDestinataireModal" tabindex="-1" role="dialog" aria-labelledby="addDestinataireModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDestinataireModalLabel">Ajouter un destinataire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('destinataire.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">Prénom</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Nom</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="specific_needs">Besoins Spécifiques</label>
                            <input type="text" class="form-control" id="specific_needs" name="specific_needs">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

@endsection