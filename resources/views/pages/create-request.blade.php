<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre prochaine destination</title>
    
    <!-- Updated Tailwind CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.24/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
</head>
<body > <!-- Background color changed -->
  <div class="container mx-auto mt-5">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-[#fbddca] shadow-md rounded-xl px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <!-- Success message -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Title of the form -->
                    <h5 class="text-lg font-bold mb-4 " style='color:#F96C57'>Create Request</h5> <!-- Title text color changed -->
                </div>
                <div class="card-body">
                    <!-- Form to create a new request for the logged-in association -->
                    <form action="{{ route('user.requests.store') }}" method="POST">
                        @csrf
                        <!-- Input for requested product -->
                        <div class="mb-4">
                            <label for="product_requested" class="block text-gray-700 text-sm font-bold mb-2 text-left">Produit demandé</label>
                            <input type="text" id="product_requested" name="product_requested" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Entrez le produit demandé" required>
                        </div>
                        <!-- Input for quantity -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2 text-left">Quantité</label>
                            <input type="number" id="quantity" name="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Entrez la quantité" required>
                        </div>
                        <!-- Dropdown for status -->
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2 text-left">Statut</label>
                            <select id="status" name="status" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="Pending">En attente</option>
                                <option value="Completed">Complété</option>
                            </select>
                        </div>
                        <!-- Submit button -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-[#8cc342]  text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"> <!-- Button color changed -->
                                Create 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Sticky navbar effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('nav');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Toggle table visibility
    function toggleTable(date) {
        const table = document.getElementById('table-' + date);
        table.classList.toggle('hidden');
    }

    // Scroll to section
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>

<style>
/* Sticky navbar styling */
.fixed {
    transition: background-color 0.3s ease;
}

.fixed.scrolled {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
</body>
</html>
