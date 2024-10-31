@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Update Restaurant'])
    <div class="container mt-9">
        <h1>Restaurants Existants</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($message))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Restaurant</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Nom du Contact</th>
                        <th>Téléphone du Contact</th>
                        <th>Email du Contact</th>
                        <th>Type de Nourriture</th>
                        <th>Zone de Collecte</th>
                        <th>ID Banque Alimentaire</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($restaurants['results']['bindings']))
                        @foreach($restaurants['results']['bindings'] as $restaurant)
                            <tr>
                                <td>{{ $restaurant['restaurant']['value'] }}</td>
                                <td>{{ $restaurant['name']['value'] }}</td>
                                <td>{{ $restaurant['address']['value'] }}</td>
                                <td>{{ $restaurant['city']['value'] }}</td>
                                <td>{{ $restaurant['postal_code']['value'] }}</td>
                                <td>{{ $restaurant['contact_name']['value'] }}</td>
                                <td>{{ $restaurant['contact_phone']['value'] }}</td>
                                <td>{{ $restaurant['contact_email']['value'] }}</td>
                                <td>{{ $restaurant['food_type']['value'] }}</td>
                                <td>{{ $restaurant['collection_zone']['value'] }}</td>
                                <td>{{ $restaurant['banque_alimentaire_id']['value'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center">Aucun restaurant trouvé.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <h3 class="mt-4">Ajouter un Restaurant</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRestaurantModal">
            Ajouter le Restaurant
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="addRestaurantModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRestaurantModalLabel">Ajouter un Restaurant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('restaurants.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nom:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Adresse:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="city">Ville:</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Code Postal:</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_name">Nom du Contact:</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_phone">Téléphone du Contact:</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_email">Email du Contact:</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                            </div>
                            <div class="form-group">
                                <label for="food_type">Type de Nourriture:</label>
                                <input type="text" class="form-control" id="food_type" name="food_type" required>
                            </div>
                            <div class="form-group">
                                <label for="collection_zone">Zone de Collecte:</label>
                                <input type="text" class="form-control" id="collection_zone" name="collection_zone" required>
                            </div>
                            <div class="form-group">
                                <label for="banque_alimentaire_id">ID Banque Alimentaire:</label>
                                <input type="text" class="form-control" id="banque_alimentaire_id" name="banque_alimentaire_id" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ajouter le Restaurant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection