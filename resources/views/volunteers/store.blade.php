<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>

  <style>
   body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #121215;
            color: white;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            font-size: 3rem; /* Increased font size */
            font-weight: bold; /* Make text bold */
            margin: 0;
        }

        .typing {
            color: white; /* Color for the typing text */
            font-weight: bold; /* Make typing text bold */
            display: inline; /* Keep it inline with the surrounding text */
        }
  </style>
</head>

<body class="max-w-[1920px] mx-auto">
  <div class="bg-[#FBCEB1] text-black text-[15px]">
  <header
      class='shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]  top-0 py-3 px-4 sm:px-10 bg-transparent z-50 min-h-[70px]'>
      <div class='flex flex-wrap items-center gap-4'>
        <a href="javascript:void(0)"><img src="{{ asset('img/logo (2).png') }}"alt="logo" class='w-36' />
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
                class='hover:text-white block font-semibold transition-all'style='color: #F96C57;'>Home</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='hover:ttext-white block font-semibold transition-all'style='color: #F96C57;'>About us</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='hover:text-white block font-semibold transition-all'style='color: #F96C57;'>Restaurant</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='hover:text-white block font-semibold transition-all'style='color: #F96C57;'>Association</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='hover:text-white block font-semibold transition-all'style='color: #F96C57;'>Contact Us</a>
            </li>
          </ul>
        </div>

        <div class='flex ml-auto'>
          <button id="toggleOpen" class='lg:hidden ml-7'>
            <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>
      </div>
    </header>

    <div class="px-4 sm:px-10">
      <div class="min-h-[500px]">
        <div class="grid md:grid-cols-2 justify-center items-center gap-10">
          <div class="max-md:order-1">
              <h1 class="md:text-6xl text-4xl font-extrabold mb-6 md:!leading-[75px]" style='color: white;'>
        قَالَ رَسُولُ اللهِ ﷺ: <span class="typing" id="typed"></span>
    </h1>

    <script>
        const options = {
            strings: ['خَيْرُ النَّاسِ أَنْفَعُهُمْ لِلنَّاسِ'], // Text to type
            typeSpeed: 50, // Speed of typing
            backSpeed: 20, // Speed of deleting (if you want it to delete)
            backDelay: 1000, // Delay before starting to delete
            loop: true // Set to true if you want it to loop
        };

        const typed = new Typed('#typed', options);
    </script>                   <h1 class="text-2xl font-bold "style='color: #F96C57;'>Access food donations for your beneficiaries by joining RescueFood. Help us fight hunger and improve the lives of the most vulnerable.</h1>
 <div class="mt-20"> 
        <button class='px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>Get started</button>
    </div>
           
          </div>
          
          <div class="max-md:mt-12 h-full">
            <img src="{{ asset('img/123333 (1).jpg') }}" alt="banner img" class="w-full h-full object-cover" />
          </div>
        </div>
      </div>

    <div class=" px-6 py-12 ">
      <div class="lg:max-w-7xl max-w-lg mx-auto px-6 py-8  rounded-lg shadow-md" style='background-color: #fbddca;'>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
          <div class="max-h-90">
            <img src="{{ asset('img/b91c2705-b249-4428-bb94-d543f4324202.jpg') }}" alt="Image" class="rounded-md object-cover w-full h-full" />
          </div>
          <div class="pt-10">
    <h2 class="text-3xl font-extrabold mb-4" style="color: #F98128;">How it works?</h2>
    <ul class="list-decimal text-lg text-gray-600 space-y-6 pl-0 mt-6"> 
        <li>Register your charitable organization.</li>
        <li>Browse available food donations in your area.</li>
        <li>Request donations based on the needs of your beneficiaries.</li>
        <li>Schedule a pickup or delivery via our logistics network.</li>
    </ul>
    <div class="pt-20">
    <h4 class="text-3xl font-extrabold mb-4" style='color: #F98128;'>
    "مَنْ كَانَ فِي حَاجَةِ أَخِيهِ كَانَ اللَّهُ فِي حَاجَتِهِ"
    </h4>
    </div>
    <div class="mt-20"> 
        <button class='px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>Get started</button>
    </div>
</div>

        </div>
      </div>
    </div>
   
   
        <div class="bg-[#fbddca] font-sans  px-6 py-12 ">
            <div class="lg:max-w-5xl max-w-3xl mx-auto">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="* text-3xl font-extrabold" style='color: #F96C57;' >Your Volunteers </h2>
                </div>

                <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-6 max-md:justify-center mt-12">
                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/1.jpg') }}" class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Adam Carter</h4>
                        </div>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/4.jpg') }}"class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Emma Collins</h4>

                        </div>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/3.jpg') }}" class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Sophia Bennett</h4>

                           
                        </div>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/2.jpg') }}" class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Lily Matthews</h4>

                           
                        </div>
                    </div>
                </div>
                <div class="mt-20"> 
                <a href="{{ route('volunteers.create') }}">
    <button class="px-6 py-3 rounded-xl text-white" style="background-color: #8cc342;">
        Add Volunteers
    </button>
</a>

    </div>
            </div>
        </div>
     <div class="font-sans  px-6 py-12 ">
            <div class="lg:max-w-5xl max-w-3xl mx-auto">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="* text-3xl font-extrabold" style='color: #F96C57;' >Our Volunteer Restaurants</h2>
                </div>

                <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-6 max-md:justify-center mt-12">
                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/4444444.jpg') }}" class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">The Urban Fork</h4>
                        </div>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/123333 (3).jpg') }}"class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Harvest Table</h4>

                        </div>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/123333 (2).jpg') }}" class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Savory Haven</h4>

                           
                        </div>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ asset('img/2333.jpg') }}" class="w-full h-56 object-cover" />

                        <div class="p-4">
                            <h4 class="text-gray-800 text-base font-bold">Flavorscape</h4>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
     <footer class="bg-[#fbddca] px-4 sm:px-10 py-12 mt-32">
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

  </div>

  <script>

    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
      if (collapseMenu.style.display === 'block') {
        collapseMenu.style.display = 'none';
      } else {
        collapseMenu.style.display = 'block';
      }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);

  </script>
</body>

</html>