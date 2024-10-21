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
                class='text-white block font-semibold transition-all'>Home</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'>About us</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'>Restaurant</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'>Association</a>
            </li>
            <li class='max-lg:border-b max-lg:py-3 px-3'><a href='javascript:void(0)'
                class='text-white block font-semibold transition-all'>Contact Us</a>
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
        <div class='flex ml-auto'>
        <a href="{{ route('sign-in-static') }}">
    <button class='mr-6 font-semibold border-none outline-none px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>Login</button>
</a>

<a href="{{ route('sign-up-static') }}">
    <button class='px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>Sign up</button>
</a>

        </div>
      </div>
    </header>

<div class="relative bg-gradient-to-r from-[#FBCEB1] to-[#FBEDE3] py-24 md:py-40 font-[sans-serif]">
  <div class="absolute inset-0">
    <img src="{{ asset('img/Main.jpg') }}" alt="Background Image" class="w-full h-full object-cover opacity-50" />
  </div>

  <div class="relative max-w-screen-xl mx-auto px-8 z-10 text-center text-white">
  <h1 class="md:text-6xl text-4xl font-extrabold mb-6 md:!leading-[100px]" style='color: white;'>
      <span class="typing" id="typed"></span>
    </h1>

    <script>
    const options = {
        strings: ['عسلامة', 'Welcome'], // Multiple text options
        typeSpeed: 50, // Speed of typing
        backSpeed: 20, // Speed of deleting (if you want it to delete)
        backDelay: 1000, // Delay before starting to delete
        loop: true // Set to true if you want it to loop
    };

    const typed = new Typed('#typed', options);
</script>       <p class="text-xl font-bold md:text-2xl mb-12" style='color: white;' >Access food donations for your beneficiaries by joining RescueFood. Help us fight hunger and improve the lives of the most vulnerable.</p>
<div class="mt-20 flex justify-center space-x-6">
    <a href="#restaurant-section">
        <button class='px-10 py-5 rounded-xl text-white font-bold' style='background-color: #8cc342;'>Restaurant</button>
    </a>
    <a href="#association-section">
        <button class='px-10 py-5 rounded-xl text-white font-bold' style='background-color: #8cc342;'>Association</button>
    </a>
</div>

  </div>
</div>

<div class="bg-[#FFFFFF] font-[sans-serif]">
      <div class="max-w-6xl mx-auto py-16 px-4">
        <h2 class=" text-4xl font-extrabold text-center mb-16" style='color: #F96C57;'>Benefits for Both User</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-md:max-w-md mx-auto">
          <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all" style='background-color: #fbddca;'>
            <div class="p-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#8cc342" class="w-8 mb-6 inline-block" viewBox="0 0 512.001 512.001">
              <path d="M271.029 0c-33.091 0-61 27.909-61 61s27.909 61 61 61 60-27.909 60-61-26.909-61-60-61zm66.592 122c-16.485 18.279-40.096 30-66.592 30-26.496 0-51.107-11.721-67.592-30-14.392 15.959-23.408 36.866-23.408 60v15c0 8.291 6.709 15 15 15h151c8.291 0 15-6.709 15-15v-15c0-23.134-9.016-44.041-23.408-60zM144.946 460.404 68.505 307.149c-7.381-14.799-25.345-20.834-40.162-13.493l-19.979 9.897c-7.439 3.689-10.466 12.73-6.753 20.156l90 180c3.701 7.423 12.704 10.377 20.083 6.738l19.722-9.771c14.875-7.368 20.938-25.417 13.53-40.272zM499.73 247.7c-12.301-9-29.401-7.2-39.6 3.9l-82 100.8c-5.7 6-16.5 9.6-22.2 9.6h-69.901c-8.401 0-15-6.599-15-15s6.599-15 15-15h60c16.5 0 30-13.5 30-30s-13.5-30-30-30h-78.6c-7.476 0-11.204-4.741-17.1-9.901-23.209-20.885-57.949-30.947-93.119-22.795-19.528 4.526-32.697 12.415-46.053 22.993l-.445-.361-21.696 19.094L174.28 452h171.749c28.2 0 55.201-13.5 72.001-36l87.999-126c9.9-13.201 7.2-32.399-6.299-42.3z" data-original="#000000" />
            </svg>
              <h3 class=" text-xl font-semibold mb-3" style='color: #8cc342;'>Reduce Food Waste</h3>
              <p class="text-gray-500 text-sm leading-relaxed">Easily list excess food and reduce disposal costs.</p>
            </div>
          </div>

          <div class=" rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all" style='background-color: #fbddca;'>
            <div class="p-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#8cc342" class="w-8 mb-6 inline-block" viewBox="0 0 512.001 512.001">
              <path d="M271.029 0c-33.091 0-61 27.909-61 61s27.909 61 61 61 60-27.909 60-61-26.909-61-60-61zm66.592 122c-16.485 18.279-40.096 30-66.592 30-26.496 0-51.107-11.721-67.592-30-14.392 15.959-23.408 36.866-23.408 60v15c0 8.291 6.709 15 15 15h151c8.291 0 15-6.709 15-15v-15c0-23.134-9.016-44.041-23.408-60zM144.946 460.404 68.505 307.149c-7.381-14.799-25.345-20.834-40.162-13.493l-19.979 9.897c-7.439 3.689-10.466 12.73-6.753 20.156l90 180c3.701 7.423 12.704 10.377 20.083 6.738l19.722-9.771c14.875-7.368 20.938-25.417 13.53-40.272zM499.73 247.7c-12.301-9-29.401-7.2-39.6 3.9l-82 100.8c-5.7 6-16.5 9.6-22.2 9.6h-69.901c-8.401 0-15-6.599-15-15s6.599-15 15-15h60c16.5 0 30-13.5 30-30s-13.5-30-30-30h-78.6c-7.476 0-11.204-4.741-17.1-9.901-23.209-20.885-57.949-30.947-93.119-22.795-19.528 4.526-32.697 12.415-46.053 22.993l-.445-.361-21.696 19.094L174.28 452h171.749c28.2 0 55.201-13.5 72.001-36l87.999-126c9.9-13.201 7.2-32.399-6.299-42.3z" data-original="#000000" />
            </svg>
              <h3 class=" text-xl font-semibold mb-3"style='color: #8cc342;'>Corporate Social Responsibility</h3>
              <p class="text-gray-500 text-sm leading-relaxed">Enhance your restaurant’s image by contributing to your community</p>
            </div>
          </div>

          <div class=" rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all" style='background-color: #fbddca;'>
            <div class="p-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#8cc342" class="w-8 mb-6 inline-block" viewBox="0 0 512.001 512.001">
              <path d="M271.029 0c-33.091 0-61 27.909-61 61s27.909 61 61 61 60-27.909 60-61-26.909-61-60-61zm66.592 122c-16.485 18.279-40.096 30-66.592 30-26.496 0-51.107-11.721-67.592-30-14.392 15.959-23.408 36.866-23.408 60v15c0 8.291 6.709 15 15 15h151c8.291 0 15-6.709 15-15v-15c0-23.134-9.016-44.041-23.408-60zM144.946 460.404 68.505 307.149c-7.381-14.799-25.345-20.834-40.162-13.493l-19.979 9.897c-7.439 3.689-10.466 12.73-6.753 20.156l90 180c3.701 7.423 12.704 10.377 20.083 6.738l19.722-9.771c14.875-7.368 20.938-25.417 13.53-40.272zM499.73 247.7c-12.301-9-29.401-7.2-39.6 3.9l-82 100.8c-5.7 6-16.5 9.6-22.2 9.6h-69.901c-8.401 0-15-6.599-15-15s6.599-15 15-15h60c16.5 0 30-13.5 30-30s-13.5-30-30-30h-78.6c-7.476 0-11.204-4.741-17.1-9.901-23.209-20.885-57.949-30.947-93.119-22.795-19.528 4.526-32.697 12.415-46.053 22.993l-.445-.361-21.696 19.094L174.28 452h171.749c28.2 0 55.201-13.5 72.001-36l87.999-126c9.9-13.201 7.2-32.399-6.299-42.3z" data-original="#000000" />
            </svg>
              <h3 class=" text-xl font-semibold mb-3" style='color: #8cc342;'>Access Fresh Food</h3>
              <p class="text-gray-500 text-sm leading-relaxed">Receive donations of quality, surplus food from local restaurants</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="restaurant-section" class="font-sans max-w-6xl max-md:max-w-md mx-auto mt-16">
  <div class="grid md:grid-cols-2 items-center md:gap-8 gap-6">
    <!-- Column for Text -->
    <div class="md:order-1 max-md:order-2 max-md:text-center z-50 relative mr-10">
      <h2 class="text-white lg:text-6xl md:text-5xl text-3xl font-extrabold mb- md:!leading-[56px] text-left">
        For <span style="color: #F96C57;">Restaurant</span>
      </h2>
      <p class="max-w-md font-bold sm:text-xl mt-4 md:mt-6 md:max-w-3xl" style="color:white; text-align: left;">
        <span style="color: #8cc342;">Step 1 </span>: List Your Surplus Food
      </p>
      <p class="text-left text-gray-500 mb-6">Easily upload your unsold or surplus food through the platform, categorizing and specifying quantities to ensure transparency.</p>
      <p class="max-w-md font-bold sm:text-xl mt-4 md:mt-6 md:max-w-3xl" style="color:white; text-align: left;">
        <span style="color: #8cc342;">Step 2:</span> Schedule a Pickup
      </p>
      <p class="text-left text-gray-500 mb-6">Set a convenient time for local charities to collect your donations, aligning the pickup with your restaurant’s hours.</p>
      <p class="max-w-md font-bold sm:text-xl mt-4 md:mt-6 md:max-w-3xl" style="color:white; text-align: left;">
        <span style="color: #8cc342;">Step 3:</span> Make a Difference
      </p>
      <p class="text-left text-gray-500">See your surplus food transformed into meals for people in need, reducing waste while making a positive community impact.</p>
      <a href="{{ route('sign-in-static') }}">
      <button type="button" class="mt-6 transition-all text-white text-left font-semibold text-sm tracking-wide rounded-md px-6 py-2.5" style="background-color: #8cc342;">Get Started</button>
  </a></div>

    <!-- Column for Image -->
    <div class="md:order-2 max-md:order-1 lg:h-[550px] md:h-[550px] flex items-center relative max-md:before:hidden before:absolute before:bg-[#fbddca] before:h-[120%] before:w-[120%] before:right-0 before:z-0 ml-10">
      <img src="{{ asset('img/resto1.jpg') }}" class="rounded-md lg:w-4/5 z-50 relative" alt="Dining Experience" />
    </div>
  </div>
</div>


    <div id="association-section" class="font-sans max-w-6xl max-md:max-w-md mx-auto">
  <div class="grid md:grid-cols-2 items-center md:gap-8 gap-6">
    <!-- Image on the left -->
    <div class="lg:h-[550px] md:h-[550px] flex items-center relative max-md:before:hidden before:absolute before:bg-[#fbddca] before:h-[120%] before:w-[120%] before:right-0 before:z-0">
      <img src="{{ asset('img/sss.jpg') }}" class="rounded-md lg:w-4/5 z-50 relative" alt="Dining Experience" />
    </div>

    <!-- Text on the right -->
    <div class="max-md:order-1 max-md:text-center z-50 relative">
      <h2 class="text-white lg:text-6xl md:text-5xl text-3xl font-extrabold mb-4 md:!leading-[56px] ">
        For <span style="color: #F96C57;">Association</span>
      </h2>
      <p class="max-w-md font-bold sm:text-xl mt-4 md:mt-6 md:max-w-3xl" style="color:white ; text-align: left;">
          <span style="color: #8cc342;">Step 1 </span>: Browse Available Donations</p>
          <p class="text-left text-gray-500 ">Access real-time listings of food donations from nearby restaurants and suppliers, with detailed descriptions of available items.</p>
          <p class="max-w-md font-bold sm:text-xl mt-4 md:mt-6 md:max-w-3xl" style="color:white ; text-align: left;">
          <span style="color: #8cc342;"> Step 2:</span> Request Food Donations</p>
          <p class="text-left text-gray-500 ">Select the donations that meet your organization’s needs and schedule a pickup or delivery to your location.</p>
          <p class="max-w-md font-bold sm:text-xl mt-4 md:mt-6 md:max-w-3xl" style="color:white ; text-align: left;">
          <span style="color: #8cc342;"> Step 3: </span>Distribute Meals to Beneficiaries
</p>
<p class="text-left text-gray-500 ">Use the food donations to provide fresh meals to those in need, helping fight hunger and reduce food waste in your community.</p>
<a href="{{ route('sign-in-static') }}">
<button type='button' class="mt-6 transition-all text-white font-semibold text-sm tracking-wide rounded-md px-6 py-2.5" style='background-color: #8cc342;'>Get Started</button>
  </a>  </div>
  </div>
</div>



<div class="bg-white px-6 font-[sans-serif] mt-20 pt-10 pb-20">
  <h2 class="text-3xl font-extrabold text-[#8cc342] mb-10 text-center">Frequently Asked Questions</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
    <!-- Restaurant Questions -->
    <div class="space-y-8 text-left">
      <h3 class="text-xl font-semibold text-[#333] text-center">For Restaurants</h3>
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#8cc342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-semibold text-[#333]">How do I list surplus food?</h4>
          <p class="text-sm text-[#333] mt-4">You can easily list your surplus food by logging into the RescueFood platform and uploading details about the items you wish to donate, including their quantity and condition.</p>
        </div>
      </div>

      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#8cc342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-semibold text-[#333]">What kind of food can I donate?</h4>
          <p class="text-sm text-[#333] mt-4">You can donate various types of food, including prepared meals, raw ingredients, and packaged items that are still within their expiration date. Please ensure that the food is safe for consumption.</p>
        </div>
      </div>

      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#8cc342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-semibold text-[#333]">How do I schedule pickups?</h4>
          <p class="text-sm text-[#333] mt-4">After listing your surplus food, you can schedule a pickup by selecting a convenient time directly through the platform, ensuring that local charities can collect your donations efficiently.</p>
        </div>
      </div>
    </div>

    <!-- Association Questions -->
    <div class="space-y-8 text-left">
      <h3 class="text-xl font-semibold text-[#333] text-center">For Associations</h3>
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#8cc342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-semibold text-[#333]">How do I request food donations?</h4>
          <p class="text-sm text-[#333] mt-4">You can request food donations by browsing the available listings on the RescueFood platform and selecting the items that meet your organization’s needs. Then, schedule a pickup or delivery.</p>
        </div>
      </div>

      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#8cc342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-semibold text-[#333]">Is there a cost to receive food?</h4>
          <p class="text-sm text-[#333] mt-4">No, there is no cost associated with receiving food donations through the RescueFood platform. Our goal is to facilitate food rescue and redistribution without any fees for participating charities.</p>
        </div>
      </div>

      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#8cc342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-semibold text-[#333]">What types of food are available for donation?</h4>
          <p class="text-sm text-[#333] mt-4">You can find a wide variety of food types available for donation, including fresh produce, baked goods, prepared meals, and packaged items. Each listing will specify the condition and quantity of the food.</p>
        </div>
      </div>
    </div>
  </div>
</div>




    <footer class=" bg-[#FBCEB1] px-4 sm:px-10 py-12 mt-32">
      <div class="grid max-sm:grid-cols-1 max-lg:grid-cols-2 lg:grid-cols-5 lg:gap-14 max-lg:gap-8">
        <div class="lg:col-span-2">
          <h4 class="text-xl font-semibold mb-6">About Us</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean gravida,
            mi eu pulvinar cursus, sem elit interdum mauris.</p>

          <div class="bg-[#f8f9ff] flex px-4 py-3 rounded-md text-left mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
              class="fill-gray-500 mr-3 rotate-90">
              <path
                d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
              </path>
            </svg>
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