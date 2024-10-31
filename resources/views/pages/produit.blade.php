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
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    <span class="me-1"><i class="fas fa-plus"></i></span> Ajouter Produit
                </button>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    @if(!empty($produits['results']['bindings']))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom de l'Association</th>
                                    <th>Produit Demandé</th>
                                    <th>Quantité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits['results']['bindings'] as $produit)
                                    <tr>
                                        <td>{{ $produit['association_name']['value'] }}</td>
                                        <td>{{ $produit['product_requested']['value'] }}</td>
                                        <td>{{ $produit['quantity']['value'] }}</td>
                                        <td>
                                            
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Aucun produit trouvé.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Create New Product Modal -->
        <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Créer un nouveau produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produits.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="association_name">Nom de l'Association</label>
                                <input type="text" class="form-control" id="association_name" name="association_name" required>
                            </div>
                            <div class="form-group">
                                <label for="product_requested">Produit Demandé</label>
                                <input type="text" class="form-control" id="product_requested" name="product_requested" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantité</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn bg-gradient-success">Ajouter Produit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour la recherche -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('table tbody tr');

            function filterTable() {
                const filterValue = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const associationCell = row.cells[0].textContent.toLowerCase();
                    const match = associationCell.includes(filterValue);

                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
        });
    </script>
@endsection