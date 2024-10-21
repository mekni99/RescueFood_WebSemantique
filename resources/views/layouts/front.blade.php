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
<body class="homepage is-preload">
    <div id="page-wrapper">

      <section id="header" style="background-image: url('img/banner-1.jpg'); background-repeat: no-repeat; background-size: cover; min-height: 400px;">
    <div class="container pt-5 mt-5">
        <h2 class="display-1 ls-1">
            <span class="fw-bold text-primary">Rescue</span> Food
        </h2>
        <p class="fs-4">"قَالَ رَسُولُ اللهِ ﷺ: "خَيْرُ النَّاسِ أَنْفَعُهُمْ لِلنَّاسِ</p>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a class="icon solid" href="{{ url('/') }}"><span>🏠 Home</span></a></li>
                <li><a class="icon solid" href="{{ url('/about') }}"><span>ℹ️ About Us</span></a></li>
                <li><a class="icon solid" href="{{ url('/services') }}"><span>📦 Services</span></a></li>
                <li><a class="icon solid" href="{{ url('/contact') }}"><span>✉️ Contact</span></a></li>
            </ul>
        </nav>
    </div>
</section>


        <!-- Banner -->
        <section id="banner">
            <div class="container">
                <header>
                    <h2 style='color:#FFA500' >Welcome to <strong>RescueFood</strong>!</h2>
                </header>
                <p>Join us in the mission to collect excess food from restaurants and redistribute it to those in need. Together, we can make a difference and reduce food waste.</p>
                <ul class="actions">
                <li><a href="{{ url('/login') }}" class="button icon solid">Login</a></li>
                </ul>
                <ul class="actions">
                <li><a href="{{ url('/login') }}" class="button icon solid">Register as Restaurant</a></li>
                </ul>
            </div>
        </section>

        <!-- Main -->
        <section id="main">
            <div class="container">
                <div class="row">

                    <!-- Content -->
                    <div id="content" class="col-8 col-12-medium">

                        <!-- Post -->
                        <article class="box post">
                            <header>
                                <h2 style='color:#FFA500' ><a href="#">Our Mission to Combat Food Waste</a></h2>
                            </header>
                            <a href="#" class="image featured"><img src="{{ asset('img/front6.jpg') }}" alt="Food Recovery" /></a>
                            <h3 style='color:#FFA500' >Join us in making a change!</h3>
                            <p>At RescueFood, we are dedicated to creating a sustainable food ecosystem where excess food is transformed into opportunities for those in need.</p>
                            <ul class="actions">
                                <li><a href="{{ url('/about') }}" class="button icon solid ">📄 Continue Reading</a></li>
                            </ul>
                        </article>

                        <!-- Post -->
                        <article class="box post">
                            <header>
                                <h2 style='color:#FFA500' ><a href="#">How You Can Help</a></h2>
                            </header>
                            <a href="#" class="image featured"><img src="{{ asset('img/front2.png') }}" alt="Community Support" /></a>
                            <h3 style='color:#FFA500' >Your contribution matters</h3>
                            <p>Whether you are a restaurant owner or a concerned citizen, find out how you can contribute to our efforts in food recovery and redistribution.</p>
                            <ul class="actions">
                                <li><a href="{{ url('/services') }}" class="button icon solid">📄 Continue Reading</a></li>
                            </ul>
                        </article>

        </div>
      </div>
    </header>

    <div class="relative">
      <div class="px-4 sm:px-10">
        <div class="mt-16 max-w-4xl mx-auto text-center relative z-10">
        <h1 class="md:text-6xl text-4xl font-extrabold mb-6 md:!leading-[60px]" style='color: white;'>
        قَالَ رَسُولُ اللهِ ﷺ: <span class="typing" id="typed"></span>
    </h1>

    <script>
        const options = {
            strings: ['مَنْ نَفَّسَ عَنْ مُسْلِمٍ كُرْبَةً مِنْ كُرَبِ الدُّنْيَا، نَفَّسَ اللَّهُ عَنْهُ كُرْبَةً مِنْ كُرَبِ يَوْمِ الْقِيَامَةِ'], // Text to type
            typeSpeed: 50, // Speed of typing
            backSpeed: 20, // Speed of deleting (if you want it to delete)
            backDelay: 1000, // Delay before starting to delete
            loop: true // Set to true if you want it to loop
        };

        const typed = new Typed('#typed', options);
    </script>   
         <h1 class="text-2xl font-bold "style='color: #F96C57;'>Access food donations for your beneficiaries by joining RescueFood. Help us fight hunger and improve the lives of the most vulnerable.</h1>
 <div class="mt-20"> 
        <button class='px-6 py-3 rounded-xl text-white' style='background-color: #8cc342;'>Get started</button>
    </div>
        </div>
       
      </div>
    </div>

    

    <footer class="bg-white px-4 sm:px-10 py-12 mt-32">
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