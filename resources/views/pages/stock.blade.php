@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Stock Management'])

    <div class="container-fluid py-4">
        <h1>Stock Management</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="card mb-4">
            
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div class="form-group mb-3">
    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
</div>
                <h6>Stock Items</h6>
               
                
                <button type="button" class="btn btn-success btn-sm d-flex align-items-center mx-1" data-bs-toggle="modal" data-bs-target="#createNewItemModal" style="padding: 0.375rem 0.75rem;">
                    <span class="me-1"><i class="fas fa-plus"></i></span>
                    Add
                </button>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">sous-Category</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                    <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/img/icons8-boîte-50.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->category }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="d-flex px-2 py-1">
                                            
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->sub_category }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if($item->quantity == 0)
                                            <span class="badge badge-sm bg-gradient-danger">Out of stock</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-success">{{ $item->quantity }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                            <span class="me-1"><i class="fas fa-edit"></i></span>
                                            Edit
                                        </button>
                                        <form action="{{ route('stock.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <span class="me-1"><i class="fas fa-trash"></i></span>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Item Modal -->
                                <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editItemModalLabel{{ $item->id }}">Edit Stock Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('stock.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="category">Category</label>
                                                        <input type="text" class="form-control" id="category" name="category" value="{{ $item->category }}" required>
                                                    </div>
                                                    <div class="form-group">
    <label for="sub_category">Sous-Category</label>
    <input type="text" class="form-control" id="sub_category" name="sub_category" value="{{ $item->sub_category }}" required>
</div>

                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}" required>
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn bg-gradient-success">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                    @if($items->isEmpty())
                        <div class="text-center">
                            <p class="text-sm text-secondary">No items found.</p>
                        </div>
                    @endif
                </div>
            </div>
           

     
        </div>
 
        <!-- Create New Stock Item Modal -->
        <div class="modal fade" id="createNewItemModal" tabindex="-1" aria-labelledby="createNewItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createNewItemModalLabel">Create New Stock Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('stock.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>
                            <div class="form-group">
                                <label for="sub_category">sous-Category</label>
                                <input type="text" class="form-control" id="sub_category" name="sub_category" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-success">Add Stock Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="stockChart" width="400" height="200"></canvas>
<script>
    const ctx = document.getElementById('stockChart').getContext('2d');

    // Définir les couleurs
    const backgroundColors = [
        'rgba(255, 99, 132, 0.2)', // Rose
        'rgba(255, 159, 64, 0.2)', // Orange
        'rgba(75, 192, 192, 0.2)'  // Vert
    ];

    const borderColors = [
        'rgba(255, 99, 132, 1)', // Rose
        'rgba(255, 159, 64, 1)', // Orange
        'rgba(75, 192, 192, 1)'  // Vert
    ];

    // Créer un tableau pour les couleurs en fonction du nombre de catégories
    const backgroundColorData = @json($categories).map((_, index) => backgroundColors[index % backgroundColors.length]);
    const borderColorData = @json($categories).map((_, index) => borderColors[index % borderColors.length]);

    const stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($categories), // Catégories
            datasets: [{
                label: 'Quantité',
                data: @json($quantities), // Quantités
                backgroundColor: backgroundColorData, // Couleurs de fond
                borderColor: borderColorData, // Couleurs de bord
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('table tbody tr');

        function filterTable() {
            const filterValue = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const categoryCell = row.cells[0].textContent.toLowerCase();
                const subCategoryCell = row.cells[1].textContent.toLowerCase();

                // Vérifier si la valeur de recherche est dans la catégorie ou la sous-catégorie
                const match = categoryCell.includes(filterValue) || subCategoryCell.includes(filterValue);

                if (match) {
                    row.style.display = ''; // Afficher la ligne
                } else {
                    row.style.display = 'none'; // Cacher la ligne
                }
            });
        }

        // Écouter les événements de saisie
        searchInput.addEventListener('input', filterTable);
    });
</script>



@endsection
