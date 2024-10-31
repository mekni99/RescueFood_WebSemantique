@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

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
                            </tr>
                        </thead>
      
    <tbody>
    @if(!empty($stocks['results']['bindings']))
    @foreach($stocks['results']['bindings'] as $stock)
        <tr>
            <td>{{ $stock['category']['value'] }}</td>
            <td>{{ $stock['quantity']['value'] }}</td>
            <td>{{ $stock['sub_category']['value'] }}</td>
        </tr>
    @endforeach
@else 
    <tr>
        <td colspan="4">Aucun stock trouvé.</td>
    </tr>
@endif

    </tbody>
</table>

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