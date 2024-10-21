
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre prochaine destination</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.4/dist/cdn.min.js" defer></script>
</head>
<body> 
<div class=" font-[sans-serif] min-h-screen flex flex-col items-center justify-center py-6 px-4" style="color:#FBCEB1;">
<header
      class='shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]  top-0 py-3 px-4 sm:px-10  z-50 min-h-[70px]'  style="color:#FBCEB1;">
      <div class='flex flex-wrap items-center gap-4'>
        <a href="javascript:void(0)"><img src="{{ asset('img/logo22.png') }}"alt="logo" class='w-36' />
        </a>

        <div id="collapseMenu"
          class='max-lg:hidden lg:!block max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
          <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
              <path
                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                data-original="#000000"></path>
              <path
                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                data-original="#000000"></path>
            </svg>
          </button>

          <ul
            class='lg:ml-12 lg:flex gap-x-6 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
            <li class='mb-6 hidden max-lg:block'>
              <a href="javascript:void(0)"><img src="{{ asset('img/logo (2).png') }}" alt="logo" class='w-36' />
              </a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'>
              <a href='javascript:void(0)'
                class='block font-semibold transition-all'  style="color:#F96C57;">Home</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'style="color:#F96C57;">About us</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'style="color:#F96C57;">Restaurant</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'style="color:#F96C57;">Association</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'style="color:#F96C57;">Contact Us</a>
            </li>
           
          </ul>

        </div>
        <div class='flex ml-auto'>
    <form role="form" method="POST" action="{{ route('logout') }}" id="logout-form" class="d-inline">
        @csrf
        <button type="submit" class='px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>
            <i class="fa fa-user me-sm-1"></i> Log Out
        </button>
    </form>

        </div>
      </div>
    </header>
    <div class="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full">
        <!-- Form Section -->
        <div class="border border-gray-300 rounded-lg p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
    <form action="{{ route('user.requests.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="mb-8">
            <h3 class="text-gray-800 text-3xl font-extrabold">Créer une Demande</h3>
            <p class="text-gray-500 text-sm mt-4 leading-relaxed">Soumettez une nouvelle demande en fournissant les informations nécessaires sur le produit et la quantité.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product Requested -->
        <div>
            <label for="product_requested" class="text-gray-800 text-sm mb-2 block">Produit demandé</label>
            <input type="text" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="product_requested" name="product_requested" required>
        </div>

        <!-- Quantity -->
        <div>
            <label for="quantity" class="text-gray-800 text-sm mb-2 block">Quantité</label>
            <input type="number" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="quantity" name="quantity" required>
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="text-gray-800 text-sm mb-2 block">Statut</label>
            <select class="form-select w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="status" name="status" required>
                <option value="Pending">En attente</option>
                <option value="Completed">Complété</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="!mt-8">
            <button type="submit" class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white focus:outline-none" style='background-color: #8cc342;'>Créer la demande</button>
        </div>
    </form>
    
</div>
 <!-- Image Section -->
     <div class="lg:h-[400px] md:h-[300px] max-md:mt-8">
            <img src="{{ asset('img/123333 (2).jpg') }}" class="rounded-xl w-full h-full max-md:w-4/5 mx-auto block object-cover" alt="Adding Destinataires" />
        </div>
    </div>
</div>
</div>

<!-- Script to dynamically add more destinataire fields -->
<script>
    document.getElementById('add-destinataire').addEventListener('click', function() {
        let form = document.querySelector('form');
        let newFields = `
            <div class="mt-4">
                <label for="first_name" class="text-gray-800 text-sm mb-2 block">Prénom du Destinataire</label>
                <input type="text" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="first_name" name="first_name[]" required>
            </div>
            <div>
                <label for="last_name" class="text-gray-800 text-sm mb-2 block">Nom du Destinataire</label>
                <input type="text" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="last_name" name="last_name[]" required>
            </div>
            <div>
                <label for="contact" class="text-gray-800 text-sm mb-2 block">Contact</label>
                <input type="text" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="contact" name="contact[]" required>
            </div>
            <div>
                <label for="address" class="text-gray-800 text-sm mb-2 block">Adresse</label>
                <input type="text" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="address" name="address[]" required>
            </div>
            <div>
                <label for="specific_needs" class="text-gray-800 text-sm mb-2 block">Besoins Spécifiques</label>
                <textarea class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" id="specific_needs" name="specific_needs[]" rows="3"></textarea>
            </div>
        `;
        form.insertAdjacentHTML('beforeend', newFields);
    });
</script>
</body>
</html>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('nav');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
<style>.fixed {
    transition: background-color 0.3s ease;
}

.fixed.scrolled {
    background-color: white; /* ou une couleur différente */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

 
.image-container {
    text-align: center;
    margin-top: 20px;
}
.mt-100 {
        margin-top: 00px;
    }

.image-container img {
    max-width: 100%;
    height: auto;
}

.custom-height {
    min-height: 700px; /* Ajustez la valeur selon vos besoins */
}
</style>
<script>
    function toggleTable(date) {
        const table = document.getElementById('table-' + date);
        // Toggle the 'hidden' class to show/hide the table
        table.classList.toggle('hidden');
    }
    

        function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);

        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    
</script><script>
    function toggleTable(date) {
        const table = document.getElementById(`table-${date}`);
        table.classList.toggle('hidden');
    }
</script>
