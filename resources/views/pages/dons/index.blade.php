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
               

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600" style="margin-top: -5px">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="javascript:void(0)"><img src="{{ asset('img/logo22.png') }}"alt="logo" class='w-36' />
    </a>
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse " >
            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                @csrf
           
                <!-- Logout Button -->
                <button type="button" 
                    class="text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center " style='background-color: #8cc342;'
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </button>
            </form>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky" style="margin-top: -5px">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 px-3 text-white  rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page" style="color: #F96C57;">Home</a>
        </li>
        <li>
          <a href="/about-us" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
        </li>
        <li>
            <a href="#" onclick="scrollToSection('dons-show-section')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                Historique
            </a>
            
          </li>
          <li>
            <a href="/restaurant/profile#" onclick="scrollToSection('dons-show-section')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                Profile
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
                <section class="bg-white dark:bg-gray-900" style="margin-top: 70px">
                    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                        <div class="sm:text-center lg:text-left">
                            <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                Allez Y ...
                                <span style="color: #F96C57;"> nourrir ceux qui ont  le besoin </span>?
                            </h2>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg md:mt-5 md:text-xl lg:mx-0">
                                Faites un don pour soutenir ceux qui ont besoins d'aide.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="#search" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white focus:outline-none"style='background-color: #8cc342;'>Rechercher</a>
                                </div>
                            </div>
                        </div>
                        <div class="max-md:mt-12 h-full">
            <img src="{{ asset('img/téléchargement (15).jpg') }}" alt="banner img" class="w-full h-full object-cover" />
          </div>          </div>
                </section>

               
            </div>
        </div>
       
    </div>
    <section id="dons-show-section" class="p-8 mt-12 custom-height" style="background-color: #fbddca;">
        <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl md:text-4xl text-center mt-100" style="margin-top: 90px;">
            <span class="text-center mt-100" style="margin-top: 30px; color: #F96C57;">Votre historique de dons !!</span>
        </h2>
    
        @if(isset($message))
            <div class="text-center text-red-500 mt-4">{{ $message }}</div>
        @else
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">sub_category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de Préemption</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($donations as $don)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $don['userId']['value'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $don['category']['value'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $don['subCategory']['value'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $don['quantity']['value'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($don['datePreemption']['value'])->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
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
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl" style="color: #F96C57;">Prêt à aider?</h2>
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
                    <img src="https://www.keejob.com/media/recruiter/recruiter_7343/logo-croissant-rouge-tunisien-20141110-092435.jpg" class="h-48 w-full object-cover" alt="Berlin, Germany"/>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="text-sm font-medium text-indigo-600">Tunisia</div>
                            <a href="#" class="block">
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Tunis</h3>
                                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium.</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <img src="https://jamaity.org/wp-content/uploads/2020/05/%D8%AC%D9%85%D8%B9%D9%8A%D8%A9-%D8%A7%D9%84%D8%AA%D8%B9%D8%A7%D9%88%D9%86-%D8%A7%D9%84%D8%AE%D9%8A%D8%B1%D9%8A%D8%A9.jpg" class="h-48 w-full object-cover" alt="New York, United States"/>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-4 text-sm font-medium text-indigo-600">Tunisia</div>
                            <a href="#" class="block">
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Tunis</h3>
                                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium.</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <img src="https://linstant-m.tn//uploads/2941.png" class="h-48 w-full object-cover" alt="Tokyo, Japan"/>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-4 text-sm font-medium text-indigo-600">Tunisia</div>
                            <a href="#" class="block">
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Tunis</h3>
                                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="px-4 sm:px-10 py-12 mt-32" style="background-color: #fbddca;">
      <div class="grid max-sm:grid-cols-1 max-lg:grid-cols-2 lg:grid-cols-5 lg:gap-14 max-lg:gap-8">
        <div class="lg:col-span-2">
          <h4 class="text-xl font-semibold mb-6">About Us</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean gravida,
            mi eu pulvinar cursus, sem elit interdum mauris.</p>

          <div class="bg-[#f8f9ff] flex px-4 py-3 rounded-md text-left mt-4">
           
            <input type='email' placeholder='Search...'
              class="w-full outline-none bg-transparent text-gray-600 text-[15px]" />
          </div>
        </div>

        <div>
          <h4 class="text-xl font-semibold mb-6">Services</h4>
          <ul class="space-y-5">
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Web
                Development</a></li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Mobile App
                Development</a></li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">UI/UX
                Design</a></li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Digital Marketing</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-xl font-semibold mb-6">Resources</h4>
          <ul class="space-y-5">
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Webinars</a>
            </li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Ebooks</a>
            </li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Templates</a>
            </li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Tutorials</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-xl font-semibold mb-6">About Us</h4>
          <ul class="space-y-5">
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Our Story</a>
            </li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Mission and
                Values</a></li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Team</a></li>
            <li><a href="javascript:void(0)" class="hover:text-blue-600">Testimonials</a></li>
          </ul>
        </div>
      </div>

      <hr class="my-8" />

      <p class="text-center">
        Copyright © 2023
        <a href="https://readymadeui.com/" target="_blank" class="hover:underline mx-1">ReadymadeUI</a>
        All Rights Reserved.
      </p>
    </footer>
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
