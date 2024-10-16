@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'ajouter un don'])
<div class="container">
 <div class="card mt-4">
        <div class="card-header">
    <h2>Ajouter des dons pour le restaurant {{ $restaurant_id }}
    <h2>  the restaurant name is {{ auth()->user()->username }}</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form id="donForm" action="{{ route('don.store', $restaurant_id) }}" method="POST">
        @csrf

        <div id="donItems">
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="category">Catégorie</label>
                    <select name="category[]" class="form-control" required>
                        <option value="" disabled selected>Choisissez une catégorie</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Légumes">Légumes</option>
                        <option value="Poisson">Poisson</option>
                        <option value="Viande">Viande</option>
                        <!-- Ajoutez d'autres options si nécessaire -->
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="quantity">Quantité</label>
                    <input type="number" name="quantity[]" class="form-control" min="1" required>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-danger remove-item" style="margin-top: 2rem;">Supprimer</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="addItemBtn">Ajouter une autre catégorie</button>
        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
</div>
</div>
</div>



<!-- Liens Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Liens Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('addItemBtn').addEventListener('click', function() {
        const donItems = document.getElementById('donItems');
        const newItem = document.createElement('div');
        newItem.classList.add('form-group', 'row');
        newItem.innerHTML = `
            <div class="col-md-5">
                <label for="category">Catégorie</label>
                <select name="category[]" class="form-control" required>
                    <option value="" disabled selected>Choisissez une catégorie</option>
                    <option value="Fruits">Fruits</option>
                    <option value="Légumes">Légumes</option>
                    <option value="Poisson">Poisson</option>
                    <option value="Viande">Viande</option>
                    <!-- Ajoutez d'autres options si nécessaire -->
                </select>
            </div>
            <div class="col-md-5">
                <label for="quantity">Quantité</label>
                <input type="number" name="quantity[]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-danger remove-item" style="margin-top: 2rem;">Supprimer</button>
            </div>
        `;
        donItems.appendChild(newItem);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.form-group').remove();
        }
    });
</script>
@endsection
