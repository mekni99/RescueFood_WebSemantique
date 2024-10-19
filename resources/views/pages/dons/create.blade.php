<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre prochaine destination</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.4/dist/cdn.min.js" defer></script>
    <style>
        #donItems {
            max-height: 400px; /* Ajustez cette valeur selon vos besoins */
            overflow-y: auto; /* Permet le défilement vertical */
        }
    </style>
</head>

<body>
    <div class="font-[sans-serif] lg:flex lg:items-center lg:justify-center lg:h-screen max-lg:py-4">
        <div class="bg-purple-100 p-8 w-full max-w-5xl max-lg:max-w-xl mx-auto rounded-md">
            <h2 class="text-3xl font-extrabold text-gray-800 text-center">Faire un don</h2>

            <form id="donForm" action="{{ route('don.store', $user_id) }}" method="POST" class="mt-8">
                @csrf

                <div id="donItems">
                    <div class="lg:col-span-1">
                        <div class="grid gap-4">
                            <div>
                                <label for="food_type" class="block mb-2 font-bold text-gray-800">Type de nourriture</label>
                                <select name="category[]" class="px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none" onchange="populateSubtypes(this)" required>
                                    <option value="" disabled selected>Choisissez un type d'aliment</option>
                                    <option value="Fruits">Fruits</option>
                                    <option value="Légumes">Légumes</option>
                                    <option value="Produits laitiers">Produits laitiers</option>
                                    <option value="Viandes et substituts">Viandes et substituts</option>
                                    <option value="Produits céréaliers">Produits céréaliers</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Boissons">Boissons</option>
                                    <option value="Épices et condiments">Épices et condiments</option>
                                    <option value="Desserts">Desserts</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div>
                                <label for="food_subtype" class="block mb-2 font-bold text-gray-800">Sous-catégorie</label>
                                <input type="text" class="px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none" placeholder="Rechercher une sous-catégorie" onkeyup="filterSubtypes(this)">
                                <select name="food_subtype[]" class="mt-2 px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none food-subtype-selector" required>
                                    <option value="" disabled selected>Choisissez une sous-catégorie</option>
                                    <!-- Options peuplées dynamiquement -->
                                </select>
                            </div>

                            <div>
                                <label for="quantity" class="block mb-2 font-bold text-gray-800">Quantité</label>
                                <input type="number" name="quantity[]" class="px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none" min="1" required>
                            </div>

                            <div class="flex items-center">
                                <label>&nbsp;</label>
                                <button type="button" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-700	 hover:bg-indigo-500 focus:outline-none">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="mt-4 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700" id="addItemBtn">Ajouter un autre aliment</button>
                <button type="submit"  class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-800		 hover:bg-indigo-500 focus:outline-none">Soumettre</button>
            </form>
        </div>
    </div>

    <script>
        // Options des sous-catégories pour chaque type de nourriture
        const foodSubtypeOptions = {
            "Fruits": ['Pommes', 'Bananes', 'Oranges', 'Fraises', 'Raisins', 'Mangues', 'Pêches', 'Kiwi'],
            "Légumes": ['Carottes', 'Tomates', 'Concombres', 'Brocolis', 'Épinards', 'Poivrons', 'Courgettes'],
            "Produits laitiers": ['Lait', 'Fromage', 'Yaourt', 'Crème'],
            "Viandes et substituts": ['Poulet', 'Boeuf', 'Poisson', 'Tofu', 'Tempeh'],
            "Produits céréaliers": ['Pain', 'Riz', 'Pâtes', 'Quinoa', 'Couscous'],
            "Snacks": ['Chips', 'Barres granola', 'Pizzas congelées', 'Plats cuisinés'],
            "Boissons": ['Eau', 'Jus de fruits', 'Soda', 'Thé', 'Café'],
            "Épices et condiments": ['Sel', 'Poivre', 'Huile d\'olive', 'Vinaigre', 'Moutarde', 'Ketchup'],
            "Desserts": ['Gâteaux', 'Glaces', 'Chocolats', 'Biscuits'],
            "Autre": ['Autres aliments divers']
        };

        // Fonction pour peupler les sous-catégories en fonction du type sélectionné
        function populateSubtypes(selector) {
            const selectedType = selector.value;
            const subtypeSelect = selector.closest('.grid').querySelector('.food-subtype-selector');
            subtypeSelect.innerHTML = '<option value="" disabled selected>Choisissez une sous-catégorie</option>';

            if (foodSubtypeOptions[selectedType]) {
                foodSubtypeOptions[selectedType].forEach(subtype => {
                    const option = document.createElement('option');
                    option.value = subtype;
                    option.textContent = subtype;
                    subtypeSelect.appendChild(option);
                });
            }
        }

        // Fonction pour filtrer les sous-catégories
        function filterSubtypes(input) {
            const filter = input.value.toLowerCase();
            const subtypeSelect = input.closest('.grid').querySelector('.food-subtype-selector');
            const options = subtypeSelect.querySelectorAll('option');

            options.forEach(option => {
                option.style.display = "none"; // Masque toutes les options
            });

            subtypeSelect.querySelector('option').style.display = ""; // Affiche l'option par défaut

            options.forEach(option => {
                if (option.value.toLowerCase().includes(filter)) {
                    option.style.display = ""; // Affiche l'option si elle correspond à la recherche
                }
            });

            if (filter === "") {
                options.forEach(option => {
                    option.style.display = ""; // Affiche toutes les options si la recherche est vide
                });
            }
        }

        document.getElementById('addItemBtn').addEventListener('click', function() {
            const donItems = document.getElementById('donItems');
            const newItem = document.createElement('div');
            newItem.classList.add('lg:col-span-1');
            newItem.innerHTML = `
                <div class="grid gap-4">
                    <div>
                        <label for="food_type" class="block mb-2 font-bold text-gray-800">Type de nourriture</label>
                        <select name="category[]" class="px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none" onchange="populateSubtypes(this)" required>
                            <option value="" disabled selected>Choisissez un type d'aliment</option>
                            <option value="Fruits">Fruits</option>
                            <option value="Légumes">Légumes</option>
                            <option value="Produits laitiers">Produits laitiers</option>
                            <option value="Viandes et substituts">Viandes et substituts</option>
                            <option value="Produits céréaliers">Produits céréaliers</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Boissons">Boissons</option>
                            <option value="Épices et condiments">Épices et condiments</option>
                            <option value="Desserts">Desserts</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div>
                        <label for="food_subtype" class="block mb-2 font-bold text-gray-800">Sous-catégorie</label>
                        <input type="text" class="px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none" placeholder="Rechercher une sous-catégorie" onkeyup="filterSubtypes(this)">
                        <select name="food_subtype[]" class="mt-2 px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none food-subtype-selector" required>
                            <option value="" disabled selected>Choisissez une sous-catégorie</option>
                        </select>
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 font-bold text-gray-800">Quantité</label>
                        <input type="number" name="quantity[]" class="px-4 py-3.5 bg-white text-gray-800 w-full text-sm border rounded-md focus:border-[#007bff] outline-none" min="1" required>
                    </div>
                    <div class="flex items-center">
                        <label>&nbsp;</label>
                        <button type="button" class="remove-item px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Supprimer</button>
                    </div>
                </div>`;
            donItems.appendChild(newItem);
        });

        document.getElementById('donForm').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-item')) {
                event.target.closest('div.lg:col-span-1').remove();
            }
        });
    </script>
</body>
</html>
