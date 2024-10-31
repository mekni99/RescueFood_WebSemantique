@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <h1>Liste des Destinataires</h1>

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

                <h6>Destinataire</h6>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addDestinataireModal">
                    <span class="me-1"><i class="fas fa-plus"></i></span> Ajouter Destinataire
                </button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Adresse</th>
                                <th>Besoins Spécifiques</th>
                            </tr>
                        </thead>
                        <tbody id="destinatairesTable">
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
                </div>
            </div>
        </div>

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

    <!-- Search functionality -->
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#destinatairesTable tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
