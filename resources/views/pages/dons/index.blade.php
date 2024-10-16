@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

<div class="container">
    <h2 class="mt-4">Historique des dons pour le restaurant {{ auth()->user()->Username }}</h2> <!-- Assurez-vous d'avoir un champ 'name' dans votre modèle User -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Liste des Dons</h5>
        </div>
        <div class="card-body">
            @if($dons->isEmpty())
                <div class="alert alert-info">
                    Aucun don trouvé pour ce restaurant.
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dons as $don)
                            <tr>
                                <td>{{ $don->category }}</td>
                                <td>{{ $don->quantity }}</td>
                                <td>{{ $don->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('dons.create', auth()->user()->id) }}" class="btn btn-primary mt-3">Ajouter un Don</a>
        </div>
    </div>
</div><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery, Popper.js et Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
