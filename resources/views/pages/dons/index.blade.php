@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Historique des dons'])

<div class="container">
    <h2 class="mt-4 text-primary font-weight-bold">Historique des dons pour le restaurant {{ auth()->user()->username }}</h2>

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

    <!-- Boucle à travers chaque groupe de dons classés par date -->
    @foreach($donsGroupedByDate as $date => $dons)
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <!-- En-tête cliquable indépendant des cartes -->
            <div class="don-header-container">
                <h6 class="mb-2 text-header" style="cursor: pointer;" onclick="toggleTable('{{ $date }}')">
                    Dons du {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                </h6>
            </div>

            <!-- Table des dons, initialement masquée -->
            <div class="table-responsive dons-table" id="table-{{ $date }}" style="display: none;">
                <table class="table align-items-center">
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Date d'ajout</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dons as $don)
                            <tr>
                                <td>{{ $don->category }}</td>
                                <td>{{ $don->quantity }}</td>
                                <td>{{ $don->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach

    <!-- Bouton pour ajouter un nouveau don -->
    <a href="{{ route('dons.create', ['user_id' => auth()->user()->id]) }}" class="btn btn-primary mt-3">Ajouter un Don</a>
</div>

<!-- Liens Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- JavaScript pour afficher/masquer les tables -->
<script>
    // Fonction pour afficher/masquer la table des dons
    function toggleTable(date) {
        // Masquer toutes les tables de dons
        document.querySelectorAll('.dons-table').forEach(function(table) {
            table.style.display = 'none';
        });

        // Afficher ou masquer la table correspondant à la date sélectionnée
        const selectedTable = document.getElementById('table-' + date);
        if (selectedTable.style.display === 'none') {
            selectedTable.style.display = 'table';
        } else {
            selectedTable.style.display = 'none';
        }
    }
</script>
<style>
    .text-header {
        background-color: #789dc5; /* Couleur d'arrière-plan (bleu par défaut) */
        color: #fff; /* Couleur du texte */
        padding: 15px; /* Espacement intérieur pour un design plus propre */
        border-radius: 8px; /* Coins arrondis pour un effet moderne */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Ombre pour donner du relief */
        text-align: center; /* Centrer le texte */
        font-size: 1.2rem; /* Taille du texte légèrement agrandie */
        width: 100%; /* Prend toute la largeur disponible */
        max-width: 600px; /* Largeur maximale */
        margin: 0 auto; /* Centrer horizontalement l'en-tête */
        transition: background-color 0.3s ease; /* Animation pour un changement de couleur fluide */
    }

    .text-header:hover {
        background-color: #356fae; /* Couleur différente lors du survol */
    }
</style>
@endsection
