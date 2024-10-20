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

    <div class="relative bg-white overflow-hidden">
        <div class="w-full mx-auto"> <!-- Remplacer max-w-screen-xl par w-full -->
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32" x-data="{ open: false }">
                <!-- Navbar -->
               

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
    </a>
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get started</button>
        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
        </li>
        <li>
            <a href="#" onclick="scrollToSection('dons-show-section')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                Services
            </a>
            
          </li>
          
        <li>
          <a href="#"   onclick="scrollToSection('dons-create-section')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Action</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
  

  


                <div x-show="open" @click.away="open = false" class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                    <div class="rounded-lg shadow-md">
                        <div class="rounded-lg bg-white shadow-xs overflow-hidden">
                            <div class="px-5 pt-4 flex items-center justify-between">
                                <div class="text-indigo-600 h-8 w-auto sm:h-10">🌍</div>
                                <div class="px-5 pt-4 flex items-center justify-between">
                                    <div>
                                    </div>
                                    <div class="-mr-2" @click="open = false">
                                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2 pt-2 pb-3">
                                <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900">Destinations</a>
                                <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900">Blog</a>
                                <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900">À propos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="bg-white dark:bg-gray-900">
                    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                        <div class="sm:text-center lg:text-left">
                            <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                Allez Y ...
                                <span class="text-indigo-600"> nourrir ceux qui en ont besoin </span>?
                            </h2>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg md:mt-5 md:text-xl lg:mx-0">
                                Faites un don pour soutenir ceux qui ont besoins d'aide.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="#search" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none">Rechercher</a>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <img class="w-full rounded-lg" src="https://readymadeui.com/photo.webp" alt="office content 1">
                            <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://readymadeui.com/photo.webp" alt="office content 2">
                        </div>
                    </div>
                </section>

               
            </div>
        </div>
       
    </div>

    <section id="dons-show-section" class="bg-blue-100 p-8 mt-12 custom-height" style="margin-top: 30px;">
        <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl md:text-4xl text-center mt-100" style="margin-top: 90px;">
            <span class="text-indigo-400 text-center mt-100 "style="margin-top: 30px;">Vos historique de dont !!</span>


        </h2>

        @foreach($donsGroupedByDate as $date => $dons)
        <div class="mt-12 bg-white rounded-lg shadow max-w-xs mx-auto ">
            <div class="p-4 cursor-pointer" onclick="toggleTable('{{ $date }}')">
                <h6 class="text-lg font-semibold text-center">Dons du {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h6>
            </div>
            <div class="collapse hidden" id="table-{{ $date }}"> <!-- Start hidden -->
                <div class="p-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                    <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sous-catégorie</th>
                                    <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($dons as $don)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap">{{ $don->category }}</td>
                                        <td class="px-2 py-2 whitespace-nowrap">{{ $don->sub_category }}</td>
                                        <td class="px-2 py-2 whitespace-nowrap">{{ $don->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="text-center my-4 mt-20">
            <button onclick="scrollToSection('dons-create-section')" class="inline-flex items-center px-10 py-5 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none">
                Ajouter un Don
            </button>
        </div>
</section>

<!-- Button to add a new donation -->

<div id="dons-create-section">
    @include('pages.dons.create', ['user_id' => $user_id]) <!-- Passez les variables nécessaires -->
</div>
    <div id="search" class="relative pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="absolute inset-0">
            <div class="bg-gray-50 h-1/3 sm:h-2/3"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Prêt à aider?</h2>
                <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-500 sm:mt-4">Recherchez une cause à soutenir et ajoutez-la à votre liste de dons.</p>
                <div class="mt-8">
                    <div class="relative rounded-md shadow-sm max-w-2xl mx-auto">
                        <input type="text" name="search" placeholder="Où aller ensuite ?" class="form-input block w-full pr-10 sm:text-xl sm:leading-8" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 2a9 9 0 100 18 9 9 0 000-18zM20 20l-4.35-4.35" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <img src="https://www.optifinance.net/wp-content/uploads/2023/02/AdobeStock_21819677-scaled.jpeg" class="h-48 w-full object-cover" alt="Berlin, Germany"/>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="text-sm font-medium text-indigo-600">Europe</div>
                            <a href="#" class="block">
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Berlin, Allemagne</h3>
                                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium.</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <img src="https://images.moneyvox.fr/i/media/12l/012756l7db.jpg" class="h-48 w-full object-cover" alt="New York, United States"/>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-4 text-sm font-medium text-indigo-600">North America</div>
                            <a href="#" class="block">
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">New York, États-Unis</h3>
                                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium.</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1xRYzVX6RkQo4xh24qnQzxGvEO8GXx2a9OjwV3YoAPRuicSe_C6yXOC0zQ9gPKxWAzX0&usqp=CAU" class="h-48 w-full object-cover" alt="Tokyo, Japan"/>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-4 text-sm font-medium text-indigo-600">Asia</div>
                            <a href="#" class="block">
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Tokyo, Japon</h3>
                                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
